<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('Productos_model');
		$this->load->model('login_model');
		$this->load->model('Usuario_model');
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');
		$this->load->library('form_validation');
	}
	private function check_session_and_load_view($view, $data = array())
	{
		// Verifica si el usuario está autenticado
		if ($this->session->userdata('usuario')) {
			$data['nombre'] = $this->session->userdata('usuario');
			$this->load->view($view, $data);
		} else {
			redirect('Welcome/login');
		}
	}


	public function index()
	{
		$this->load->view('login');
	}

	public function contacto()
	{
		$this->load->view('contactenos');
	}

	public function admin()
	{
		$data['usuarios'] = $this->Usuario_model->obtenerUsuarios();
		$this->load->view('admin', $data);
	}

	public function empleado()
	{
		$this->check_session_and_load_view('welcome_message');
	}
	public function TiendaGatos()
	{
		$data['productos'] = $this->Productos_model->obtenerProductos(); // Este debería devolver un array de objetos
		$this->check_session_and_load_view('TiendaGatos', $data);
	}

	public function TiendaPerros()
	{
		$lista = $this->login_model->listaproductos();
		$data['productos'] = $lista;
		$data['nombre'] = $this->session->userdata('nombre');
		$this->load->view('TiendaPerros', $data);
	}

	public function productos()
	{
		$lista = $this->login_model->listaproductos();
		$data['productos'] = $lista;
		$this->check_session_and_load_view('producto', $data);
	}

	public function login()
	{
		$this->load->view('login');
	}

	public function validarusuariobd()
	{
		$user = $this->input->post('user');
		$password = $this->input->post('password');

		if ($this->login_model->validarusuario($user, $password)) {
			log_message('debug', 'Usuario validado correctamente: ' . $user);

			// Obtener datos del usuario para guardar en la sesión
			$usuario = $this->login_model->obtenerUsuarioPorEmail($user);
			log_message('debug', 'Datos del usuario obtenidos: ' . print_r($usuario, true));

			$this->session->set_userdata('usuario', $usuario->nombre); // Ajusta esto según el nombre del campo en tu base de datos

			if (trim($user) == 'roly@gmail.com') {
				log_message('debug', 'Usuario admin, redirigiendo a admin');
				redirect('Welcome/admin');
			} else {
				log_message('debug', 'Usuario normal, redirigiendo a index');
				redirect('Welcome/empleado');
			}
		} else {
			log_message('debug', 'Usuario o contraseña incorrecta');
			$data['error'] = 'Usuario o contraseña incorrecta';
			$this->load->view('login', $data);
		}
	}


	public function editarProducto($id)
	{
		$data['producto'] = $this->Productos_model->get_producto($id);
		if (empty($data['producto'])) {
			show_404();
		}

		$this->load->view('editar_producto', $data);
	}

	public function adminProductos()
	{
		$data['productos'] = $this->Productos_model->obtenerProductos();
		$this->load->view('adminProductos', $data);
	}

	public function editarProduct()
	{
		$id = $this->input->post('producto_id');
		$data = array(
			'nombre' => $this->input->post('nombre'),
			'descripcion' => $this->input->post('descripcion'),
			'precio' => $this->input->post('precio'),
			'stock' => $this->input->post('stock'),
			'categoria' => $this->input->post('categoria'),
			'imagen_url' => $this->input->post('imagen_url')
		);

		if ($this->Productos_model->update_producto($id, $data)) {
			redirect('Welcome/adminProductos');
		} else {
			show_error('No se pudo actualizar el producto.');
		}
	}

	public function editar_usuario($id)
	{
		$data['usuario'] = $this->Usuario_model->get_usuario($id);
		if (empty($data['usuario'])) {
			show_404();
		}

		$this->load->view('editar_usuario', $data);
	}

	public function update_usuario()
	{
		$id = $this->input->post('id');
		$data = array(
			'nombre' => $this->input->post('nombre'),
			'primerApellido' => $this->input->post('primerApellido'),
			'segundoApellido' => $this->input->post('segundoApellido'),
			'fechaNacimiento' => $this->input->post('fechaNacimiento'),
			'direccion' => $this->input->post('direccion'),
			'telefono' => $this->input->post('telefono'),
			'email' => $this->input->post('email'),
			'nombre_usuario' => $this->input->post('nombre_usuario'),
			'estadoUsuario' => $this->input->post('estadoUsuario')
		);

		if ($this->Usuario_model->update_usuario($id, $data)) {
			redirect('Welcome/admin'); // Redirigir después de la actualización
		} else {
			show_error('No se pudo actualizar el usuario.');
		}
	}

	public function eliminar_usuario($id)
	{
		if ($this->Usuario_model->delete_usuario($id)) {
			redirect('Welcome/admin'); // Redirigir después de actualizar el estado
		} else {
			show_error('No se pudo actualizar el estado del usuario.');
		}
	}
}

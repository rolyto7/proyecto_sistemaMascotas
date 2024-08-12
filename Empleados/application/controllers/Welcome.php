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
	public function nuevoUsuario()
	{
		$this->load->view('nuevoUsuario');
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

			// Guarda el ID del usuario en la sesión
			$this->session->set_userdata('usuario_id', $usuario->id);
			$this->session->set_userdata('usuario', $usuario->nombre); // Ajusta esto según el nombre del campo en tu base de datos

			if (trim($user) == 'roly@gmail.com') {
				log_message('debug', 'Usuario admin, redirigiendo a admin');
				redirect('Welcome/admin');
			} else {
				log_message('debug', 'Usuario normal, redirigiendo a empleado');
				redirect('Welcome/empleado');
			}
		} else {
			log_message('debug', 'Usuario o contraseña incorrecta');
			$data['error'] = 'Usuario o contraseña incorrecta';
			$this->load->view('login', $data);
		}
	}
	public function miCuenta()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		if (!$usuario_id) {
			redirect('Welcome/login');
		}

		$data['usuario'] = $this->Usuario_model->get_usuario($usuario_id);
		$this->load->view('mi_cuenta', $data);
	}

	public function actualizarCuenta()
	{
		$usuario_id = $this->session->userdata('usuario_id');
		if (!$usuario_id) {
			redirect('Welcome/login');
		}

		// Cargar el modelo
		$this->load->model('Usuario_model');

		// Obtener el usuario actual
		$usuario = $this->Usuario_model->get_usuario($usuario_id);

		// Validar contraseña actual
		$contrasena_actual = $this->input->post('contrasena_actual');
		$nueva_contrasena = $this->input->post('nueva_contrasena');

		// Verificar si la contraseña actual es correcta
		if (!password_verify($contrasena_actual, $usuario->contrasena)) {
			$this->session->set_flashdata('error', 'La contraseña actual no es válida.');
			redirect('Welcome/miCuenta');
		}

		// Preparar datos para actualizar
		$data = array(
			'nombre' => $this->input->post('nombre'),
			'primerApellido' => $this->input->post('primerApellido'),
			'segundoApellido' => $this->input->post('segundoApellido'),
			'nombre_usuario' => $this->input->post('nombre_usuario'),
			'telefono' => $this->input->post('telefono'),
			'direccion' => $this->input->post('direccion'),
			'fechaActualizacionUsuario' => date('Y-m-d H:i:s')
		);

		// Si se proporcionó una nueva contraseña, actualizarla y enviar correo
		if (!empty($nueva_contrasena)) {
			$data['contrasena'] = password_hash($nueva_contrasena, PASSWORD_BCRYPT);

			// Cargar la biblioteca de correo
			$this->load->library('email');

			// Configuración del correo
			$config = array(
				'protocol' => 'smtp',
				'smtp_host' => 'smtp.gmail.com',
				'smtp_port' => 587,
				'smtp_user' => 'lazaro.roly.407@gmail.com',
				'smtp_pass' => 'ipbc bxyr hohu pqvr',
				'mailtype' => 'html',
				'charset' => 'utf-8',
				'wordwrap' => TRUE,
				'newline' => "\r\n",
				'smtp_crypto' => 'tls'
			);
			$this->email->initialize($config);

			// Configuración del correo
			$this->email->from('tu_email@gmail.com', 'Roly Lazaro');
			$this->email->to($usuario->email);
			$this->email->cc('lazaro.roly.407@gmail.com');
			$this->email->subject('Cambio de Contraseña');
			$this->email->message('La contraseña ha sido cambiada exitosamente. La nueva contraseña es: ' . $nueva_contrasena . ' del usuario: ' . $usuario->email);

			// Enviar el correo
			if ($this->email->send()) {
				$this->session->set_flashdata('success', 'Se ha enviado un correo con la nueva contraseña.');
			} else {
				$this->session->set_flashdata('error', 'Correo no enviado: ' . $this->email->print_debugger());
			}
		}

		// Actualizar el usuario
		if ($this->Usuario_model->update_usuario($usuario_id, $data)) {
			$this->session->set_flashdata('success', 'Cuenta actualizada con éxito.');
			redirect('Welcome/miCuenta');
		} else {
			$this->session->set_flashdata('error', 'No se pudo actualizar la cuenta.');
			redirect('Welcome/miCuenta');
		}
	}




	public function agregarProducto()
	{
		// Load the model
		$this->load->model('productos_model');

		// Get POST data
		$data = array(
			'nombre' => $this->input->post('nombre'),
			'descripcion' => $this->input->post('descripcion'),
			'precio' => $this->input->post('precio'),
			'stock' => $this->input->post('stock'),
			'categoria' => $this->input->post('categoria'),
			'mascota' => $this->input->post('mascota'),
			'tipo_alimento' => $this->input->post('tipo_alimento'),
			'fechaActualizacion' => date('Y-m-d H:i:s') // Set current date and time
		);

		// Handle image upload
		if (!empty($_FILES['imagen_url']['name'])) {
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['max_size'] = 2048;

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('imagen_url')) {
				$uploadData = $this->upload->data();
				$data['imagen_url'] = 'uploads/' . $uploadData['file_name'];
			} else {
				$data['imagen_url'] = null;
			}
		}

		// Insert the product
		$this->productos_model->agregarProducto($data);

		// Redirect to adminProductos.php
		redirect('Welcome/adminProductos');
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
		$data['productos'] = $this->Productos_model->obtenerProducto();
		$this->load->view('adminProductos', $data);
	}
	public function nuevoProducto()
	{
		$this->load->view('agregarProducto');
	}
	public function adminDetalles()
	{
		$data['productos'] = $this->Productos_model->obtenerProducto();
		$this->load->view('adminDetalles', $data);
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
	public function guardarUsuario()
	{
		$password = bin2hex(random_bytes(8));
		$data = array(
			'nombre' => $this->input->post('nombre'),
			'primerApellido' => $this->input->post('primerApellido'),
			'segundoApellido' => $this->input->post('segundoApellido'),
			'fechaNacimiento' => $this->input->post('fechaNacimiento'),
			'direccion' => $this->input->post('direccion'),
			'telefono' => $this->input->post('telefono'),
			'email' => $this->input->post('email'),
			'nombre_usuario' => $this->input->post('nombre_usuario'),
			'contrasena' => password_hash($password, PASSWORD_BCRYPT),
		);

		if (empty($data['nombre']) || empty($data['primerApellido']) || empty($data['nombre_usuario']) || empty($data['contrasena'])) {
			$this->session->set_flashdata('error', 'Todos los campos obligatorios deben ser completados.');
			redirect('Welcome/nuevoUsuario');
		} else {
			$this->Usuario_model->insertarUsuario($data);

			// Configuración del correo
			$config = array(
				'protocol' => 'smtp',
				'smtp_host' => 'smtp.gmail.com',
				'smtp_port' => 587,
				'smtp_user' => 'lazaro.roly.407@gmail.com',
				'smtp_pass' => 'ipbc bxyr hohu pqvr', // Llave de correo electrónico
				'mailtype' => 'html',
				'charset' => 'utf-8',
				'wordwrap' => TRUE,
				'newline' => "\r\n",
				'smtp_crypto' => 'tls'
			);

			$this->load->library('email', $config);
			$this->email->from('tu_email@gmail.com', 'Roly Lazaro');
			$this->email->to($data['email']);
			$this->email->cc('lazaro.roly.407@gmail.com');
			$this->email->subject('Tu Contraseña');
			$this->email->message('La cuenta ha sido creada. La contraseña es: ' . $password . ' del usuario :' . $data['email']);

			if ($this->email->send()) {
				$data['success'] = 'Se envió su contraseña a ' . $data['nombre_usuario'];
			} else {
				$data['error'] = 'Correo no enviado: ' . $this->email->print_debugger();
			}

			// Redireccionar después de enviar el correo
			$this->load->view('welcome_message', $data);
			redirect('Welcome/admin');
		}
	}




	public function editar_usuario($id)
	{
		$data['usuario'] = $this->Usuario_model->get_usuarios($id);
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
			'estadoUsuario' => $this->input->post('estadoUsuario'),
			'fechaActualizacionUsuario' => date('Y-m-d H:i:s')
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


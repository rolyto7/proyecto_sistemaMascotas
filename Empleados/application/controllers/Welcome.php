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
		$this->load->library('session');
		$this->load->model('Pedido_model');
		$this->load->model('Cliente_model');
		$this->load->model('Detalles_model');
		$this->load->model('Reportes_model');
	}
	private function check_session_and_load_view($view, $data = array())
	{
		// Verifica si el usuario está autenticado
		if ($this->session->userdata('usuario')) {
			$data['nombre'] = $this->session->userdata('usuario');
			$data['id'] = $this->session->userdata('usuario_id');
			$this->load->view($view, $data);
		} else {
			redirect('Welcome/login');
		}
	}
	// Reportes.php (Controlador)
	public function reporte_usuario()
	{
		$usuario_id = $this->input->post('usuario_id');
		$fecha_inicio = $this->input->post('fecha_inicio');
		$fecha_fin = $this->input->post('fecha_fin');

		$data['usuarios'] = $this->Usuario_model->get_all_usuarios(); // Para mantener el selector de usuarios
		$data['reporte'] = $this->Reportes_model->get_reporte($usuario_id, $fecha_inicio, $fecha_fin);

		$this->load->view('reportes/reporte_usuario', $data);
	}
	public function reporte_por_producto_categoria()
	{
		$producto_id = $this->input->post('producto_id');
		$categoria = $this->input->post('categoria');
		$fecha_inicio = $this->input->post('fecha_inicio');
		$fecha_fin = $this->input->post('fecha_fin');

		$data['categorias'] = $this->Productos_model->get_all_categoria();
		$data['productos'] = $this->Productos_model->get_all_nombres();
		$data['reporte'] = $this->Reportes_model->get_reporte_productos($producto_id, $categoria, $fecha_inicio, $fecha_fin);

		$data['producto_id'] = $producto_id;
		$data['categoria'] = $categoria;

		$this->load->view('reportes/reporte_producto_categoria', $data);
	}

	// Reportes.php (Controlador)
	public function reporte_producto_mas_vendido()
	{
		$fecha_inicio = $this->input->post('fecha_inicio');
		$fecha_fin = $this->input->post('fecha_fin');

		$data['productos'] = $this->Reportes_model->get_products_sold_ordered($fecha_inicio, $fecha_fin);
		$data['backgroundColor'] = ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40', '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0']; // Colores para el gráfico

		// Cargar la vista con los datos
		$this->load->view('reportes/reporte_producto_mas_vendido', $data);
	}






	public function cerrarsesion()
	{
		$this->session->sess_destroy();
		redirect('Welcome/index');
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
		$this->load->view('administrador/admin', $data);
	}
	public function nuevoUsuario()
	{
		$this->load->view('administrador/nuevoUsuario');
	}

	public function empleado()
	{
		$this->check_session_and_load_view('welcome_message');
	}


	// Funciones para Gatos
	public function TiendaGatos()
	{
		$this->load->model('Productos_model');
		$data['productos'] = $this->Productos_model->obtener_productos_gatos();
		$this->check_session_and_load_view('Gatos/TiendaGatos', $data);
	}
	public function AccesoriosGatos()
	{
		$this->load->model('Productos_model');
		$data['productos'] = $this->Productos_model->obtener_accesorios_gatos();
		$this->check_session_and_load_view('Gatos/Accesorios', $data);
	}
	public function Casas_Camas_Gatos()
	{
		$this->load->model('Accesorios');
		$data['productos'] = $this->Accesorios->obtener_camas_gatos();
		$this->check_session_and_load_view('Gatos/Camas', $data);
	}
	public function Torres_Rascadores_Gatos()
	{
		$this->load->model('Accesorios');
		$data['productos'] = $this->Accesorios->obtener_Torres_Rascadores_Gatos();
		$this->check_session_and_load_view('Gatos/Torres_Rascadores', $data);
	}
	public function Transportadores_Jaulas_Gatos()
	{
		$this->load->model('Accesorios');
		$data['productos'] = $this->Accesorios->Transportadores_Jaulas_Gatos();
		$this->check_session_and_load_view('Gatos/Transportadores_Jaulas', $data);
	}
	public function Platos_Dispensadores_Gatos()
	{
		$this->load->model('Accesorios');
		$data['productos'] = $this->Accesorios->Platos_Dispensadores_Gatos();
		$this->check_session_and_load_view('Gatos/Platos_Dispensadores', $data);
	}
	public function Collares_Percheras_Gatos()
	{
		$this->load->model('Accesorios');
		$data['productos'] = $this->Accesorios->Collares_Percheras_Gatos();
		$this->check_session_and_load_view('Gatos/Collares_Percheras', $data);
	}
	public function AlimentoGatos()
	{
		$this->load->model('Productos_model');
		$data['productos'] = $this->Productos_model->obtener_alimento_gatos();
		$this->check_session_and_load_view('Gatos/Alimento', $data);
	}
	public function AlimentoHumedoGatos()
	{
		$this->load->model('Productos_model');
		$data['productos'] = $this->Productos_model->obtener_alimento_humedo_gatos();
		$this->check_session_and_load_view('Gatos/Alimento_humedo', $data);
	}
	public function AlimentoSecoGatos()
	{
		$this->load->model('Productos_model');
		$data['productos'] = $this->Productos_model->obtener_alimento_seco_gatos();
		$this->check_session_and_load_view('Gatos/Alimento_seco', $data);
	}
	public function AlimentoSecoEspecialGato()
	{
		$this->load->model('Alimentos');
		$data['productos'] = $this->Alimentos->obtener_alimento_seco_especial();
		$this->check_session_and_load_view('Gatos/AlimentoSecoEspecial', $data);
	}
	public function Snacks_Premios_Gato()
	{
		$this->load->model('Alimentos');
		$data['productos'] = $this->Alimentos->obtener_Snacks_Premios();
		$this->check_session_and_load_view('Gatos/Snacks_Premios', $data);
	}
	public function JugueteGatos()
	{
		$this->load->model('Productos_model');
		$data['productos'] = $this->Productos_model->obtener_juguetes_gatos();
		$this->check_session_and_load_view('Gatos/Juguetes', $data);
	}
	public function Catnip_Gatos()
	{
		$this->load->model('Juguetes');
		$data['productos'] = $this->Juguetes->Catnip_Gatos();
		$this->check_session_and_load_view('Gatos/Catnip_Gatos', $data);
	}
	public function Juguetes_Gatos()
	{
		$this->load->model('Juguetes');
		$data['productos'] = $this->Juguetes->Juguetes_Gatos();
		$this->check_session_and_load_view('Gatos/Juguete', $data);
	}
	public function HigieneGatos()
	{
		$this->load->model('Productos_model');
		$data['productos'] = $this->Productos_model->obtener_higiene_gatos();
		$this->check_session_and_load_view('Gatos/Higiene', $data);
	}
	public function Arenas_Sanitarias_Gatos()
	{
		$this->load->model('Higiene');
		$data['productos'] = $this->Higiene->Arenas_Sanitarias_gatos();
		$this->check_session_and_load_view('Gatos/Arenas_Sanitarias', $data);
	}
	public function Areneros_Palas_Gatos()
	{
		$this->load->model('Higiene');
		$data['productos'] = $this->Higiene->Areneros_Palas_Gatos();
		$this->check_session_and_load_view('Gatos/Areneros_Palas', $data);
	}
	public function Limpieza_Hogar_Gatos()
	{
		$this->load->model('Higiene');
		$data['productos'] = $this->Higiene->Limpieza_Hogar_Gatos();
		$this->check_session_and_load_view('Gatos/Limpieza_Hogar', $data);
	}
	public function Shampoo_Aseo_Gatos()
	{
		$this->load->model('Higiene');
		$data['productos'] = $this->Higiene->Shampoo_Aseo_Gatos();
		$this->check_session_and_load_view('Gatos/Shampoo_Aseo', $data);
	}
	public function Peines_Cepillos_Gatos()
	{
		$this->load->model('Higiene');
		$data['productos'] = $this->Higiene->Peines_Cepillos_Gatos();
		$this->check_session_and_load_view('Gatos/Peines_Cepillos', $data);
	}

	// Funciones para Perros
	public function TiendaPerros()
	{
		$this->load->model('Productos_model');
		$data['productos'] = $this->Productos_model->obtener_productos_perros();
		$this->check_session_and_load_view('Perros/TiendaPerros', $data);
	}
	public function AlimentoPerros()
	{
		$this->load->model('Productos_model');
		$data['productos'] = $this->Productos_model->obtener_alimento_perros();
		$this->check_session_and_load_view('Perros/Alimento', $data);
	}
	public function AlimentoSecoPerros()
	{
		$this->load->model('Productos_model');
		$data['productos'] = $this->Productos_model->obtener_productos_perros_seco();
		$this->check_session_and_load_view('Perros/Alimento_Seco', $data);
	}
	public function AlimentoHumedoPerros()
	{
		$this->load->model('Productos_model');
		$data['productos'] = $this->Productos_model->obtener_productos_perros_humedo();
		$this->check_session_and_load_view('Perros/Alimento_Seco', $data);
	}
	public function AlimentoSecoEspecialPerro()
	{
		$this->load->model('Alimentos');
		$data['productos'] = $this->Alimentos->AlimentoSecoEspecialPerro();
		$this->check_session_and_load_view('Perros/AlimentoSecoEspecial', $data);
	}
	public function Snacks_Premios_Perro()
	{
		$this->load->model('Alimentos');
		$data['productos'] = $this->Alimentos->obtener_Snacks_Premios_Perros();
		$this->check_session_and_load_view('Perros/Snacks_Premios', $data);
	}
	public function AccesoriosPerros()
	{
		$this->load->model('Productos_model');
		$data['productos'] = $this->Productos_model->obtener_accesorios_perros();
		$this->check_session_and_load_view('Perros/Accesorios', $data);
	}
	public function Limpieza_Perros()
	{
		$this->load->model('Higiene');
		$data['productos'] = $this->Higiene->Limpieza_Perros();
		$this->check_session_and_load_view('Perros/Limpieza', $data);
	}
	public function Casas_Camas_Perros()
	{
		$this->load->model('Accesorios');
		$data['productos'] = $this->Accesorios->Casas_Camas_Perros();
		$this->check_session_and_load_view('Perros/Casas_Camas', $data);
	}
	public function Collares_Correas_Perros()
	{
		$this->load->model('Accesorios');
		$data['productos'] = $this->Accesorios->Collares_Correas_Perros();
		$this->check_session_and_load_view('Perros/Collares_Correas', $data);
	}

	public function Platos_Dispensadores_Perros()
	{
		$this->load->model('Accesorios');
		$data['productos'] = $this->Accesorios->Platos_Dispensadores_Perros();
		$this->check_session_and_load_view('Perros/Platos_Dispensadores', $data);
	}
	public function Ropa_Perros()
	{
		$this->load->model('Accesorios');
		$data['productos'] = $this->Accesorios->Ropa_Perros();
		$this->check_session_and_load_view('Perros/Ropa', $data);
	}
	public function Transportadores_Jaulas_Perros()
	{
		$this->load->model('Accesorios');
		$data['productos'] = $this->Accesorios->Transportadores_Jaulas_Perros();
		$this->check_session_and_load_view('Perros/Transportadores_Jaulas', $data);
	}
	public function JuguetesPerros()
	{
		$this->load->model('Productos_model');
		$data['productos'] = $this->Productos_model->obtener_juguetes_perros();
		$this->check_session_and_load_view('Perros/Juguetes', $data);
	}
	public function Jueguetes_Goma_Perros()
	{
		$this->load->model('Juguetes');
		$data['productos'] = $this->Juguetes->Jueguetes_Goma_Perros();
		$this->check_session_and_load_view('Perros/Jueguetes_Goma', $data);
	}
	public function Pelotas_Perros()
	{
		$this->load->model('Juguetes');
		$data['productos'] = $this->Juguetes->Pelotas_Perros();
		$this->check_session_and_load_view('Perros/Pelotas', $data);
	}
	public function Peluches_Perros()
	{
		$this->load->model('Juguetes');
		$data['productos'] = $this->Juguetes->Peluches_Perros();
		$this->check_session_and_load_view('Perros/Peluches', $data);
	}
	public function HigienePerros()
	{
		$this->load->model('Productos_model');
		$data['productos'] = $this->Productos_model->obtener_higiene_perros();
		$this->check_session_and_load_view('Perros/Higiene', $data);
	}
	public function Bolsas_Dispensadores_Perros()
	{
		$this->load->model('Higiene');
		$data['productos'] = $this->Higiene->Bolsas_Dispensadores_Perros();
		$this->check_session_and_load_view('Perros/Bolsas_Dispensadores', $data);
	}

	public function Cuidado_uñas_Perros()
	{
		$this->load->model('Higiene');
		$data['productos'] = $this->Higiene->Cuidado_uñas_Perros();
		$this->check_session_and_load_view('Perros/Cuidado_uñas', $data);
	}
	public function Cuidado_Dental_Perros()
	{
		$this->load->model('Higiene');
		$data['productos'] = $this->Higiene->Cuidado_Dental_Perros();
		$this->check_session_and_load_view('Perros/Cuidado_Dental', $data);
	}
	public function Peines_Cepillos_Perros()
	{
		$this->load->model('Higiene');
		$data['productos'] = $this->Higiene->Peines_Cepillos_Perros();
		$this->check_session_and_load_view('Perros/Peines_Cepillos', $data);
	}
	public function Shampoo_Perros()
	{
		$this->load->model('Higiene');
		$data['productos'] = $this->Higiene->Shampoo_Perros();
		$this->check_session_and_load_view('Perros/Shampoo', $data);
	}
	public function productos()
	{
		$lista = $this->login_model->listaproductos();
		$data['productos'] = $lista;
		$this->check_session_and_load_view('producto', $data);
	}
	public function productos_gatos()
	{
		$this->load->model('Productos_model');
		$data['productos'] = $this->Productos_model->obtener_productos_gatos(); // Filtrar productos de gatos
		$this->load->view('productos_gatos', $data);
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
		$this->load->model('productos_model');

		// Get POST data
		$data = array(
			'nombre' => $this->input->post('nombre'),
			'descripcion' => $this->input->post('descripcion'),
			'precio' => $this->input->post('precio'),
			'stock' => $this->input->post('stock'),
			'categoria' => $this->input->post('categoria'),
			'mascota' => $this->input->post('mascota'),
			'tipo' => $this->input->post('tipo'),
			'imagen_url' => $this->input->post('imagen_url'), // Directly get the image URL
			'fechaActualizacion' => date('Y-m-d H:i:s') // Set current date and time
		);

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

		$this->load->view('administrador/editar_producto', $data);
	}

	public function adminProductos()
	{
		$data['productos'] = $this->Productos_model->obtenerProducto();
		$this->load->view('administrador/adminProductos', $data);
	}
	public function nuevoProducto()
	{
		$this->load->view('administrador/agregarProducto');
	}
	public function adminDetalles()
	{
		$this->load->model('Detalles_model');
		$data['detalles'] = $this->Detalles_model->get_detalles_pedidos();
		$data['ventas'] = $this->Detalles_model->get_ventas();

		// Cargar la vista con los datos
		$this->load->view('administrador/adminDetalles', $data);
	}
	public function verDetallePedido($pedido_id)
	{
		$this->load->model('Detalles_model');
		$data['detalle_pedido'] = $this->Detalles_model->get_detalle_pedido($pedido_id);

		$this->load->view('administrador/verDetallePedido', $data);
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
			redirect('administrador/adminProductos');
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
			redirect('admin');
		}
	}




	public function editar_usuario($id)
	{
		$data['usuario'] = $this->Usuario_model->get_usuarios($id);
		if (empty($data['usuario'])) {
			show_404();
		}

		$this->load->view('administrador/editar_usuario', $data);
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
			redirect('administrador/admin'); // Redirigir después de la actualización
		} else {
			show_error('No se pudo actualizar el usuario.');
		}
	}

	public function eliminar_usuario($id)
	{
		if ($this->Usuario_model->delete_usuario($id)) {
			redirect('administrador/admin'); // Redirigir después de actualizar el estado
		} else {
			show_error('No se pudo actualizar el estado del usuario.');
		}
	}
	public function eliminarProducto($id)
	{
		$this->load->model('Productos_model');
		$this->Productos_model->delete_producto($id);
		redirect('Welcome/adminProductos');
	}
	public function agregar_al_carrito()
	{
		$this->load->model('Productos_model');

		$producto_id = $this->input->post('producto_id');
		$cantidad = $this->input->post('cantidad') ? $this->input->post('cantidad') : 1; // Establecer cantidad predeterminada a 1 si no se proporciona

		$producto = $this->Productos_model->get_productos_by_id($producto_id);

		if (!$producto) {
			echo json_encode(['error' => 'Producto no encontrado']);
			return;
		}

		$descuento = 0;
		if ($producto['oferta'] == 1) {
			$descuento = 0.10;
		} elseif ($producto['oferta'] == 2) {
			$descuento = 0.15;
		} elseif ($producto['oferta'] == 3) {
			$descuento = 0.20;
		}

		$precio_con_descuento = $producto['precio'] - ($producto['precio'] * $descuento);
		$producto['precio_con_descuento'] = $precio_con_descuento;
		$producto['cantidad'] = $cantidad;
		$producto['producto_id'] = $producto_id;

		$this->load->library('session');
		$carrito = $this->session->userdata('carrito') ? $this->session->userdata('carrito') : [];

		// Verifica si el producto ya está en el carrito
		$encontrado = false;
		foreach ($carrito as &$item) {
			if ($item['producto_id'] == $producto_id) {
				$item['cantidad'] += $cantidad; // Aumentar la cantidad si ya está en el carrito
				$encontrado = true;
				break;
			}
		}

		if (!$encontrado) {
			$carrito[] = $producto; // Agregar el producto al carrito
		}

		$this->session->set_userdata('carrito', $carrito);

		echo json_encode(['success' => 'Producto agregado al carrito']);
	}
	public function carrito()
	{
		$this->load->model('Productos_model');
		$productos = $this->session->userdata('carrito');
		$total = 0;
		if (!empty($productos)) {
			foreach ($productos as $producto) {
				$total += $producto['precio_con_descuento'] * $producto['cantidad'];
			}
		}
		$data['productos'] = $productos;
		$data['total'] = $total;
		$this->check_session_and_load_view('carrito', $data);
	}

	public function vaciar_carrito()
	{
		$this->load->model('Productos_model');
		$this->Productos_model->vaciar_carrito();
		redirect('Welcome/carrito');
	}
	public function ver_pedidos()
	{
		$this->load->model('Pedido_model');

		// Obtener el CI del formulario
		$ci = $this->input->get('search_ci');

		// Obtener los datos filtrados por CI
		$data['pedidos'] = $this->Pedido_model->get_pedidos($ci);

		// Verifica que los datos se han cargado
		if (!$data['pedidos']) {
			// Manejo de errores si no se obtienen datos
			$data['pedidos'] = []; // Definir como array vacío para evitar errores en la vista
		}

		// Cargar la vista
		$this->check_session_and_load_view('pedidos', $data);
	}
	public function cancelar_pedido($pedido_id)
	{
		$this->load->model('Pedido_model');
		$this->load->model('Productos_model'); // Asegúrate de cargar el modelo de productos

		// Obtener los detalles del pedido
		$detalles_pedido = $this->Pedido_model->get_detalles_pedido($pedido_id);

		// Iniciar la transacción
		$this->db->trans_start();

		// Cambiar el estado del pedido a 'Cancelado'
		$resultado = $this->Pedido_model->actualizar_estado_pedido($pedido_id, 2); // 2 es el estado 'Cancelado'

		if ($resultado) {
			// Sumar la cantidad al stock por cada producto del pedido cancelado
			foreach ($detalles_pedido as $detalle) {
				$producto_id = $detalle['producto_id'];
				$cantidad = $detalle['cantidad'];
				// Llama al método para sumar el stock
				$this->Productos_model->sumar_stock($producto_id, $cantidad);
			}

			// Redirigir o mostrar un mensaje de éxito
			$this->session->set_flashdata('mensaje', 'Pedido cancelado correctamente.');
		} else {
			// Redirigir o mostrar un mensaje de error
			$this->session->set_flashdata('mensaje', 'Error al cancelar el pedido.');
		}

		// Completar la transacción
		$this->db->trans_complete();

		redirect('Welcome/ver_pedidos');
	}

	public function procesar_compra()
	{
		$productos = $this->input->post('productos'); // Array de productos con id y cantidad
		$this->load->model('Productos_model');

		foreach ($productos as $producto) {
			$producto_id = $producto['id'];
			$cantidad = $producto['cantidad'];

			// Actualizar el stock del producto
			$this->Productos_model->actualizar_stock($producto_id, $cantidad);
		}

		// Aquí puedes seguir con la lógica de la compra (guardar en la base de datos, mostrar confirmación, etc.)
	}

	public function entregar_pedido($pedido_id)
	{
		// Cargar los modelos necesarios
		$this->load->model('Pedido_model');
		$this->load->model('Venta_model');
		$this->load->database();

		// Iniciar la transacción
		$this->db->trans_start();

		// Obtener el pedido
		$pedido = $this->Pedido_model->get_pedido_by_id($pedido_id);
		if (!$pedido) {
			$this->db->trans_rollback();
			show_error('Pedido no encontrado.');
			return;
		}

		$detalles_pedido = $this->Pedido_model->get_detalles_pedido($pedido_id);

		// Ya no se actualizará la cantidad de stock por cada producto
		// Puedes eliminar el bloque que descuenta el stock:
		/*
																								  foreach ($detalles_pedido as $detalle) {
																									  $producto_id = $detalle['producto_id'];
																									  $cantidad = $detalle['cantidad'];
																									  // Descontar la cantidad del stock
																									  $this->Productos_model->descontar_stock($producto_id, $cantidad);
																								  }
																								  */

		// Insertar la venta
		$usuario_id = $this->session->userdata('usuario_id');
		$venta_data = [
			'usuario_id' => $usuario_id,
			'cliente_id' => $pedido['cliente_id'],
			'pedido_id' => $pedido['pedido_id'],
			'total' => $pedido['total'],
			'estado' => 3,
			'fechaPedido' => $pedido['fecha_pedido']
		];

		$this->Venta_model->insert_venta($venta_data);

		// Actualizar el estado del pedido en detalles
		$this->Venta_model->update_detalles_estado($pedido_id, 3);

		// Completar la transacción
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			show_error('Ocurrió un error al procesar la transacción.');
		} else {
			$this->session->set_flashdata('pedido_entregado', 'Pedido entregado con éxito');
			redirect('Welcome/ver_pedidos');
		}
	}

	public function ofertas()
	{
		$this->load->model('Productos_model');
		$data['productos'] = $this->Productos_model->obtener_productos();
		$this->check_session_and_load_view('ofertas', $data);
	}
	public function detallesperro($producto_id)
	{
		$data['producto'] = $this->Productos_model->obtenerProductoPorId($producto_id);
		$this->check_session_and_load_view('Perros/detalles', $data);
	}
	public function detallesgato($producto_id)
	{
		$data['producto'] = $this->Productos_model->obtenerProductoPorId($producto_id);
		$this->check_session_and_load_view('Gatos/detalles', $data);
	}
	public function buscar_cliente()
	{
		$data = json_decode($this->input->raw_input_stream, true);
		log_message('debug', 'Datos recibidos en buscar_cliente: ' . json_encode($data));

		if (!isset($data['ci'])) {
			echo json_encode(['status' => 'error', 'message' => 'CI no proporcionado']);
			return;
		}

		$cliente = $this->Cliente_model->buscar_cliente_por_ci($data['ci']);

		if ($cliente) {
			echo json_encode(['status' => 'success', 'cliente' => $cliente]);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Cliente no encontrado']);
		}
	}


	public function guardar_pedido()
	{
		$data = json_decode($this->input->raw_input_stream, true);
		log_message('debug', 'Datos recibidos en guardar_pedido: ' . json_encode($data));

		if (!$data) {
			echo json_encode(['status' => 'error', 'message' => 'Datos no recibidos']);
			return;
		}

		// Buscar o guardar el cliente
		$cliente = $this->Cliente_model->buscar_cliente_por_ci($data['ci']);
		log_message('debug', 'Cliente encontrado: ' . json_encode($cliente));

		if (!$cliente) {
			$cliente_id = $this->Cliente_model->guardar_cliente($data);
			log_message('debug', 'Nuevo cliente creado con ID: ' . $cliente_id);
		} else {
			$cliente_id = $cliente->cliente_id;
			log_message('debug', 'Cliente existente con ID: ' . $cliente_id);
		}

		// Obtener el carrito de la sesión
		$this->load->library('session');
		$carrito = $this->session->userdata('carrito');
		log_message('debug', 'Carrito recibido: ' . json_encode($carrito));

		if (empty($carrito)) {
			echo json_encode(['status' => 'error', 'message' => 'Carrito vacío']);
			return;
		}

		// Guardar el pedido
		$pedido_id = $this->Pedido_model->guardar_pedido($cliente_id);
		log_message('debug', 'ID del pedido guardado: ' . $pedido_id);

		if (!$pedido_id) {
			echo json_encode(['status' => 'error', 'message' => 'Error al guardar el pedido']);
			return;
		}

		// Recorrer los productos del carrito y guardar los detalles del pedido
		foreach ($carrito as $producto) {
			// Guardar el detalle del pedido
			if (!$this->Pedido_model->guardar_detalle_pedido($pedido_id, $producto['producto_id'], $producto['cantidad'])) {
				echo json_encode(['status' => 'error', 'message' => 'Error al guardar los detalles del pedido']);
				return;
			}

			// Descontar el stock del producto
			$producto_actual = $this->Productos_model->obtener_producto($producto['producto_id']);
			if ($producto_actual) {
				$nuevo_stock = $producto_actual->stock - $producto['cantidad'];
				if ($nuevo_stock < 0) {
					// Si el stock es insuficiente, enviar un error
					echo json_encode(['status' => 'error', 'message' => 'Stock insuficiente para el producto: ' . $producto['nombre']]);
					return;
				}
				// Actualizar el stock del producto
				$this->Productos_model->actualiza_stock($producto['producto_id'], $nuevo_stock);
			}
		}

		// Vaciar el carrito
		$this->session->unset_userdata('carrito');

		echo json_encode(['status' => 'success']);
	}

}

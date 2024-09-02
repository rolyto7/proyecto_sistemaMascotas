<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('login_model');
		$this->load->model('Productos_model');
		$this->load->model('Pedido_model');
		$this->load->model('Cliente_model');
		$this->load->library('session');
	}

	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function contacto()
	{
		$this->load->view('contactenos');
	}
	public function productos()
	{
		$this->load->view('producto');
	}
	public function login()
	{
		$this->load->view('login');
	}

	// Funciones para productos de gatos
	public function TiendaGatos()
	{
		$this->load->model('Productos_model');
		$data['productos'] = $this->Productos_model->obtener_productos_gatos();
		$this->load->view('Gatos/TiendaGatos', $data);
	}
	public function AccesoriosGatos()
	{
		$this->load->model('Productos_model');
		$data['productos'] = $this->Productos_model->obtener_accesorios_gatos();
		$this->load->view('Gatos/Accesorios', $data);
	}
	public function AlimentoGatos()
	{
		$this->load->model('Productos_model');
		$data['productos'] = $this->Productos_model->obtener_alimento_gatos();
		$this->load->view('Gatos/Alimento', $data);
	}
	public function JuguetesGatos()
	{
		$this->load->model('Productos_model');
		$data['productos'] = $this->Productos_model->obtener_juguetes_gatos();
		$this->load->view('Gatos/Juguetes', $data);
	}
	public function HigieneGatos()
	{
		$this->load->model('Productos_model');
		$data['productos'] = $this->Productos_model->obtener_higiene_gatos();
		$this->load->view('Gatos/Higiene', $data);
	}

	// Funciones para productos de perros
	public function TiendaPerros()
	{
		$this->load->model('Productos_model');
		$data['productos'] = $this->Productos_model->obtener_productos_perros();
		$this->load->view('Perros/TiendaPerros', $data);
	}
	public function AlimentoPerros()
	{
		$this->load->model('Productos_model');
		$data['productos'] = $this->Productos_model->obtener_alimento_perros();
		$this->load->view('Perros/Alimento', $data);
	}
	public function AlimentoSecoPerros()
	{
		$this->load->model('Productos_model');
		$data['productos'] = $this->Productos_model->obtener_productos_perros_seco();
		$this->load->view('Perros/Alimento_Seco', $data);
	}
	public function AlimentoHumedoPerros()
	{
		$this->load->model('Productos_model');
		$data['productos'] = $this->Productos_model->obtener_productos_perros_humedo();
		$this->load->view('Perros/Alimento_Seco', $data);
	}
	public function AccesoriosPerros()
	{
		$this->load->model('Productos_model');
		$data['productos'] = $this->Productos_model->obtener_accesorios_perros();
		$this->load->view('Perros/Accesorios', $data);
	}
	public function JuguetesPerros()
	{
		$this->load->model('Productos_model');
		$data['productos'] = $this->Productos_model->obtener_juguetes_perros();
		$this->load->view('Perros/Juguetes', $data);

	}
	public function HigienePerros()
	{
		$this->load->model('Productos_model');
		$data['productos'] = $this->Productos_model->obtener_higiene_perros();
		$this->load->view('Perros/Higiene', $data);
	}
	public function detallesperro($producto_id)
	{
		$data['producto'] = $this->Productos_model->obtenerProductoPorId($producto_id);
		$this->load->view('Perros/detalles', $data);
	}
	public function detallesgato($producto_id)
	{
		$data['producto'] = $this->Productos_model->obtenerProductoPorId($producto_id);
		$this->load->view('Gatos/detalles', $data);
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
	public function eliminarProducto($id)
	{
		if ($this->Productos_model->delete_producto($id)) {
			redirect('Welcome/adminProductos'); // Redirigir después de eliminar
		} else {
			show_error('No se pudo eliminar el producto.');
		}
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
		// Cargar el modelo
		$this->load->model('Productos_model');

		// Obtener los productos del carrito
		$productos = $this->session->userdata('carrito');

		// Calcular el total
		$total = 0;
		if (!empty($productos)) {
			foreach ($productos as $producto) {
				$total += $producto['precio_con_descuento'] * $producto['cantidad'];
			}
		}

		// Pasar los datos a la vista
		$data['productos'] = $productos;
		$data['total'] = $total;

		// Cargar la vista
		$this->load->view('carrito', $data);
	}



	public function eliminar_producto($producto_id)
	{
		$this->load->model('Productos_model');
		$this->Productos_model->eliminar_del_carrito($producto_id);
		redirect('Welcome/carrito');
	}



	public function vaciar_carrito()
	{
		$this->load->model('Productos_model');
		$this->Productos_model->vaciar_carrito();
		redirect('Welcome/carrito'); // Redirige a la vista del carrito
	}
	public function ofertas()
	{
		$this->load->model('Productos_model');
		$data['productos'] = $this->Productos_model->obtener_productos();
		$this->load->view('ofertas', $data);
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

		// Verificar si el cliente ya existe
		$cliente = $this->Cliente_model->buscar_cliente_por_ci($data['ci']);
		log_message('debug', 'Cliente encontrado: ' . json_encode($cliente));

		if (!$cliente) {
			// Si el cliente no existe, crear uno nuevo
			$cliente_id = $this->Cliente_model->guardar_cliente($data);
			log_message('debug', 'Nuevo cliente creado con ID: ' . $cliente_id);
		} else {
			// Si el cliente ya existe, usar el ID del cliente existente
			$cliente_id = $cliente->cliente_id;
			log_message('debug', 'Cliente existente con ID: ' . $cliente_id);
		}

		// Obtener el carrito
		$this->load->library('session');
		$carrito = $this->session->userdata('carrito');
		log_message('debug', 'Carrito recibido: ' . json_encode($carrito));

		if (empty($carrito)) {
			echo json_encode(['status' => 'error', 'message' => 'Carrito vacío']);
			return;
		}

		// Preparar los detalles del pedido
		$fecha_pedido = date('Y-m-d H:i:s');
		log_message('debug', 'Fecha del pedido: ' . $fecha_pedido);

		// Guardar el pedido
		$pedido_id = $this->Pedido_model->guardar_pedido($cliente_id, $fecha_pedido);
		log_message('debug', 'ID del pedido guardado: ' . $pedido_id);

		if (!$pedido_id) {
			echo json_encode(['status' => 'error', 'message' => 'Error al guardar el pedido']);
			return;
		}

		// Guardar los detalles del pedido
		foreach ($carrito as $producto) {
			if (!$this->Pedido_model->guardar_detalle_pedido($pedido_id, $producto['producto_id'], $producto['cantidad'])) {
				echo json_encode(['status' => 'error', 'message' => 'Error al guardar los detalles del pedido']);
				return;
			}
		}

		// Limpiar el carrito después de realizar el pedido
		$this->session->unset_userdata('carrito');

		echo json_encode(['status' => 'success']);
	}




}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('login_model');
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
	public function TiendaGatos()
	{
		$lista = $this->login_model->listaproductos();
        $data['productos'] = $lista;
		$this->load->view('TiendaGatos', $data);
	}
	public function TiendaPerros()
	{
		$lista = $this->login_model->listaproductos();
        $data['productos'] = $lista;
		$this->load->view('TiendaPerros', $data);
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
            redirect('login/adminProductos');
        } else {
            show_error('No se pudo actualizar el producto.');
        }
    }
	public function eliminarProducto($id)
    {
        if ($this->Productos_model->delete_producto($id)) {
            redirect('login/adminProductos'); // Redirigir después de eliminar
        } else {
            show_error('No se pudo eliminar el producto.');
        }
    }
}

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
        $lista = $this->login_model->listaproductos();
        $data['productos'] = $lista;
        $this->load->view('producto', $data);
    }
}

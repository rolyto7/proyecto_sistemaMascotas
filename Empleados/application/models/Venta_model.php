<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Venta_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function insert_venta($data)
    {
        return $this->db->insert('venta', $data);
    }

    public function update_detalles_estado($pedido_id, $estado)
    {
        $this->db->set('estado', $estado);
        $this->db->where('pedido_id', $pedido_id);
        $this->db->update('detalles_pedidos');
    }
}

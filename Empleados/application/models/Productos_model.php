<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Productos_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
    }
    public function get_producto($id)
    {
        $query = $this->db->get_where('productos', array('producto_id' => $id));
        return $query->row_array();
    }
    public function get_productos_by_id($producto_id)
    {
        $this->db->where('producto_id', $producto_id);
        $query = $this->db->get('productos');
        return $query->row_array();
    }

    public function vaciar_carrito()
    {
        $this->session->unset_userdata('carrito');
    }
    public function obtenerProductos()
    {
        $query = $this->db->get('productos');
        return $query->result();
    }
    public function obtener_productos()
    {
        $query = $this->db->get('productos');
        return $query->result();
    }
    public function obtenerProducto()
    {
        $query = $this->db->get('productos');
        return $query->result_array();
    }

    public function agregarProducto($data)
    {
        $this->db->insert('productos', $data);
    }

    public function obtenerProductoPorId($id)
    {
        $query = $this->db->get_where('productos', array('producto_id' => $id));
        return $query->row_array();
    }

    public function update_producto($id, $data)
    {
        $this->db->where('producto_id', $id);
        return $this->db->update('productos', $data);
    }

    public function delete_producto($id)
    {
        $this->db->where('producto_id', $id);
        return $this->db->delete('productos');
    }

    // Funciones para obtener Productos de Gatos
    public function obtener_accesorios_gatos()
    {
        $this->db->where('mascota', 'gato');
        $this->db->where('categoria', 'Accesorios');
        $query = $this->db->get('productos');
        return $query->result();
    }
    public function obtener_productos_gatos()
    {
        $this->db->where('mascota', 'gato');
        $query = $this->db->get('productos');
        return $query->result();
    }
    public function obtener_alimento_gatos()
    {
        $this->db->where('mascota', 'gato');
        $this->db->where('categoria', 'Alimentos');
        $query = $this->db->get('productos');
        return $query->result();
    }
    public function obtener_juguetes_gatos()
    {
        $this->db->where('mascota', 'gato');
        $this->db->where('categoria', 'Juguetes');
        $query = $this->db->get('productos');
        return $query->result();
    }
    public function obtener_higiene_gatos()
    {
        $this->db->where('mascota', 'gato');
        $this->db->where('categoria', 'Estetica E Higiene');
        $query = $this->db->get('productos');
        return $query->result();
    }

    // Funciones para obtener Productos de Perros 
    public function obtener_productos_perros()
    {
        $this->db->where('mascota', 'perro');
        $query = $this->db->get('productos');
        return $query->result();
    }
    public function obtener_alimento_perros()
    {
        $this->db->where('mascota', 'perro');
        $this->db->where('categoria', 'Alimentos');
        $query = $this->db->get('productos');
        return $query->result();
    }
    public function obtener_productos_perros_seco()
    {
        $this->db->where('mascota', 'perro');
        $this->db->where('tipo', 'Alimento Seco');
        $query = $this->db->get('productos');
        return $query->result();
    }
    public function obtener_productos_perros_humedo()
    {
        $this->db->where('mascota', 'perro');
        $this->db->where('tipo', 'Alimento Humedo');
        $query = $this->db->get('productos');
        return $query->result();
    }
    public function obtener_accesorios_perros()
    {
        $this->db->where('mascota', 'perro');
        $this->db->where('categoria', 'Accesorios');
        $query = $this->db->get('productos');
        return $query->result();
    }
    public function obtener_juguetes_perros()
    {
        $this->db->where('mascota', 'perro');
        $this->db->where('categoria', 'Juguetes');
        $query = $this->db->get('productos');
        return $query->result();
    }
    public function obtener_higiene_perros()
    {
        $this->db->where('mascota', 'perro');
        $this->db->where('categoria', 'Higiene');
        $query = $this->db->get('productos');
        return $query->result();
    }
    public function verificar_stock($producto_id, $cantidad)
    {
        $this->db->select('stock');
        $this->db->where('producto_id', $producto_id);
        $query = $this->db->get('productos');
        $producto = $query->row();

        return $producto && $producto->stock >= $cantidad;
    }

    public function actualizar_stock($producto_id, $cantidad)
    {
        $this->db->set('stock', 'stock - ' . (int) $cantidad, FALSE);
        $this->db->where('producto_id', $producto_id);
        $this->db->update('productos');
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Productos_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // Cargar la base de datos en el constructor
        $this->load->database();
    }
    public function get_producto($id)
    {
        $query = $this->db->get_where('productos', array('producto_id' => $id));
        return $query->row_array();
    }
    // Obtener todos los productos
    public function obtenerProductos()
    {
        $query = $this->db->get('productos'); // Suponiendo que 'productos' es tu tabla
        return $query->result(); // Devuelve un array de objetos
    }



    // Agregar un nuevo producto
    public function agregarProducto($data)
    {
        return $this->db->insert('productos', $data);
    }

    // Obtener un producto por su ID
    public function obtenerProductoPorId($id)
    {
        $query = $this->db->get_where('productos', array('producto_id' => $id));
        return $query->row_array(); // Retorna el resultado como un array
    }
    // Actualizar producto
    public function update_producto($id, $data)
    {
        $this->db->where('producto_id', $id);
        return $this->db->update('productos', $data);
    }

    // Eliminar producto
    public function delete_producto($id)
    {
        $this->db->where('producto_id', $id);
        return $this->db->delete('productos');
    }
}

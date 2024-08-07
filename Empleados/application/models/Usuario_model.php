<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuario_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    // Obtener usuario por ID
    public function get_usuario($id)
    {
        $query = $this->db->get_where('usuario', array('id' => $id));
        return $query->row_array();
    }
    public function validarusuario($user, $password)
    {
        $this->db->where('email', $user);
        $query = $this->db->get('usuario');

        if ($query->num_rows() == 1) {
            $usuario = $query->row();
            if (password_verify($password, $usuario->contrasena)) {
                return true;
            }
        }

        return false;
    }
    public function update_usuario($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('usuario', $data);
    }
    // Obtener todos los usuarios
    public function obtenerUsuarios()
    {
        $query = $this->db->get('usuario');
        return $query->result_array(); // Retorna el resultado como un array de arrays
    }

    // Obtener un usuario por su ID
    public function obtenerUsuarioPorId($id)
    {
        $query = $this->db->get_where('usuario', array('id' => $id));
        return $query->row_array(); // Retorna el resultado como un array
    }
    public function delete_usuario($id)
    {
        $data = array('estadoUsuario' => 0); // Cambiar el estado a 0
        $this->db->where('id', $id);
        return $this->db->update('usuario', $data);
    }
}

<?php
class Reportes_model extends CI_Model
{
    // Reportes_model.php
    // Reportes_model.php

    public function get_reporte($usuario_id, $fecha_inicio, $fecha_fin)
    {
        $this->db->select('v.*, v.fechaVenta AS fecha_entrega, u.nombre AS nombre_usuario, u.primerApellido AS apellido_usuario, 
                           c.nombre AS nombre_cliente, c.primerApellido AS apellido_cliente, V.total AS total_pedido');
        $this->db->from('Venta v');
        $this->db->join('usuario u', 'v.usuario_id = u.id'); // Unión con la tabla de usuarios
        $this->db->join('Clientes c', 'v.cliente_id = c.cliente_id'); // Unión con la tabla de clientes

        // Filtrar por ID de usuario y fechas si se proporcionan
        if (!empty($usuario_id)) {
            $this->db->where('v.usuario_id', $usuario_id);
        }
        if (!empty($fecha_inicio)) {
            $this->db->where('v.fechaVenta >=', $fecha_inicio); // Filtrar por fecha de entrega
        }
        if (!empty($fecha_fin)) {
            $fecha_fin = date('Y-m-d', strtotime($fecha_fin . ' +1 day')); // Extender el rango al último día completo
            $this->db->where('v.fechaVenta <', $fecha_fin); // Filtrar por fecha de entrega
        }

        $query = $this->db->get();
        return $query->result();
    }



    public function get_reporte_productos($producto_id = null, $categoria = null, $fecha_inicio = null, $fecha_fin = null)
    {
        $this->db->select('p.nombre AS producto, p.categoria AS categoria, p.precio, p.stock, 
                       COALESCE(SUM(d.cantidad), 0) AS cantidad_vendida, 
                       COALESCE(SUM(d.cantidad * p.precio), 0) AS total_vendido');
        $this->db->from('productos p');
        $this->db->join('detalles_pedidos d', 'p.producto_id = d.producto_id', 'left');
        $this->db->join('pedidos ped', 'd.pedido_id = ped.id', 'left');  // Añadir la unión con la tabla pedidos

        // Filtrar por producto, categoría y fechas
        if ($producto_id) {
            $this->db->where('p.producto_id', $producto_id);
        }
        if ($categoria) {
            $this->db->where('p.categoria', $categoria);
        }
        if ($fecha_inicio && $fecha_fin) {
            $this->db->where('ped.fechaPedido >=', $fecha_inicio);  // Cambiar 'd.fecha_pedido' por 'ped.fechaPedido'
            $this->db->where('ped.fechaPedido <=', $fecha_fin);  // Cambiar 'd.fecha_pedido' por 'ped.fechaPedido'
        }

        $this->db->group_by('p.producto_id');
        $query = $this->db->get();
        return $query->result();
    }




    public function get_most_sold_product()
    {
        $this->db->select('D.producto_id, COUNT(*) as cantidad_vendida');
        $this->db->from('detalles_pedidos D');
        $this->db->group_by('D.producto_id');
        $this->db->order_by('cantidad_vendida', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_products_sold_ordered($fecha_inicio = null, $fecha_fin = null)
    {
        $this->db->select('p.producto_id, p.nombre, p.mascota, p.categoria, SUM(d.cantidad) as total_vendida, v.fechaVenta');
        $this->db->from('detalles_pedidos d');
        $this->db->join('productos p', 'd.producto_id = p.producto_id');
        $this->db->join('pedidos ped', 'd.pedido_id = ped.id');
        $this->db->join('venta v', 'ped.id = v.pedido_id'); // Unir con la tabla venta para obtener la fecha de venta

        if (!empty($fecha_inicio)) {
            $this->db->where('ped.fechaPedido >=', $fecha_inicio);
        }
        if (!empty($fecha_fin)) {
            $fecha_fin = date('Y-m-d', strtotime($fecha_fin . ' +1 day'));
            $this->db->where('ped.fechaPedido <', $fecha_fin);
        }

        $this->db->group_by('p.producto_id, v.fechaVenta'); // Agrupar por producto y fecha de venta
        $this->db->order_by('total_vendida', 'DESC');
        $this->db->limit(10); // Limitar a 10 productos

        $query = $this->db->get();
        return $query->result_array();
    }







}
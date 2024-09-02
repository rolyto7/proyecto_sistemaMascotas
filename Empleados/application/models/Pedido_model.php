<?php
class Pedido_model extends CI_Model
{

    public function guardar_pedido($cliente_id, $fecha_pedido)
    {
        $data = array(
            'cliente_id' => $cliente_id,
            'fechaPedido' => $fecha_pedido
        );

        $this->db->insert('pedidos', $data);
        $insert_id = $this->db->insert_id();
        log_message('debug', 'ID del pedido insertado: ' . $insert_id);
        return $insert_id;
    }

    public function guardar_detalle_pedido($pedido_id, $producto_id, $cantidad)
    {
        $data = array(
            'pedido_id' => $pedido_id,
            'producto_id' => $producto_id,
            'cantidad' => $cantidad
        );

        $result = $this->db->insert('detalles_pedidos', $data);
        log_message('debug', 'Resultado de la inserción del detalle del pedido: ' . ($result ? 'Éxito' : 'Error'));
        return $result;
    }
    public function get_pedidos($ci = null)
    {
        $this->db->select('detalles_pedidos.pedido_id,
                        Clientes.nombre AS cliente_nombre, 
                        Clientes.ci AS cliente_ci, 
                        productos.nombre AS producto_nombre, 
                        detalles_pedidos.cantidad AS cantidad,
                        CASE detalles_pedidos.estado
                            WHEN 1 THEN \'Pendiente\'
                            WHEN 2 THEN \'Cancelado\'
                            WHEN 3 THEN \'Completado\'
                            ELSE \'Desconocido\'
                        END AS estado,
                        productos.precio AS precio, 
                        pedidos.fechapedido AS fecha_pedido,
                        (detalles_pedidos.cantidad * productos.precio) AS total');
        $this->db->from('detalles_pedidos');
        $this->db->join('pedidos', 'detalles_pedidos.pedido_id = pedidos.id');
        $this->db->join('Clientes', 'pedidos.cliente_id = Clientes.cliente_id');
        $this->db->join('productos', 'detalles_pedidos.producto_id = productos.producto_id');

        // Si se proporciona un CI, filtra los resultados
        if ($ci) {
            $this->db->where('clientes.ci', $ci);
        }

        $query = $this->db->get();
        return $query->result_array();
    }

    public function actualizar_estado_pedido($pedido_id, $estado)
    {
        $this->db->where('pedido_id', $pedido_id);
        return $this->db->update('detalles_pedidos', array('estado' => $estado));
    }
    public function get_pedido_by_id($pedido_id)
    {
        $this->db->select('pedidos.id AS pedido_id, 
                            pedidos.cliente_id, 
                            pedidos.fechaPedido AS fecha_pedido,
                            (SUM(detalles_pedidos.cantidad * productos.precio)) AS total');
        $this->db->from('pedidos');
        $this->db->join('detalles_pedidos', 'pedidos.id = detalles_pedidos.pedido_id');
        $this->db->join('productos', 'detalles_pedidos.producto_id = productos.producto_id');
        $this->db->where('pedidos.id', $pedido_id);
        $this->db->group_by('pedidos.id');

        $query = $this->db->get();
        return $query->row_array(); // Usa row_array para un solo resultado
    }


    public function update_estado_pedido($pedido_id, $estado)
    {
        $this->db->where('id', $pedido_id);
        $this->db->update('pedidos', ['estado' => $estado]);
    }
}

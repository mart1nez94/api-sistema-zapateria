<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos_model extends CI_Model {
    function  __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function obtenerStock() {
        $this->db->select('productos.id');
        $this->db->select('productos.nombre');
        $this->db->select('marcas.nombre AS nombre_marca');
        $this->db->select('productos.precio');
        $this->db->select('productos.valoracion');
        $this->db->select('productos.fecha');
        $this->db->from('productos');
        $this->db->join('marcas', 'marcas.id = productos.id_marca');
        $query = $this->db->get();
        return $query->result_object();
    }

    public function insertStock($usuario, $producto) {
        $datos = array(
            'usuario_id' => $usuario,
            'producto_id' => $producto
        );
        $this->db->insert('carrito', $datos);
        return $this->db->affected_rows();
    }
}
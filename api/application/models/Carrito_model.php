<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carrito_model extends CI_Model {
    function  __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function selectArticulos($codigo) {
        $this->db->select('productos.codigo');
        $this->db->select('productos.nombre');
        $this->db->select('marcas.nombre AS marca');
        $this->db->select('productos.talla');
        $this->db->select('productos.precio');
        $this->db->from('productos');
        $this->db->where('productos.codigo', $codigo);
        $this->db->join('marcas', 'marcas.id = productos.marca');
        $query = $this->db->get(); 
        return $query->result_object();
    }

    public function insertArticulos($codigo, $producto, $marca, $talla, $precio) {
        $datos = array(
            'codigo' => $codigo,
            'nombre' => $producto,
            'marca' => $marca,
            'talla' => $talla,
            'precio' => $precio
        );
        $this->db->insert('productos', $datos);
        return $this->db->affected_rows();
    }
}
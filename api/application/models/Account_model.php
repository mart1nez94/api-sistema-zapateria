<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_model extends CI_Model {
    function  __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function selectUsuarioA($usuario, $contraseña) {
        $this->db->select('id');
        $this->db->from('usuarios');
        $this->db->where('usuario', $usuario);
        $this->db->where('password', $contraseña);
        $query = $this->db->get(); 
        return $query->num_rows();
    }

    public function selectUsuario($usuario, $contraseña) {
        $this->db->select('id');
        $this->db->select('usuario');
        $this->db->from('usuarios');
        $this->db->where('usuario', $usuario);
        $this->db->where('password', $contraseña);
        $query = $this->db->get();
        return $query->row();
    }
}
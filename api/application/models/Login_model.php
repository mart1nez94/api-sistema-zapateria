<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {
    function  __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function selectUsuarios($usuario, $contraseña) {
        $this->db->select('id');
        $this->db->from('usuarios');
        $this->db->where('usuario', $usuario);
        $this->db->where('contraseña', $contraseña);
        $query = $this->db->get(); 
        return $query->num_rows();
    }

    public function selectUsuario($usuario, $contraseña) {
        $this->db->select('usuarios.id');
        $this->db->select('usuarios.nombre');
        $this->db->select('usuarios.apellido');
        //$this->db->select('usuarios.usuario');
        //$this->db->select('usuarios.contraseña');
        //$this->db->select('tipo_usuarios.nombre AS tipo_usuario');
        //$this->db->select('grupos.nombre AS grupo');
        //$this->db->select('grupos.id AS grupo_id');
        $this->db->from('usuarios');
        //$this->db->join('tipo_usuarios', 'tipo_usuarios.id = usuarios.tipo_usuario_id');
        //$this->db->join('grupos', 'grupos.id = usuarios.grupo_id');
        $this->db->where('usuario', $usuario);
        $this->db->where('contraseña', $contraseña);
        $query = $this->db->get();
        return $query->row();
    }
}
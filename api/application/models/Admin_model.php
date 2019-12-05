<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
    function  __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function selectPermisos() {
        $this->db->select('permisos.id');
        $this->db->select('permisos.nombre');
        $this->db->select('usuarios.usuario AS administrador');
        $this->db->select('permisos.fecha_ingreso');
        $this->db->from('permisos');
        $this->db->join('usuarios', 'usuarios.id = permisos.administrador_id');
        $query = $this->db->get(); 
        return $query->result_object();
    }
    
    public function insertPermisos($nombre, $administrador) {
        $datos = array(
            'nombre'           => $nombre,
            'administrador_id' => $administrador
        );
        $this->db->insert('permisos', $datos);
        return $this->db->affected_rows();
    }

    public function selectGrupos() {
        $this->db->select('id');
        $this->db->select('nombre');
        $this->db->select('administrador_id');
        $this->db->select('fecha_ingreso');
        $this->db->from('grupos');
        $query = $this->db->get(); 
        return $query->result_object();
    }

    public function insertGrupos($nombre, $administrador) {
        $datos = array(
            'nombre'           => $nombre,
            'administrador_id' => $administrador
        );
        $this->db->insert('grupos', $datos);
        return $this->db->affected_rows();
    }

    public function insertGruposAsignacion($grupo, $permiso) {
        $datos = array(
            'grupo_id'   => $grupo,
            'permiso_id' => $permiso
        );
        $this->db->insert('grupos_asignacion', $datos);
        return $this->db->affected_rows();
    }

    public function deleteGruposAsignacion($grupo, $permiso) {
        $datos = array(
            'grupo_id'   => $grupo,
            'permiso_id' => $permiso
        );
        $this->db->delete('grupos_asignacion', $datos);
        return $this->db->affected_rows();
    }

    public function selectAsignados($grupo) {
        $this->db->select('grupos_asignacion.permiso_id');
        $this->db->select('permisos.nombre AS permiso');
        $this->db->from('grupos_asignacion');
        $this->db->join('permisos', 'permisos.id = grupos_asignacion.permiso_id');
        $this->db->where('grupo_id', $grupo);
        $query = $this->db->get(); 
        return $query->result_object();
    }

    public function insertUsuarios($usuario, $contraseña, $grupo) {
        $datos = array(
            'usuario'         => $usuario . '@sistema.com',
            'contraseña'      => $contraseña,
            'tipo_usuario_id' => '2',
            'grupo_id'        => $grupo
        );
        $this->db->insert('usuarios', $datos);
        return $this->db->affected_rows();
    }
}
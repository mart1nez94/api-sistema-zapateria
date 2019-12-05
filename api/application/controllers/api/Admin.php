<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Admin extends CI_Controller{
    use REST_Controller {
        REST_Controller::__construct as private __resTraitConstruct;
    }

    function __construct() {
        parent::__construct();
        $this->__resTraitConstruct();
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        header("Allow: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == "OPTIONS") {
            die();
        }        
        $this->load->model('Admin_model');
    }

    /**
     * Layout: Permisos
     * Module: Admin
     */
    public function permisos_get() {
        $respuesta = new stdClass;
        $respuesta = $this->Admin_model->selectPermisos();
        if(!$respuesta) {
            $this->response('', 204);
        } else {
            $this->response($respuesta, 200);
        }
    }

    /**
     * Layout: Permisos
     * Module: Admin
     */
    public function permisos_post() {
        $respuesta = $this->Admin_model->insertPermisos($this->post('nombre'), $this->post('administrador'));
        if($respuesta >= 1) {
            $this->response($respuesta, 201);
        } else {
            $this->response($respuesta, 409);
        }
    }

    /**
     * Layout: Grupos
     * Module: Admin
     */
    public function grupos_get() {
        $respuesta = new stdClass;
        $respuesta = $this->Admin_model->selectGrupos();
        if(!$respuesta) {
            $this->response('', 204);
        } else {
            $this->response($respuesta, 200);
        }
    }

    /**
     * Layout: Grupos
     * Module: Admin
     */
    public function grupos_post() {
        $respuesta = $this->Admin_model->insertGrupos($this->post('nombre'), $this->post('administrador'));
        if($respuesta >= 1) {
            $this->response($respuesta, 201);
        } else {
            $this->response($respuesta, 409);
        }
    }

    /**
     * Layout: Grupos
     * Module: Admin
     */
    public function asignados_get($grupo) {
        $respuesta = new stdClass;
        $respuesta = $this->Admin_model->selectAsignados($grupo);
        if(!$respuesta) {
            $this->response('', 204);
        } else {
            $this->response($respuesta, 200);
        }
    }

    /**
     * Layout: Grupos
     * Module: Admin
     */
    public function asignados_put()
    {
        if($this->put('estado') == 1) {
            $respuesta = $this->Admin_model->insertGruposAsignacion($this->put('grupo'), $this->put('permiso'));
            if($respuesta >= 1) {
                $this->response($respuesta, 201);
            } else {
                $this->response($respuesta, 409);
            }
        } else {
            $respuesta = $this->Admin_model->deleteGruposAsignacion($this->put('grupo'), $this->put('permiso'));
            if($respuesta >= 1) {
                $this->response($respuesta, 201);
            } else {
                $this->response($respuesta, 409);
            }
        }
    }

    /**
     * Layout: Usuarios
     * Module: Admin
     */
    public function usuarios_post()
    {
        $respuesta = $this->Admin_model->insertUsuarios($this->post('usuario'), $this->post('contraseña'), $this->post('grupo'));
        if($respuesta >= 1) {
            $this->response($respuesta, 201);
        } else {
            $this->response($respuesta, 409);
        }
    }
}  
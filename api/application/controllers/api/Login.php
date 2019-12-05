<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Login extends CI_Controller {
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
        $this->load->model('Login_model');
    }

    /**
     * Layout: Login
     * Module: Login
     */
    public function usuarios_get($usuario, $contraseña) {
        $respuesta = $this->Login_model->selectUsuarios($usuario, $contraseña);
        if($respuesta == 0) {
            $this->response(1, 204);
        } else {
            $this->response($respuesta, 200);
        }
    }

    /**
     * Layout: Login
     * Module: Login
     */
    public function usuario_post() {
        $respuesta = $this->Login_model->selectUsuario($this->post('usuario'), $this->post('contraseña'));
        if(!$respuesta) {
            $this->response('', 204);
        } else {
            $this->response($respuesta, 200);
        }
    }
}    
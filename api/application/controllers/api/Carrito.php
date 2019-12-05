<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Carrito extends CI_Controller{
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
        $this->load->model('Carrito_model');
    }

    public function articulos_get($codigo) {
        $resultados = $this->Carrito_model->selectArticulos($codigo);

        return $this->response($resultados, 200);
    }

    public function articulos_post() {
        $respuesta = $this->Carrito_model->insertArticulos($this->post('codigo'), $this->post('producto'), $this->post('marca'), $this->post('talla'), $this->post('precio'));
        if($respuesta >= 1) {
            $this->response($respuesta, 201);
        } else {
            $this->response($respuesta, 409);
        }
    }
}  
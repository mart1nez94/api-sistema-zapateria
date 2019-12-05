<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Productos extends CI_Controller{
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
        $this->load->model('Productos_model');
    }

    public function stock_get() {
        $resultados = $this->Productos_model->obtenerStock();

        return $this->response($resultados, 200);
    }

    public function stock_post() {
        $respuesta = $this->Productos_model->insertStock($this->post('usuario'), $this->post('producto'));
        if($respuesta >= 1) {
            $this->response($respuesta, 201);
        } else {
            $this->response($respuesta, 409);
        }
    }
}  
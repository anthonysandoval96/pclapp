<?php
class Register extends Controller {

    public $response;
    public $operation;
    public $route_view = 'usuario';
    
    public function __construct() {
        $this->usuarioModelo = parent::modeloUsuario();
    }
    /******************************************************/
    public function index() {
        $data = [
            'titulo' => 'Registro',
            'name_route' => $this->route_view
        ];
        $this->view($this->route_view . '/create', $data);
    }
    /******************************************************/
    public function insert() {
        if (isset($_SESSION["user_register"])) {
            $this->response = $this->usuarioModelo->insertar();
            session_unset();
            $this->process_result('create');
        }
    }
    /******************************************************/
    public function payment_response() {
        $this->response = $this->usuarioModelo->respuesta_izipay();
        if (!$this->response) {
            $data = ['title' => 'Login'];
            $this->view('access/login', $data);
        } else {
            $datos = [
                "respuesta" => $this->response
            ];
            $this->view($this->route_view . '/response_payment', $datos);
        }
    }
    /******************************************************/
    public function cap_sesion_user_register() {
        $_SESSION["user_register"] = $_POST;
    }
    /******************************************************/
    public function realizarpago() {
        if (isset($_SESSION["user_register"])) {
            $datos = [
                'title' => "Realizar pago"
            ];
            $this->view($this->route_view . '/realizarpago', $datos);
        }
    }
}
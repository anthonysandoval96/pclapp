<?php
class Register extends Controller {

    public $response;
    public $operation;
    public $route_view = 'usuario';
    
    public function __construct() {
        $this->usuarioModelo = parent::modeloUsuario();
        if ($this->usuarioModelo->isLoggedIn('0')) header('Location: home');
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
        $this->response = $this->usuarioModelo->insertar();
        session_unset();
        $this->process_result('create');
    }
    /******************************************************/
    public function payment_response() {
        $this->response = $this->usuarioModelo->respuesta_izipay();
        if (!$this->response) header('Location: ' . BASE_URL . 'login');
        $datos = [
            "respuesta" => $this->response
        ];
        $this->view($this->route_view . '/response_payment', $datos);
    }
    /******************************************************/
    public function cap_sesion_user_register() {
        $_SESSION["user_register"] = $_POST;
    }
    /******************************************************/
    public function realizarpago() {
        $datos = [
            'title' => "Realizar pago"
        ];
        $this->view($this->route_view . '/realizarpago', $datos);
    }
}
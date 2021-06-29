<?php

class Login extends Controller {

    public $response;
    public $operation;
    public $title_route_main;
    public $route_view = 'access';
    public $name_controller = 'login';
    
    public function __construct() {
        $this->usuarioModelo = parent::modeloUsuario();
        $this->title_route_main = 'Login';
        if ($this->usuarioModelo->isLoggedIn('0')) header('Location: home');
        $this->currentModel = $this->model(getPluralPrase($this->name_controller));
    }
    /******************************************************/
    public function index() {
        $data = ['title' => $this->title_route_main];
        $this->view($this->route_view . '/login', $data);
    }
    /******************************************************/
    public function loginer() {
        $respuesta = $this->currentModel->login();
        $datos = ['respuesta' => $respuesta[0], 'mensaje' => $respuesta[1]];
        echo json_encode($datos);
    }
    /******************************************************/
    public function logut() {
        unset($_SESSION["sesion_diaria"]);
        session_destroy();
    }

}
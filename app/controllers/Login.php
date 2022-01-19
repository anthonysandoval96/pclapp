<?php

class Login extends Controller {

    public $response;
    public $operation;
    public $title_route_main;
    public $route_view = 'access';
    public $name_controller = 'login';
    
    public function __construct() {
        $this->usuario_id = (isset($_SESSION["usuario_id"])) ? $_SESSION["usuario_id"] : "";
        $this->usuarioModelo = parent::modeloUsuario();
        $this->title_route_main = 'Login';
        $this->currentModel = $this->model(getPluralPrase($this->name_controller));
    }
    /******************************************************/
    public function index() {
        if (!$this->usuarioModelo->accessPermission()) {
            $data = ['title' => $this->title_route_main];
            $this->view($this->route_view . '/login', $data);
        } else {
            $data = [
                'title' => "Bienvenido",
                'controller' => 'home',
                'userlogued' => $this->usuarioModelo->userLoggedData()
            ];
            if ($this->usuario_id == 1) {
                $this->view('homeadmin', $data);
            } else {
                $this->view('home', $data);
            }
        }
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
    /******************************************************/
    public function forgot() {
        $data = [
            'title' => 'Recuperar contraseña',
            'controller' => $this->route_view
        ];
        $this->view($this->route_view . '/forgot', $data);
    }

    public function recuperarContrasena() {
        $this->response = $this->usuarioModelo->recuperarContrasena();
        $this->process_result('update');
    }

}
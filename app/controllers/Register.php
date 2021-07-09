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
}
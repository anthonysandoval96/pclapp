<?php
class Usuario extends Controller {

    public $response;
    public $operation;
    public $title_route_main;
    public $route_view = 'usuario';
    
    public function __construct() {
        $this->currentModel = $this->model(getPluralPrase($this->route_view));
        $this->currentModel->isLoggedIn();
        $this->title_route_main = 'Administrar '.getPluralPrase($this->route_view, 'may');
    }
    /******************************************************/
    public function index() {
        $data = [
            'title' => $this->title_route_main,
            'controller' => $this->route_view
        ];
        $this->view($this->route_view.'/manage', $data);
    }
    /******************************************************/
    public function getRegistros() {
        $this->response = $this->currentModel->getUsuariosAll();
        print_r($this->response);
    }
    /******************************************************/
    public function get_sesiones() {
        $this->response = $this->currentModel->getSesiones("array");
        echo json_encode($this->response);
    }
    /******************************************************/
    public function perfil() {
        $datos = [
            'title' => "Perfil de Usuario",
            'controller' => $this->route_view,
            'userlogued' => $this->currentModel->userLoggedData()
        ];
        $this->view($this->route_view . '/perfil', $datos);
    }
    /******************************************************/
    public function updatePerfil() {
        $this->response = $this->currentModel->editarPerfil();
        $this->process_result('update');
    }
    /******************************************************/
    public function historial() {
        $datos = [
            'title' => "Historial de palabras",
            'controller' => $this->route_view,
            'userlogued' => $this->currentModel->userLoggedData(),
            'palabras_aprendidas' => $this->currentModel->palabrasAprendidas()
        ];
        $this->view($this->route_view . '/historial', $datos);
    }
    /******************************************************/
    public function changePassword() {
        $this->response = $this->currentModel->cambiarContrasena();
        $this->process_result('update');
    }
}
<?php
class Usuario extends Controller {

    public $response;
    public $operation;
    public $title_route_main;
    public $route_view = 'usuario';
    
    public function __construct() {
        $this->currentModel = $this->model(getPluralPrase($this->route_view));
        $this->title_route_main = 'Administrar '.getPluralPrase($this->route_view, 'may');
    }
    /******************************************************/
    public function index() {
        if (!$this->currentModel->accessPermission()) {
            $data = ['title' => 'Login'];
            $this->view('access/login', $data);
        } else {
            $data = [
                'title' => $this->title_route_main,
                'controller' => $this->route_view
            ];
            $this->view($this->route_view.'/manage', $data);
        }
    }
    /******************************************************/
    public function getRegistros() {
        if (!$this->currentModel->accessPermission()) {
            $data = ['title' => 'Login'];
            $this->view('access/login', $data);
        } else {
            $this->response = $this->currentModel->getUsuariosAll();
            print_r($this->response);
        }
    }
    /******************************************************/
    public function get_sesiones() {
        if (!$this->currentModel->accessPermission()) {
            $data = ['title' => 'Login'];
            $this->view('access/login', $data);
        } else {
            $this->response = $this->currentModel->getSesiones("array");
            echo json_encode($this->response);
        }
    }
    /******************************************************/
    public function perfil() {
        if (!$this->currentModel->accessPermission()) {
            $data = ['title' => 'Login'];
            $this->view('access/login', $data);
        } else {
            $datos = [
                'title' => "Perfil de Usuario",
                'controller' => $this->route_view,
                'userlogued' => $this->currentModel->userLoggedData()
            ];
            $this->view($this->route_view . '/perfil', $datos);
        }
    }
    /******************************************************/
    public function updatePerfil() {
        if (!$this->currentModel->accessPermission()) {
            $data = ['title' => 'Login'];
            $this->view('access/login', $data);
        } else {
            $this->response = $this->currentModel->editarPerfil();
            $this->process_result('update');
        }
    }
    /******************************************************/
    public function historial() {
        if (!$this->currentModel->accessPermission()) {
            $data = ['title' => 'Login'];
            $this->view('access/login', $data);
        } else {
            $datos = [
                'title' => "Historial de palabras",
                'controller' => $this->route_view,
                'userlogued' => $this->currentModel->userLoggedData(),
                'palabras_aprendidas' => $this->currentModel->palabrasAprendidas()
            ];
            $this->view($this->route_view . '/historial', $datos);
        }
    }
    /******************************************************/
    public function changePassword() {
        if (!$this->currentModel->accessPermission()) {
            $data = ['title' => 'Login'];
            $this->view('access/login', $data);
        } else {
            $this->response = $this->currentModel->cambiarContrasena();
            $this->process_result('update');
        }
    }
}
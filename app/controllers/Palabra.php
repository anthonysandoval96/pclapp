<?php
class Palabra extends Controller {

    public $response;
    public $operation;
    public $title_route_main;
    public $route_view = 'palabra';
    
    public function __construct() {
        $this->usuarioModelo = parent::modeloUsuario();
        $this->title_route_main = 'Administrar Palabras';
        $this->currentModel = $this->model(getPluralPrase($this->route_view));
    }
    /******************************************************/
    public function index() {
        if (!$this->usuarioModelo->accessPermission()) {
            $data = ['title' => 'Login'];
            $this->view('access/login', $data);
        } else {
            if (!$this->usuarioModelo->isAdmin()) {
                $data = [
                    'title' => 'Bienvenido',
                    'controller' => 'home',
                    'userlogued' => $this->usuarioModelo->userLoggedData()
                ];
                $this->view('home', $data);
            } else {
                $data = [
                    'title' => $this->title_route_main,
                    'controller' => $this->route_view
                ];
                $this->view($this->route_view."/manage", $data);
            }
        }
    }
    /******************************************************/
    public function getRegistros() {
        if (!$this->usuarioModelo->accessPermission()) {
            $data = ['title' => 'Login'];
            $this->view('access/login', $data);
        } else {
            if (!$this->usuarioModelo->isAdmin()) {
                $data = [
                    'title' => 'Bienvenido',
                    'controller' => 'home',
                    'userlogued' => $this->usuarioModelo->userLoggedData()
                ];
                $this->view('home', $data);
            } else {
                $this->response = $this->currentModel->getPalabrasAll();
                print_r($this->response);
            }
        }
    }
    /******************************************************/
    public function update() {
        if (!$this->usuarioModelo->accessPermission()) {
            $data = ['title' => 'Login'];
            $this->view('access/login', $data);
        } else {
            if (!$this->usuarioModelo->isAdmin()) {
                $data = [
                    'title' => 'Bienvenido',
                    'controller' => 'home',
                    'userlogued' => $this->usuarioModelo->userLoggedData()
                ];
                $this->view('home', $data);
            } else {
                $this->response = $this->currentModel->editar();
                $this->process_result('update', 'f');
            }
        }
    }
    /******************************************************/
    public function delete($id) {
        if (!$this->usuarioModelo->accessPermission()) {
            $data = ['title' => 'Login'];
            $this->view('access/login', $data);
        } else {
            if (!$this->usuarioModelo->isAdmin()) {
                $data = [
                    'title' => 'Bienvenido',
                    'controller' => 'home',
                    'userlogued' => $this->usuarioModelo->userLoggedData()
                ];
                $this->view('home', $data);
            } else {
                $this->response = $this->currentModel->eliminar($id);
                $this->process_result('delete', 'f');
            }
        }
    }
    /******************************************************/
    public function preview() {
        if (!$this->usuarioModelo->accessPermission()) {
            $data = ['title' => 'Login'];
            $this->view('access/login', $data);
        } else {
            if (!$this->usuarioModelo->isAdmin()) {
                $data = [
                    'title' => 'Bienvenido',
                    'controller' => 'home',
                    'userlogued' => $this->usuarioModelo->userLoggedData()
                ];
                $this->view('home', $data);
            } else {
                $this->response = $this->currentModel->previsualizar();
                echo json_encode($this->response);
            }
        }
    }
    /******************************************************/
    public function migration() {
        if (!$this->usuarioModelo->accessPermission()) {
            $data = ['title' => 'Login'];
            $this->view('access/login', $data);
        } else {
            if (!$this->usuarioModelo->isAdmin()) {
                $data = [
                    'title' => 'Bienvenido',
                    'controller' => 'home',
                    'userlogued' => $this->usuarioModelo->userLoggedData()
                ];
                $this->view('home', $data);
            } else {
                $this->response = $this->currentModel->migracion_bd();
                $this->process_result('create');
            }
        }
    }
}
<?php
class Sesion extends Controller {

    public $response;
    public $operation;
    public $title_route_main;
    public $route_view = 'sesion';

    public function __construct() {
        $this->usuarioModelo = parent::modeloUsuario();
        $this->title_route_main = 'Sesión de Palabras';
        $this->currentModel = $this->model(getPluralPrase($this->route_view));
    }
    /******************************************************/
    public function index() {
        if (!$this->usuarioModelo->accessPermission()) {
            $data = ['title' => 'Login'];
            $this->view('access/login', $data);
        } else {
            $data = [
                'title' => $this->title_route_main,
                'controller' => $this->route_view,
                'userlogued' => $this->usuarioModelo->userLoggedData()
            ];
            $this->view($this->route_view.'/manage', $data);
        }
    }
    /******************************************************/
    public function obtenerDatosSesion() {
        if (!$this->usuarioModelo->accessPermission()) {
            $data = ['title' => 'Login'];
            $this->view('access/login', $data);
        } else {
            $this->response = $this->currentModel->asignarSesion();
            echo json_encode($this->response);
        }
    }
    /******************************************************/
    public function cargarPalabrasDeSesion() {
        if (!$this->usuarioModelo->accessPermission()) {
            $data = ['title' => 'Login'];
            $this->view('access/login', $data);
        } else {
            $this->response = $this->currentModel->getPalabrasDeSesion();
            echo json_encode($this->response);
        }
    }
    /******************************************************/
    public function cargarSignificadoDePalabra($idword) {
        if (!$this->usuarioModelo->accessPermission()) {
            $data = ['title' => 'Login'];
            $this->view('access/login', $data);
        } else {
            $this->response = $this->currentModel->getSignificadoDePalabra($idword);
            echo json_encode($this->response);
        }
    }
    /******************************************************/
    public function seleccionarPalabrasConocidas() {
        if (!$this->usuarioModelo->accessPermission()) {
            $data = ['title' => 'Login'];
            $this->view('access/login', $data);
        } else {
            $this->response = $this->currentModel->selectKnownWords();
            echo $this->response;
        }
    }
    /******************************************************/
    public function actualizarSesion() {
        if (!$this->usuarioModelo->accessPermission()) {
            $data = ['title' => 'Login'];
            $this->view('access/login', $data);
        } else {
            $this->response = $this->currentModel->updateSesion();
            echo $this->response;
        }
    }
    /******************************************************/
    public function cambiarLetraYpalabras() {
        if (!$this->usuarioModelo->accessPermission()) {
            $data = ['title' => 'Login'];
            $this->view('access/login', $data);
        } else {
            $this->response = $this->currentModel->cambiarLetraYpalabras();
            $this->process_result();
        }
    }
    /******************************************************/
    public function actualizarParteDeSesion() {
        if (!$this->usuarioModelo->accessPermission()) {
            $data = ['title' => 'Login'];
            $this->view('access/login', $data);
        } else {
            $this->response = $this->currentModel->actualizarParteDeSesion();
        }
    }
}
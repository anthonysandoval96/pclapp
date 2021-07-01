<?php
class Sesion extends Controller {

    public $response;
    public $operation;
    public $title_route_main;
    public $route_view = 'sesion';

    public function __construct() {
        $this->usuarioModelo = parent::modeloUsuario();
        $this->usuarioModelo->isLoggedIn();
        $this->title_route_main = 'Sesión de Palabras';
        $this->currentModel = $this->model(getPluralPrase($this->route_view));
    }
    /******************************************************/
    public function index() {
        $data = [
            'title' => $this->title_route_main,
            'controller' => $this->route_view,
            'userlogued' => $this->usuarioModelo->userLoggedData()
        ];
        $this->view($this->route_view.'/manage', $data);
    }
    /******************************************************/
    public function obtenerDatosSesion() {
        $this->response = $this->currentModel->asignarSesion();
        echo json_encode($this->response);
    }
    /******************************************************/
    public function cargarPalabrasDeSesion() {
        $this->response = $this->currentModel->getPalabrasDeSesion();
        echo json_encode($this->response);
    }
    /******************************************************/
    public function cargarSignificadoDePalabra($idword) {
        $this->response = $this->currentModel->getSignificadoDePalabra($idword);
        echo json_encode($this->response);
    }
    /******************************************************/
    public function seleccionarPalabrasConocidas() {
        $this->response = $this->currentModel->selectKnownWords();
        echo $this->response;
    }
    /******************************************************/
    public function actualizarSesion() {
        $this->response = $this->currentModel->updateSesion();
        echo $this->response;
    }
    /******************************************************/
    public function cambiarLetraYpalabras() {
        $this->response = $this->currentModel->cambiarLetraYpalabras();
        $this->process_result();
    }
    /******************************************************/
    public function actualizarParteDeSesion() {
        $this->response = $this->currentModel->actualizarParteDeSesion();
    }
}
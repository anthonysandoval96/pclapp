<?php
class Home extends Controller {

    public $response;
    public $operation;
    public $title_route_main;
    public $route_view = 'home';
    
    public function __construct() {
        $this->usuario_id = (isset($_SESSION["usuario_id"])) ? $_SESSION["usuario_id"] : "";
        $this->usuarioModelo = parent::modeloUsuario();
        $this->usuarioModelo->isLoggedIn();
        $this->title_route_main = 'Bienvenido';
        $this->currentModel = $this->model(getPluralPrase($this->route_view));
        $this->model("sesiones")->asignarSesion();
    }
    /******************************************************/
    public function index() {
        if ($this->usuario_id == 1) {
            $data = [
                'title' => $this->title_route_main,
                'controller' => $this->route_view,
                'userlogued' => $this->usuarioModelo->userLoggedData()
            ];
            $this->view($this->route_view.'admin', $data);
        } else {
            $data = [
                'title' => $this->title_route_main,
                'controller' => $this->route_view,
                'userlogued' => $this->usuarioModelo->userLoggedData()
            ];
            $this->view($this->route_view, $data);
        }
    }
}
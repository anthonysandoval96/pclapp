<?php
class Home extends Controller {

    public $response;
    public $operation;
    public $title_route_main;
    public $route_view = 'home';
    
    public function __construct() {
        $this->usuario_id = (isset($_SESSION["usuario_id"])) ? $_SESSION["usuario_id"] : "";
        $this->usuarioModelo = parent::modeloUsuario();
        $this->title_route_main = 'Bienvenido';
        $this->currentModel = $this->model(getPluralPrase($this->route_view));
    }
    /******************************************************/
    public function index() {
        if (!$this->usuarioModelo->accessPermission()) {
            $data = ['title' => 'Login'];
            $this->view('access/login', $data);
        } else {
            if (!$this->usuarioModelo->isAdmin()) {
                $this->model("sesiones")->asignarSesion();
                $data = [
                    'title' => $this->title_route_main,
                    'controller' => $this->route_view,
                    'userlogued' => $this->usuarioModelo->userLoggedData()
                ];
                $this->view($this->route_view, $data);
            } else {
                $data = [
                    'title' => $this->title_route_main,
                    'controller' => $this->route_view,
                    'userlogued' => $this->usuarioModelo->userLoggedData()
                ];
                $this->view($this->route_view.'admin', $data);
            }
        }
    }
}
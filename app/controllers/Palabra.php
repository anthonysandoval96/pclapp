<?php
class Palabra extends Controller {

    public $response;
    public $operation;
    public $title_route_main;
    public $route_view = 'palabra';
    
    public function __construct() {
        $this->usuarioModelo = parent::modeloUsuario();
        $this->usuarioModelo->isLoggedIn();
        $this->title_route_main = 'Administrar Palabras';
        $this->currentModel = $this->model(getPluralPrase($this->route_view));
    }
    /******************************************************/
    public function index() {
        $data = [
            'title' => $this->title_route_main,
            'controller' => $this->route_view
        ];
        $this->view($this->route_view."/manage", $data);
    }
    /******************************************************/
    public function getRegistros() {
        $this->response = $this->currentModel->getPalabrasAll();
        print_r($this->response);
    }
    /******************************************************/
    public function update() {
        $this->response = $this->currentModel->editar();
        $this->process_result('update', 'f');
    }
    /******************************************************/
    public function delete($id) {
        $this->response = $this->currentModel->eliminar($id);
        $this->process_result('delete', 'f');
    }
    /******************************************************/
    public function preview() {
        $this->response = $this->currentModel->previsualizar();
        echo json_encode($this->response);
    }
    /******************************************************/
    public function migration() {
        $this->response = $this->currentModel->migracion_bd();
        $this->process_result('create');
    }
}
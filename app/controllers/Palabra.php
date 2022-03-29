<?php

use Illuminate\Support\Facades\URL;

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

    public function descargarPlantilla() {
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
                $archivo = FILES_ROUTE."PCL_Plantilla_Palabras.xlsx";
                // Nos aseguramos que el archivo exista
                if (!file_exists($archivo)) {
                    echo "El fichero $archivo no existe";
                    exit;
                }
                // Establecemos el nombre del archivo
                header('Content-Disposition: attachment;filename="PCL_Plantilla_Palabras.xlsx"');
                // Esto  
                // header("Content-Type: application/vnd.openxmlformats-   officedocument.spreadsheetml.sheet");
                // lo cambiamos por esto
                header('Content-Type: application/vnd.ms-excel');
                // Indicamos el tamaño del archivo 
                header('Content-Length: '.filesize($archivo));
                // Evitamos que sea cachedo 
                header('Cache-Control: max-age=0');
                // Realizamos la salida del fichero
                readfile($archivo);
                // Fin del cuento
                exit;
            }
        }
    }
}
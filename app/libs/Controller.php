<?php
require_once "../vendor/autoload.php";
use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Engines\PhpEngine;
use Illuminate\View\Factory;
use Illuminate\View\FileViewFinder;

class Controller {
    
    public $usuarioModelo;

    public function __construct() {
        print($this->controladorActual);
    }
    
    // Cargar modelo
    public function model($modelo) {
        // Carga
        require_once '../app/models/' . $modelo . '.php';
        
        //Instanciar el modelo
        return new $modelo();
    }

    function view($viewName, $templateData) {
        // Configuration
        // Note that you can set several directories where your templates are located
        $pathsToTemplates = [dirname(__DIR__, 1) . '/views'];
        $pathToCompiledTemplates = dirname(__DIR__, 1) . '/libs/cache';

        // Dependencies
        $filesystem = new Filesystem;
        $eventDispatcher = new Dispatcher(new Container);

        // Create View Factory capable of rendering PHP and Blade templates
        $viewResolver = new EngineResolver;
        $bladeCompiler = new BladeCompiler($filesystem, $pathToCompiledTemplates);

        $viewResolver->register('blade', function () use ($bladeCompiler) {
            return new CompilerEngine($bladeCompiler);
        });

        $viewResolver->register('php', function () {
            return new PhpEngine;
        });

        $viewFinder = new FileViewFinder($filesystem, $pathsToTemplates);
        $viewFactory = new Factory($viewResolver, $viewFinder, $eventDispatcher);

        //print_r($pathsToTemplates[0] . '/' . $viewName . '.blade.php');

        if (file_exists($pathsToTemplates[0] . '/' . $viewName . '.blade.php')) {
            // Render template
            echo $viewFactory->make($viewName, $templateData)->render();
        } else {
            // Si el archivo de la vista no existe.
            die('La vista no existe');
        }
    }
    
    public function modeloUsuario() {
        require_once '../app/models/usuarios.php';
        return new Usuarios();
    }

    public function process_result($action ='create', $gender = 'm') {
        if (gettype($this->response) !== 'boolean') {
            $message = $this->response[1];
            $this->response = $this->response[0];
        } else {
            $message = message($this->route_view, $action, $this->response, $gender);
        }
        $arreglo = array('respuesta' => $this->response, 'mensaje' => $message);
        echo json_encode($arreglo, JSON_UNESCAPED_UNICODE);
    }
}
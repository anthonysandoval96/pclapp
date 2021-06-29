<?php

error_reporting(0);

class Core {

    protected $controladorActual = 'Login';
    protected $metodoActual = 'index';
    protected $parametros = [];
    
    public function __construct() {

        $url = $this->getUrl();
        // Buscar en controladores, si el controlador existe.
        if (file_exists('../app/controllers/' . ucwords($url[0] . '.php'))) {
            // Si existe se setea como controlador por defecto
            $this->controladorActual = ucwords($url[0]);
            // unset indice
            unset($url[0]);
        }
        
        // requerir el controlador
        require_once '../app/controllers/' . $this->controladorActual . '.php';
        $this->controladorActual = new $this->controladorActual;
        
        if (isset($url[1])) {
            // chequear la segunda parte de la url que serie el método
            if (method_exists($this->controladorActual, $url[1])) {
                $this->metodoActual = $url[1];
                unset($url[1]);
            }
        }
        
        $this->parametros = $url ? array_values($url) : [];
        
        // llamar callback con parametros array
        call_user_func_array([$this->controladorActual, $this->metodoActual], $this->parametros);
        
    }
    
    public function getUrl() {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}
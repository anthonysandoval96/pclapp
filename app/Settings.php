<?php
/* NO OLVIDAR CAMBIAR LA RUTA EN EL .HTACCESS.*/
define('TIPO_DESARROLLO', 'LOCAL'); /* LOCAL O SERVIDOR*/
define('APP_NAME', 'PROGRAMA DE LECTURA');
if (TIPO_DESARROLLO == "LOCAL") {
    /**************** VARIABLES EN LOCAL ****************/
    /**************** VARIABLES DE LA BD ****************/
    define('DB_HOST', 'localhost');
    define('DB_USUARIO', 'root');
    define('DB_PASSWORD', '');
    define('DB_NOMBRE', 'applectura_bd');
    /****************************************************/
    define('PROJECT_NAME', '/applectura'); /* SIRVE PARA EL GLOBAL.JS */
    define('BASE_URL', 'http://localhost' . PROJECT_NAME . '/');
    define('RUTA_ARCHIVE', $_SERVER["DOCUMENT_ROOT"] . PROJECT_NAME . "/public/custom/");
} else if (TIPO_DESARROLLO == "SERVIDOR") {
    /**************** VARIABLES EN HOSTING ****************/
    /**************** VARIABLES DE LA BD ****************/
    define('DB_HOST', 'localhost');
    define('DB_USUARIO', 'comprend_anthony');
    define('DB_PASSWORD', 'anthony123');
    define('DB_NOMBRE', 'comprend_dbpcl');
    /****************************************************/
    define('PROJECT_NAME', '/pclapp'); /* SIRVE PARA EL GLOBAL.JS */
    define('BASE_URL', "https://comprendamos.com".PROJECT_NAME."/");
    define('RUTA_ARCHIVE', BASE_URL . "public/custom/");
}

define('CACHE_VERSION', rand());
define('PUBLIC_ROUTE', BASE_URL . 'public/');
define('PLUGINS_ROUTE', PUBLIC_ROUTE . 'plugins/');
define('CUSTOM_ROUTE', PUBLIC_ROUTE . 'custom/');
define('IMG_ROUTE', CUSTOM_ROUTE . 'img/');
define('CHARSET', 'utf8mb4');
/**************** VARIABLES GLOBALES ****************/
define('RUTA_APP', dirname(dirname(__FILE__)));
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
    define('DB_USUARIO', 'id11886709_anthonydev');
    define('DB_PASSWORD', 'F}Q}N)_B\n-8czUY');
    define('DB_NOMBRE', 'id11886709_ventas_online');
    /****************************************************/
    define('PROJECT_NAME', ''); /* SIRVE PARA EL GLOBAL.JS */
    define('BASE_URL', "https://daltat.000webhostapp.com/");
    define('RUTA_ARCHIVE', BASE_URL . "public/custom/");
}

define('LANG_HTML', 'es');
define('PUBLIC_ROUTE', BASE_URL . 'public/');
define('PLUGINS_ROUTE', PUBLIC_ROUTE . 'plugins/');
define('CUSTOM_ROUTE', PUBLIC_ROUTE . 'custom/');
define('IMG_ROUTE', CUSTOM_ROUTE . 'img/');
define('CHARSET', 'utf8mb4');
/**************** VARIABLES GLOBALES ****************/
define('RUTA_APP', dirname(dirname(__FILE__)));
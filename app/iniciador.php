<?php
require_once 'Settings.php';
require_once 'Helpers.php';
require_once 'libs/phpmailer/Exception.php';
require_once 'libs/phpmailer/PHPMailer.php';
require_once 'libs/phpmailer/SMTP.php';
// Autoload php
spl_autoload_register(function($clase) {
    require_once 'libs/' . $clase . '.php'; 
});
session_start();
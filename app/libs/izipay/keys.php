<?php
/**
 * Get the client
 */
require_once __DIR__ . '/rest-php-sdk-master/src/autoload.php';

/**
 * Define configuration
 */

/* Username, password and endpoint used for server to server web-service calls */
//(En el Back Office) Copiar Usuario
Lyra\Client::setDefaultUsername("87558222");
//(En el Back Office) Copiar Contraseña de test
Lyra\Client::setDefaultPassword("prodpassword_ITS5h1VWgtynSmHTPFOB0dWrsBRAVxYEOUE8dWhRiKJqB");
//(En el Back Office) Copiar Contraseña de Nombre del servidor API REST
Lyra\Client::setDefaultEndpoint("https://api.micuentaweb.pe");

/* publicKey and used by the javascript client */
//(En el Back Office) Copiar Clave pública de test
Lyra\Client::setDefaultPublicKey("87558222:publickey_R7akWFQiOYSyhPMzAJcY63Cs9eFaqaziBpfEG2VDVaRGI");

/* SHA256 key */
//(En el Back Office) Clave HMAC-SHA-256 de test
Lyra\Client::setDefaultSHA256Key("m89AvrmX3UwOzC5jcGTT9qxHTYEpt9IXzne5NtMYNJiIE");
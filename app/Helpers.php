<?php
date_default_timezone_set('America/Lima');
setlocale(LC_TIME, 'Spanish');

function getPluralPrase($phrase, $type = 'min') {
    $plural = '';
    $last_character = substr($phrase, -1);
    if ($last_character == 'y') {
        $plural .= substr($phrase, 0, -1) . 'ies';
    } else if (($last_character == 'a' || $last_character == 'e' || $last_character == 'i' || $last_character == 'o' || $last_character == 'u')) {
        $plural .= $phrase . 's';
    } else {
        $plural .= $phrase . 'es';
    }
    if ($type == 'may') $plural = ucwords($plural);
    return $plural;
}

function message($controller, $type, $status, $gender) {
    $gender = $gender == 'm' ? 'el' : 'la';
    $message = '';
    switch ($type) {
        case 'create':
            if ($status == true) {
                $message = ucwords($gender).' '.$controller.' se registró con éxito.';
            } else {
                $message = 'No se logró registrar '.$gender.' '.$controller.'.';
            }
            return $message;
            break;

        case 'update':
            if ($status == true) {
                $message = ucwords($gender).' '.$controller.' se actualizó con éxito.';
            } else {
                $message = 'No se logró actualizar '.$gender.' '.$controller;
            }
            return $message;
            break;
        
        case 'delete':
            if ($status == true) {
                $message = ucwords($gender).' '.$controller.' se eliminó con éxito.';
            } else {
                $message = 'No se logró eliminar '.$gender.' '.$controller.'.';
            }
            return $message;
            break;
        
        default:
            # code...
            break;

    }
}

function checkUpload($file, $count, $carpeta) {
    //    $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/" . NOMBRE_PROYECTO . "/public/custom/img/" . $carpeta . "s/";
    //    if (TIPO_DESARROLLO !== "LOCAL") { $target_dir = URL_BASE . "public/custom/img/" . $carpeta . "s/"; }
        $target_dir = RUTA_ARCHIVE . "img/" . $carpeta . "s/";
        $uploadOk = 0;
        $codigoerror = 0;
        $mensaje_error = "";
        $new_ruta = "";
        $nombre_img = "";
        if (isset($file["type"]) && $file["type"] !== "") {
            if (!file_exists($target_dir)) { mkdir($target_dir, 0777, true); }
            $file_name = $file["name"];
    //        $file_content = $file["tmp_name"];
            $type_img = pathinfo($file_name, PATHINFO_EXTENSION);
            $uploadOk = 1;
            // Check file size
            if ($file["size"] > 2000000) { //524288 // 700000
                $mensaje_error = "Lo sentimos, el archivo es demasiado grande.  Tamaño máximo admitido: 2.00 MB";
                $codigoerror = 1;
                $uploadOk = 0;
            }
            // Allow certain file formats
            if ($type_img != "jpg" && $type_img != "png" && $type_img != "jpeg"
            && $type_img != "gif" ) {
                $mensaje_error = "Lo sentimos, sólo archivos JPG, JPEG, PNG & GIF son permitidos.";
                $codigoerror = 2;
                $uploadOk = 0;
            }
            if ($type_img !== "gif") { $type_img = "png"; }
            $nombre_img = "$carpeta$count." . $type_img;
            if ($carpeta == "producto") { $nombre_img = "$count." . $type_img; }
            $new_ruta = $target_dir . $nombre_img;
        }
        return [$uploadOk, $mensaje_error, $new_ruta, $nombre_img, $codigoerror];
    }

function getLetterLine($number) {
    if ($number == 1) {
        $letra = "a";
    } else if ($number == 2) {
        $letra = "b";
    } else if ($number == 3) {
        $letra = "c";
    } else {
        return false;
    }
    return $letra;
}

function getPorcentajesSesiones($data) {
    $sesion_numero = $data["sesion"];
    $sesion_linea = $data["linea"];

    $sesiones = [];

    $numero_sesion = 0;
    $porcentaje_sesion = 0;
    
    for ($i=0; $i < $sesion_numero ; $i++) {
        if ($i == $sesion_numero - 1) {
            $numero_sesion = $sesion_numero;
            $porcentaje_sesion = getPorcentaje($sesion_linea - 1);
        } else {
            $numero_sesion = $i + 1;
            $porcentaje_sesion = getPorcentaje(15);
        }

        $sesiones[$i]["numero"] = $numero_sesion;
        $sesiones[$i]["porcentaje"] = $porcentaje_sesion;
    }
    
    return $sesiones;
}

function getPorcentaje($linea) {
    $limite = 15;
    return $linea * 100 / $limite;
}

function numerodeveces($fechanacimiento) {
    $edad = intval(calculaedad($fechanacimiento));
    $numerodeveces = 1;
    if ($edad >= 0 && $edad <= 9) {
        $numerodeveces = "01";
    } else if ($edad >= 10 && $edad <= 16) {
        $numerodeveces = "02";
    } else if ($edad >= 17) {
        $numerodeveces = "03";
    }
    return $numerodeveces;
}

function calculaedad($fechanacimiento){
    list($ano,$mes,$dia) = explode("-",$fechanacimiento);
    $ano_diferencia  = date("Y") - $ano;
    $mes_diferencia = date("m") - $mes;
    $dia_diferencia   = date("d") - $dia;
    if ($dia_diferencia < 0 || $mes_diferencia < 0)
        $ano_diferencia--;
    return $ano_diferencia;
}

function estructura_mensaje_bienvenida($nombre, $username, $pass) {
    $html = "
        <p><font size='4'>Hola <b>". $nombre ."</b>.</font></p>
        <p><font size='4'>Queremos darle la bienvenida a nuestra familia de <b>APP PCL</b>.</font></p>
        <p><font size='4'>A continuación se le brinda sus credenciales de acceso:</font></p>
        <ul>
            <li><font size='4'><b>username:</b> ".$username."</font></li>
            <li><font size='4'><b>contraseña:</b> ".$pass."</font></li>
        </ul>
    ";
    return $html;
}

function estructura_mensaje_recuperpass($nombre, $username, $pass) {
    $html = "
        <p><font size='4'>Hola <b>". $nombre ."</b>.</font></p>
        <p><font size='4'>Nos haz solicitado reestablecer tu contraseña.</font></p>
        <p><font size='4'>A continuación se le brinda sus nuevas creedenciales de acceso:</font></p>
        <ul>
            <li><font size='4'><b>username:</b> ".$username."</font></li>
            <li><font size='4'><b>contraseña:</b> ".$pass."</font></li>
        </ul>
    ";
    return $html;
}

function datosConfiguracion() {
    $Database = new Database();
    $Database->select("configuracion", "*", null, "id = 1");
    $result = $Database->getQueryResult()[0];
    return $result;
}

function datosPrincipales() {
    $array["app"]["abreviatura"] = "PCL";
    $array["app"]["nombre"] = "Programa de Comprensión Lectora";

    $array["email"]["email"] = "edsacor@yahoo.com";
    $array["email"]["password"] = "carogach06277610susy";
    return $array;
}

function eliminar_tildes($cadena){

    //Codificamos la cadena en formato utf8 en caso de que nos de errores
    // $cadena = utf8_encode($cadena);

    //Ahora reemplazamos las letras
    $cadena = str_replace(
        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
        $cadena
    );

    $cadena = str_replace(
        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
        $cadena );

    $cadena = str_replace(
        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
        $cadena );

    $cadena = str_replace(
        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
        $cadena );

    $cadena = str_replace(
        array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
        $cadena );

    $cadena = str_replace(
        array('ñ', 'Ñ', 'ç', 'Ç'),
        array('n', 'N', 'c', 'C'),
        $cadena
    );

    return $cadena;
}

function listarPaises () {
    $paises = array(
        "ANGOLA",
        "ARGELIA",
        "BENIN",
        "BOTSUANA",
        "BURKINA FASO",
        "BURUNDI",
        "CABO VERDE",
        "CAMERÚN",
        "CHAD",
        "COMORAS",
        "COSTA DE MARFIL",
        "EGIPTO",
        "ERITREA",
        "ETIOPÍA",
        "GABÓN",
        "GAMBIA",
        "GHANA",
        "GUINEA",
        "GUINEA ECUATORIAL",
        "GUINEA-BISSAU",
        "KENIA",
        "LESOTO",
        "LIBERIA",
        "LIBIA",
        "MADAGASCAR",
        "MALAUI",
        "MALI",
        "MARRUECOS",
        "MAURICIO",
        "MAURITANIA",
        "MOZAMBIQUE",
        "NAMIBIA",
        "NÍGER",
        "NIGERIA",
        "REPÚBLICA CENTROAFRICANA",
        "REPÚBLICA DEL CONGO",
        "REPÚBLICA DEMOCRÁTICA DEL CONGO",
        "RUANDA",
        "SANTO TOMÉ Y PRÍNCIPE",
        "SENEGAL",
        "SEYCHELLES",
        "SIERRA LEONA",
        "SOMALIA",
        "SUAZILANDIA",
        "SUDÁFRICA",
        "SUDÁN",
        "SUDÁN DEL SUR",
        "TANZANIA",
        "TOGO",
        "TÚNEZ",
        "UGANDA",
        "YIBUTI",
        "ZAMBIA",
        "ZIMBABUE",
        "ANTIGUA Y BARBUDA",
        "ARGENTINA",
        "BAHAMAS",
        "BARBADOS",
        "BELICE",
        "BOLIVIA",
        "BRASIL",
        "CANADÁ",
        "CHILE",
        "COLOMBIA",
        "COSTA RICA",
        "CUBA",
        "DOMINICA",
        "ECUADOR",
        "EL SALVADOR",
        "ESTADOS UNIDOS",
        "GRANADA",
        "GUATEMALA",
        "GUYANA",
        "HAITÍ",
        "HONDURAS",
        "JAMAICA",
        "MÉXICO",
        "NICARAGUA",
        "PANAMÁ",
        "PARAGUAY",
        "PERÚ",
        "PUERTO RICO",
        "REPÚBLICA DOMINICANA",
        "SAN CRISTÓBAL Y NIEVES",
        "SAN VICENTE Y LAS GRANADINAS",
        "SANTA LUCÍA",
        "SURINAM",
        "TRINIDAD Y TOBAGO",
        "URUGUAY",
        "VENEZUELA",
        "AFGANISTÁN",
        "ARABIA SAUDITA",
        "BANGLADÉS",
        "BARÉIN",
        "BRUNEI",
        "BUTÁN",
        "CAMBOYA",
        "CATAR",
        "CHINA",
        "CHIPRE",
        "COREA DEL NORTE",
        "COREA DEL SUR",
        "EMIRATOS ARABES UNIDOS",
        "FILIPINAS",
        "INDIA",
        "INDONESIA",
        "IRÁN",
        "IRAQ",
        "ISRAEL",
        "JAPÓN",
        "JORDANIA",
        "KAZAJISTÁN",
        "KIRGUISTÁN",
        "KUWAIT",
        "LAOS",
        "LÍBANO",
        "MALASIA",
        "MALDIVAS",
        "MONGOLIA",
        "MYANMAR",
        "NEPAL",
        "OMÁN",
        "PAKISTÁN",
        "PALESTINA",
        "SIRIA",
        "SRI LANKA",
        "TAILANDIA",
        "TAYIKISTÁN",
        "TIMOR ORIENTAL",
        "TURKMENISTÁN",
        "TURQUÍA",
        "UZBEKISTÁN",
        "VIETNAM",
        "YEMEN",
        "ALBANIA",
        "ALEMANIA",
        "ANDORRA",
        "ARMENIA",
        "AUSTRIA",
        "AZERBAIYÁN",
        "BÉLGICA",
        "BIELORRUSIA",
        "BOSNIA Y HERZEGOVINA",
        "BULGARIA",
        "CROACIA",
        "DINAMARCA",
        "ESLOVAQUIA",
        "ESLOVENIA",
        "ESPAÑA",
        "ESTONIA",
        "FINLANDIA",
        "FRANCIA",
        "GEORGIA",
        "GRECIA",
        "HUNGRÍA",
        "IRLANDA",
        "ISLANDIA",
        "ITALIA",
        "LETONIA",
        "LIECHTENSTEIN",
        "LITUANIA",
        "LUXEMBURGO",
        "MALTA",
        "MOLDAVIA",
        "MÓNACO",
        "MONTENEGRO",
        "NORUEGA",
        "PAÍSES BAJOS",
        "POLONIA",
        "PORTUGAL",
        "REINO UNIDO",
        "REPÚBLICA CHECA",
        "REPÚBLICA DE MACEDONIA",
        "RUMANIA",
        "RUSIA",
        "SAN MARINO",
        "SERBIA",
        "SUECIA",
        "SUIZA",
        "UCRANIA",
        "AUSTRALIA",
        "FIYI",
        "ISLAS MARSHALL",
        "ISLAS SALOMÓN",
        "KIRIBATI",
        "MICRONESIA",
        "NAURU",
        "NUEVA ZELANDA",
        "PALAOS",
        "PAPÚA NUEVA GUINEA",
        "SAMOA",
        "TONGA",
        "TUVALU",
        "VANUATU",
    );
    return $paises;
}
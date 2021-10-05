<?php

use PHPMailer\PHPMailer\PHPMailer;

class Usuarios extends Controller {
    
    private $db;
    public $usuario_id;
    
    public $mail;
    
    public function __construct() {
        $this->db = new Database;
        $this->usuario_id = (isset($_SESSION["usuario_id"])) ? $_SESSION["usuario_id"] : "";
        $this->mail = new PHPMailer();
    }
    /******************************************************/
    public function userLoggedData() {
        $join = "persona P ON P.id = U.persona_id";
        $this->db->select("usuario U", "U.*, P.*", $join, "U.id = $this->usuario_id");
        return $this->db->getQueryResult()[0];
    }
    /******************************************************/
    public function isLoggedIn($type = null) {
        $usuario_id = null;
        $respuesta = 0;
        if (isset($_SESSION['usuario_id'])) {
            $usuario_id = $this->usuario_id;
            $this->db->select("usuario", "id", null, "id = $usuario_id");
            $result = $this->db->getQueryResult();
            if (count($result) > 0) { $respuesta = 1; }
        }
        if ($type == null) {
            if (!$respuesta) {
                $datos = ['titulo' => "Login"];
                $this->view('access/login', $datos);
                exit();
            }
        } else { return $respuesta; }
    }
    /******************************************************/
    public function accessPermission() {
        $usuario_id = null;
        $respuesta = 0;
        if (isset($_SESSION['usuario_id'])) {
            $usuario_id = $this->usuario_id;
            $this->db->select("usuario", "id", null, "id = $usuario_id");
            $result = $this->db->getQueryResult();
            if (count($result) > 0) { $respuesta = 1; }
        }
        return $respuesta;
    }
    /******************************************************/
    public function getSesiones($tipo = "json") {
        $this->db->select("sesion", "*", null, "usuario_id = $this->usuario_id");
        $resultado = $this->db->getQueryResult();
        if ($tipo == "json") {
            return '{"data":' . json_encode($resultado) . '}';
        } else {
            return getPorcentajesSesiones($resultado[0]);
        }
    }
    /******************************************************/
    public function palabrasAprendidas() {
        $join = "palabra P ON P.id = H.palabra_id";
        $this->db->select("historial H", "P.nombre, H.aprendida", $join, "H.usuario_id = $this->usuario_id");
        $resultado = $this->db->getQueryResult();
        return $resultado;
    }
    /******************************************************/
    public function insertar() {

        if (!isset($_SESSION["user_register"])) return [false, "No se logró registrar el usuario, revise bien los datos ingresados."];
        $sesion_register = $_SESSION["user_register"];

        $mensaje_ok = "El usuario se registró con éxito, revisa tus credenciales de acceso en tu correo electrónico ingresado.";

        // $post_nombres = trim($_POST['in-usuario-nombres']);
        // $post_appaterno = trim($_POST['in-usuario-appaterno']);
        // $post_apmaterno = trim($_POST['in-usuario-apmaterno']);
        // $post_fechanac = ($_POST['in-usuario-fnacimiento'] !== "") ? $_POST['in-usuario-fnacimiento'] : null;
        // // $post_genero = ($_POST['sel-usuario-genero'] !== "") ? $_POST['sel-usuario-genero'] : "otro";
        // $post_direccion = (trim($_POST['in-usuario-direccion']) !== "") ? trim($_POST['in-usuario-direccion']) : null;
        // $post_email = (trim($_POST['in-usuario-email']) !== "") ? trim($_POST['in-usuario-email']) : null;
        // $post_celular = (trim($_POST['in-usuario-celular']) !== "") ? trim($_POST['in-usuario-celular']) : null;
        // // $post_codigo = md5(uniqid(rand()));

        $post_nombres = trim($sesion_register['in-usuario-nombres']);
        $post_appaterno = trim($sesion_register['in-usuario-appaterno']);
        $post_apmaterno = trim($sesion_register['in-usuario-apmaterno']);
        $post_fechanac = ($sesion_register['in-usuario-fnacimiento'] !== "") ? $sesion_register['in-usuario-fnacimiento'] : null;
        $post_direccion = null;
        $post_email = (trim($sesion_register['in-usuario-email']) !== "") ? trim($sesion_register['in-usuario-email']) : null;
        $post_celular = (trim($sesion_register['in-usuario-celular']) !== "") ? trim($sesion_register['in-usuario-celular']) : null;

        $post_pais = (trim($sesion_register['sel-usuario-pais']) !== "") ? trim($sesion_register['sel-usuario-pais']) : null;
        $post_nrodocumento = (trim($sesion_register['in-usuario-dni']) !== "") ? trim($sesion_register['in-usuario-dni']) : null;

        /* Generar el username automaticamente con los datos ingresados */
        $primera_letra_nombre = mb_substr($post_nombres, 0, 1, "UTF-8");
        $primera_letra_apmaterno = mb_substr($post_apmaterno, 0, 1, "UTF-8");
        $username = strtolower($primera_letra_nombre . $post_appaterno . $primera_letra_apmaterno);
        $username = str_replace(" ", "", $username);
        $username = eliminar_tildes($username);
        /* Verificar si existe un username igual */
        $sql_exist_user = "SELECT COUNT(*) FROM usuario WHERE username LIKE '%".$username."%'";
        $count_username = $this->db->obtenerColumnaSql($sql_exist_user);
        /* Si existe vamos agregando numeración al username */
        if ($count_username > 0) $username = $username . $count_username;
        
        $password = substr(md5(microtime()), 1, 10);
        
        $sql = "INSERT INTO persona (nombres, apellido_paterno, apellido_materno, fecha_nacimiento, pais, numero_documento, direccion, email, celular) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $sql2 = "INSERT INTO usuario (username, password, persona_id, created) VALUES (?, ?, ?, ?)";
        
        $nombre_lector = $post_nombres . " " . $post_appaterno . " " . $post_apmaterno;
        $mensaje = estructura_mensaje($nombre_lector, $username, $password);
        $subject = "Bienvenido a la APP PCL";
        
        $password = password_hash($password, PASSWORD_DEFAULT);
        
        try {
            $this->db->conn->autocommit(false);
            if (!$sql = $this->db->conn->prepare($sql)) {
                throw new Exception('Error al registrar datos del empleado.');
            }
            $sql->bind_param(
                "sssssssss",
                $post_nombres,
                $post_appaterno,
                $post_apmaterno,
                $post_fechanac,
                $post_pais,
                $post_nrodocumento,
                $post_direccion,
                $post_email,
                $post_celular
            );
            if ($sql->execute()) {
                $persona_id = $this->db->conn->insert_id;
                if (!$sql2 = $this->db->conn->prepare($sql2)) {
                    throw new Exception('Error al registrar el usuario.');
                }
                $sql2->bind_param("ssis", $username, $password, $persona_id, date('Y-m-d'));
                if ($sql2->execute()) {
                    $this->sendMail($post_email, $mensaje, $subject);
                    return [$this->db->conn->commit(), $mensaje_ok];
                }
            } else { 
                return [false, "No se logró registrar el usuario, revise bien los datos ingresados."];
            }
        } catch (Exception $ex) {
            $this->db->conn->rollback();
            return [false, $ex->getMessage()];
        }
    }
    /******************************************************/
    public function editarPerfil() {

        $post_usuario_id = $_POST["hdn-usuario-id"];
        $post_persona_id = $this->db->obtenerColumnaSql("SELECT persona_id FROM usuario WHERE id = $post_usuario_id");

        $post_file = $_FILES["file-upload"];
        
        $checkUpload = checkUpload($post_file, $post_usuario_id, 'usuario');
        if ($checkUpload[0]) {
            $nombre_img = $checkUpload[3];
        } else {
            if ($checkUpload[4] == 0) {
                $this->db->select("usuario", "avatar", null, "id = $post_usuario_id");
                $nombre_img = $this->db->getQueryResult()[0]["avatar"];
            } else {
                return [0, $checkUpload[1]];
            }
        }
        
        $post_nombres = $_POST['in-usuario-nombres'];
        $post_appaterno = $_POST['in-usuario-appaterno'];
        $post_apmaterno = $_POST['in-usuario-apmaterno'];
        $post_fechanac = ($_POST['in-usuario-fnacimiento'] !== "") ? $_POST['in-usuario-fnacimiento'] : null;
        $post_genero = $_POST['sel-usuario-genero'];
        $post_direccion = ($_POST['in-usuario-direccion'] !== "") ? $_POST['in-usuario-direccion'] : null;
        $post_email = ($_POST['in-usuario-email'] !== "") ? $_POST['in-usuario-email'] : null;
        $post_celular = ($_POST['in-usuario-celular'] !== "") ? $_POST['in-usuario-celular'] : null;

        $sql = "UPDATE persona SET nombres = ?, apellido_paterno = ?, apellido_materno = ?, fecha_nacimiento = ?, ";
        $sql .= "genero = ?, direccion = ?, email = ?, celular = ? WHERE id = ?";
        $sql2 = "UPDATE usuario SET avatar = ? WHERE id = ?";
        
        try {
            $this->db->conn->autocommit(false);
            if (!$sql = $this->db->conn->prepare($sql)) {
                throw new Exception('Error al editar datos del usuario.');
            }
            $sql->bind_param("ssssssssi", $post_nombres, $post_appaterno, $post_apmaterno, $post_fechanac,
                $post_genero, $post_direccion, $post_email, $post_celular, $post_persona_id);
            if ($sql->execute()) {
                if (!$sql2 = $this->db->conn->prepare($sql2)) {
                    throw new Exception('Error al actualizar avatar del usuario.');
                }
                $sql2->bind_param("si", $nombre_img, $post_usuario_id);
                $sql2->execute();
                if ($checkUpload[0]) { move_uploaded_file($post_file["tmp_name"], $checkUpload[2]); }
                return $this->db->conn->commit();
            } else { throw new Exception('No se logró actualizar los datos del usuario.'); }
        } catch (Exception $ex) {
            $this->db->conn->rollback();
            return $ex->getMessage();
        }
    }
    /******************************************************/
    public function cambiarContrasena() {
        $post_usuario_id = $_POST["hdn-usuario-ps-id"];
        $post_password_actual = $_POST["in-password-actual"];
        $post_password_new = $_POST["in-password-new"];
        $post_password_confirm = $_POST["in-password-confirm"];
        $mensaje = "La contraseña se actualizó con éxito.";
        $sql = "SELECT password FROM usuario WHERE id = $post_usuario_id LIMIT 1";
        $passwordDB = $this->db->obtenerColumnaSql($sql);
        if (password_verify($post_password_actual, $passwordDB)) {
            if ($post_password_new == $post_password_confirm) {
                $post_password_new = password_hash($post_password_new, PASSWORD_DEFAULT);
                $sql = "UPDATE usuario SET password = ? WHERE id = ?";
                $sql = $this->db->conn->prepare($sql);
                $sql->bind_param("si", $post_password_new, $post_usuario_id);
                if ($sql->execute()) {
                    return [true, $mensaje];
                } else { return [false, "La contraseña no se logró actualizar."]; }
            } else { return [false, "La nueva contraseña ingresada no coincide."]; }
        } else { return [false, "La contraseña actual es incorrecta."]; }
    }
    /******************************************************/
    public function sendMail($email, $message, $subject, $rutas_archivos = null) {
        $this->mail->CharSet = 'UTF-8';
        $this->mail->IsSMTP();
        $this->mail->SMTPDebug = 0; // 2
        $this->mail->SMTPAuth = "login";
        $this->mail->SMTPSecure = "tls";
        $this->mail->Host = "mail.comprendamos.com";
        $this->mail->Port = 587;
        $this->mail->AddAddress($email);
        $this->mail->Username="edsacor@comprendamos.com"; //daltat.info@gmail.com
        $this->mail->Password="carogach06277610susy"; //your_gmail_password_here
        $this->mail->SetFrom('edsacor@comprendamos.com','PCL');
        $this->mail->IsHTML(true);

        if(!empty($rutas_archivos)){
            foreach($rutas_archivos as $archivo){
                $this->mail->AddAttachment($archivo); // attachment
            }
        }

        $this->mail->Subject = $subject;
        $this->mail->MsgHTML($message);

        return $this->mail->Send();
    }
    /******************************************************/
    public function getUsuariosAll($tipo = "json") {
        $join = "persona P ON P.id = U.persona_id";
        $join .= " JOIN rol R ON R.id = U.rol_id";
        $this->db->select("usuario U", "U.*, P.*, R.*, U.id AS usuario_id", $join);
        $resultado = $this->db->getQueryResult();
        if ($tipo == "json") {
            return '{"data":' . json_encode($resultado) . '}';
        } else {
            return $resultado;
        }
    }

    public function respuesta_izipay() {
        /** 
         * Initialize the SDK 
         * see keys.php
         */
        $client = new Lyra\Client();
        //$_POST['kr-hash']= 'Yga5AOlU5qomnyEj3EQvwMvpotybpd7q4Yk0z9ZZtUaJQ';

        /* Check the signature using password */
        if (!$client->checkHash()) {
            //something wrong, probably a fraud ....
            return false;
            signature_error($formAnswer['kr-answer']['transactions'][0]['uuid'], $hashKey, 
            $client->getLastCalculatedHash(), $_POST['kr-hash']);
            throw new Exception('invalid signature');
        }

        $rawAnswer = $client->getParsedFormAnswer();
        $formAnswer = $rawAnswer['kr-answer'];

        /* Retrieve the transaction id from the IPN data */
        $transaction = $formAnswer['transactions'][0];

        /* get some parameters from the answer */
        $orderStatus = $formAnswer['orderStatus'];
        $orderId = $formAnswer['orderDetails']['orderId'];
        $transactionUuid = $transaction['uuid'];

        return json_encode($formAnswer);
    }
}
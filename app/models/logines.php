<?php
class Logines {
    private $db;
    
    public function __construct() {
        $this->db = new Database;
    }

    public function login() {
        // Trim todos los datos entrantes:
        $trimmed_data = array_map('trim', $_POST);
        // escapar de las variables para la seguridad
        $username = mysqli_real_escape_string($this->db->conn, $trimmed_data['in-usuario-email'] );
        $password = mysqli_real_escape_string($this->db->conn, $trimmed_data['in-usuario-password'] );
        $select = "U.id AS usuario_id, U.password, U.estado AS usuario_estado";
        $join = "persona P ON P.id = U.persona_id";
        $where = "U.username = '$username' OR P.email = '$username'";
        $this->db->select("usuario U", $select, $join, $where);
        $fila = $this->db->getQueryResult();
        if ($this->db->getRowsNum() == 1) {
            if (password_verify($password, $fila[0]['password'])) {
                if ($fila[0]['usuario_estado'] == 1) {
                    $mensaje = "Login exitoso";
                    $_SESSION["usuario_id"] = $fila[0]['usuario_id'];
                    return [true, $mensaje];
                } else { return [false, "Usuario desactivado."]; }
            } else { return [false, "La contraseña no coincide."]; }
        } else { return [false, "Datos de acceso incorrectos."]; }
    }
}
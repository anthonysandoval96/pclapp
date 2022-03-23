<?php

class Sesiones extends Controller {
    
    private $db;
    public $usuario_id;
    
    public function __construct() {
        $this->db = new Database;
        $this->usuario_id = (isset($_SESSION["usuario_id"])) ? $_SESSION["usuario_id"] : "";
    }
    /******************************************************/
    public function crearPrimerSesion() {
        $array = array(
            "id" => "1",
            "usuario_id" => $this->usuario_id,
            "sesion" => "1",
            "linea" => "1",
            "letra" => "1",
            "terminado" => "0",
            "asignado" => "0",
            "parte" => "1"
        );
        $usuario_id = $array['usuario_id'];
        $sesion = $array['sesion'];
        $linea = $array['linea'];
        $letra = $array['letra'];
        $fechaActual = date('Y-m-d');
        $sql = "INSERT INTO sesion (usuario_id, sesion, linea, letra, fecha_ingreso) VALUES ($usuario_id, $sesion, $linea, $letra, '$fechaActual')";
        $this->db->obtenerColumnaSql($sql, false);
        return $array;
    }
    /******************************************************/
    public function getPalabrasDeSesion() {
        $sesion_id = $_SESSION["sesion_diaria"]["id"];
        $this->db->select("temporal T", "P.id, P.nombre, T.checked", "palabra P ON P.id = T.palabra_id", "T.sesion_id = $sesion_id");
        $resultado = $this->db->getQueryResult();
        return $resultado;
    }
    /******************************************************/
    public function selectKnownWords() {
        if (!empty($_POST["sesion-data"])) {

            $sesion_data = base64_decode($_POST["sesion-data"]);
            $post_sesion = explode(",", $sesion_data)[0];
            $post_sesion = intval($post_sesion);
            $post_parte = explode(",", $sesion_data)[4];
            $post_parte = intval($post_parte);

            $post_parte = $post_parte == 1 ? 2 : 0;

            if (isset($_POST["check-word"]) && !empty($_POST["check-word"])) {
                $array_palabras = $_POST["check-word"];
                $sql1 = "UPDATE temporal SET checked = 1 WHERE sesion_id = ? AND palabra_id = ?";
                $sql2 = "UPDATE sesion SET parte = ? WHERE id = ?";
                try {
                    $this->db->conn->autocommit(false);
                    if (!$sql1 = $this->db->conn->prepare($sql1)) {
                        throw new Exception('Error al registrar primer step.');
                    }
                    for ($i = 0; $i < count($array_palabras); $i++) {
                        $p_id = $array_palabras[$i];
                        $sql1->bind_param("ii", $post_sesion, $p_id);
                        $sql1->execute();
                    }
                    if (!$sql2 = $this->db->conn->prepare($sql2)) {
                        throw new Exception('Error al registrar segundo step.');
                    }
                    $sql2->bind_param("ii", $post_parte, $post_sesion);
                    $sql2->execute();
                    return $this->db->conn->commit();
                } catch (Exception $ex) {
                    $this->db->conn->rollback();
                    return $ex->getMessage();
                } 
            } else {
                $sql2 = "UPDATE sesion SET parte = ? WHERE id = ?";
                try {
                    $this->db->conn->autocommit(false);
                    if (!$sql2 = $this->db->conn->prepare($sql2)) {
                        throw new Exception('Error al registrar segundo step.');
                    }
                    $sql2->bind_param("ii", $post_parte, $post_sesion);
                    $sql2->execute();
                    return $this->db->conn->commit();
                } catch (Exception $ex) {
                    $this->db->conn->rollback();
                    return $ex->getMessage();
                } 
            }
        }
    }
    /******************************************************/
    public function asignarSesion() {
        $where = "usuario_id = $this->usuario_id AND terminado = 0";
        $orderby = "sesion ASC, linea ASC, letra ASC";
        $this->db->select("sesion", "*", null, $where, $orderby, "1");
        $resultado = $this->db->getQueryResult()[0];

        if ($resultado == null) $resultado = $this->crearPrimerSesion();
        
        $_SESSION["sesion_diaria"] = $resultado;
        $sesion_diaria = $_SESSION["sesion_diaria"];

        $resp = ["respuesta" => true];
        
        if ($sesion_diaria["asignado"] == 0) $resp =  $this->asignarPalabras();
        
        // return print_r($resp);

        return array_merge($resp, $sesion_diaria);
    }
    /******************************************************/
    public function asignarPalabras() {
        $respuesta = [];
        $sql0 = "SELECT fecha_ingreso, sesion_termino, control_diario FROM sesion WHERE usuario_id = $this->usuario_id";
        $validator = $this->db->obtenerColumnaSql($sql0, false)[0];
        $fecha_ingreso = $validator['fecha_ingreso'];
        // echo $validator['sesion_termino'];
        $control_diario = $validator['control_diario'];
        $fechaActual = date('Y-m-d');
        if ( (($fecha_ingreso == $fechaActual) && ($control_diario == 1)) || 
             (($fecha_ingreso !== $fechaActual) && ($control_diario == 1)) ) {
            $palabras_aleatorias = $this->algortimoAleatorioDePalabras();
            if ($palabras_aleatorias) {
                $sesion_id = $_SESSION["sesion_diaria"]["id"];
                for ($i=0; $i < count($palabras_aleatorias); $i++) {
                    $p_id = $palabras_aleatorias[$i]["id"];
                    $sql = "INSERT INTO temporal (sesion_id, palabra_id) VALUES ($sesion_id, $p_id)";
                    $this->db->obtenerColumnaSql($sql, false);
                }
                
                $sql2 = "UPDATE sesion SET asignado = 1 , fecha_ingreso = '$fechaActual' WHERE id = $sesion_id";
                $this->db->obtenerColumnaSql($sql2);
                $respuesta["respuesta"] = true;
            } else {
                $respuesta["respuesta"] = false;
            }
        }
        return $respuesta;
    } 
    /******************************************************/
    public function algortimoAleatorioDePalabras() {
        $sql = "SELECT P.id, P.nombre FROM historial H";
        $sql .= " RIGHT OUTER JOIN palabra P ON P.id = H.palabra_id AND H.usuario_id = $this->usuario_id";
        $sql .= " WHERE H.id IS NULL ORDER BY RAND() LIMIT 20";
        $resultado = $this->db->obtenerColumnaSql($sql, false);
        if (empty($resultado)) return false;
        return $resultado;
    }
    /******************************************************/
    public function getSignificadoDePalabra($idword) {
        $this->db->select("palabra P", "P.nombre AS palabra, P.significado", null, "P.id = $idword");
        $resultado = $this->db->getQueryResult()[0];
        return $resultado;
    }
    /******************************************************/
    public function updateSesion() {
        /* sesion.id = 0 / sesion.sesion = 1 / sesion.linea = 2 / sesion.letra = 3 / sesion.parte = 4 */
        if (!empty($_POST["sesion-data"])) {

            $sesion_data = base64_decode($_POST["sesion-data"]);

            $id = explode(",", $sesion_data)[0];
            $sesion = explode(",", $sesion_data)[1];
            $linea = explode(",", $sesion_data)[2];
            $control_diario = explode(",", $sesion_data)[5];

            if ($linea < 15) {
                $newsesion = $sesion;
                $linea = $linea + 1;
                if ($sesion == 1) $sesion = 0;
            } else {
                $newsesion = $sesion + 1;
                $linea = 1;
                $control_diario = 0;
            }
            
            if (isset($_POST["check-word"]) && !empty($_POST["check-word"])) {

                $array_palabras = $_POST["check-word"];
                
                $sql1 = "INSERT INTO historial (usuario_id, palabra_id, aprendida) VALUES (?, ?, ?)";
                $sql2 = "UPDATE sesion SET sesion = ?, linea = ?, letra = 1, asignado = 0, parte = 1, control_diario = ?, sesion_termino = ? WHERE id = ?";
                $sql3 = "DELETE FROM temporal WHERE sesion_id = ?";
                
                try {
                    $this->db->conn->autocommit(false);
                    if (!$sql1 = $this->db->conn->prepare($sql1)) {
                        throw new Exception('Error al registrar primer step.');
                    }
                    $aprendida = "conocida";
                    for ($i = 0; $i < count($array_palabras); $i++) {
                        $p_id = $array_palabras[$i];
                        $sql1->bind_param("iis", $this->usuario_id, $p_id, $aprendida);
                        $sql1->execute();
                    }
                    if (!$sql2 = $this->db->conn->prepare($sql2)) {
                        throw new Exception('Error al registrar segundo step.');
                    }
                    $sql2->bind_param("iiiii", $newsesion, $linea, $control_diario, $sesion, $id);
                    $sql2->execute();
                    if (!$sql3 = $this->db->conn->prepare($sql3)) {
                        throw new Exception('Error al registrar segundo step.');
                    }
                    $sql3->bind_param("i", $id);
                    $sql3->execute();
                    return $this->db->conn->commit();
                } catch (Exception $ex) {
                    $this->db->conn->rollback();
                    return $ex->getMessage();
                } 
            }
        }
    }
    /*************************************************/
    public function updateSesionSelectAll() {
        /* sesion.id = 0 / sesion.sesion = 1 / sesion.linea = 2 / sesion.letra = 3 / sesion.parte = 4 */
        
        if (!empty($_POST["sesion-data"])) {

            $sesion_data = base64_decode($_POST["sesion-data"]);

            $id = explode(",", $sesion_data)[0];
            $sesion = explode(",", $sesion_data)[1];
            $linea = explode(",", $sesion_data)[2];
            $letra = explode(",", $sesion_data)[3];
            $control_diario = explode(",", $sesion_data)[5];

            if ($linea < 15) {
                $newsesion = $sesion;
                $linea = $linea + 1;
                if ($sesion == 1) $sesion = 0;
            } else {
                $newsesion = $sesion + 1;
                $linea = 1;
                $control_diario = 0;
            }
            
            if (isset($_POST["check-word"]) && !empty($_POST["check-word"])) {

                $array_palabras = $_POST["check-word"];
                
                $sql1 = "INSERT INTO historial (usuario_id, palabra_id, aprendida) VALUES (?, ?, ?)";
                $sql2 = "UPDATE sesion SET sesion = ?, linea = ?, letra = 1, asignado = 0, parte = 1, control_diario = ?, sesion_termino = ? WHERE id = ?";
                $sql3 = "DELETE FROM temporal WHERE sesion_id = ?";
                
                try {
                    $this->db->conn->autocommit(false);
                    if (!$sql1 = $this->db->conn->prepare($sql1)) {
                        throw new Exception('Error al registrar primer step.');
                    }
                    $aprendida = "conocida";
                    for ($i = 0; $i < count($array_palabras); $i++) {
                        $p_id = $array_palabras[$i];
                        $sql1->bind_param("iis", $this->usuario_id, $p_id, $aprendida);
                        $sql1->execute();
                    }
                    if (!$sql2 = $this->db->conn->prepare($sql2)) {
                        throw new Exception('Error al registrar segundo step.');
                    }
                    $sql2->bind_param("iiiii", $newsesion, $linea, $control_diario, $sesion, $id);
                    $sql2->execute();
                    if (!$sql3 = $this->db->conn->prepare($sql3)) {
                        throw new Exception('Error al registrar segundo step.');
                    }
                    $sql3->bind_param("i", $id);
                    $sql3->execute();
                    return $this->db->conn->commit();
                } catch (Exception $ex) {
                    $this->db->conn->rollback();
                    return $ex->getMessage();
                } 
            }
        }
    }

    public function cambiarLetraYpalabras() {

        if ($_SESSION["sesion_diaria"]) {

            $palabras_aleatorias = $this->algortimoAleatorioDePalabras();

            $sesion_diaria = $_SESSION["sesion_diaria"];
            $sesion_id = $sesion_diaria["id"];
            $sesion_letra = $sesion_diaria["letra"];

            if ($sesion_letra > 0 && $sesion_letra < 5) {

                $new_sesion_letra = $sesion_letra + 1;
                
                $presql = "DELETE FROM temporal WHERE sesion_id = $sesion_id";
                $this->db->obtenerColumnaSql($presql);
                
                for ($i = 0; $i < count($palabras_aleatorias); $i++) {
                    $p_id = $palabras_aleatorias[$i]["id"];
                    $sql = "INSERT INTO temporal (sesion_id, palabra_id) VALUES ($sesion_id, $p_id)";
                    $this->db->obtenerColumnaSql($sql, false);
                }
                
                $_SESSION["sesion_diaria"]["letra"] = $new_sesion_letra;

                $finallysql = "UPDATE sesion SET letra = $new_sesion_letra WHERE id = $sesion_id";
                $this->db->obtenerColumnaSql($finallysql);

                return [true, "Ya que no conoces ninguna palabra listada, cambiaremos por otro grupo de palabras (<b>".getLetterLine($new_sesion_letra)."</b>)!"];

            } else {
                return [false, "Solo puedes cambiar de grupo de palabras 5 veces (<b>".getLetterLine($sesion_letra)."</b>)."];
            }

        } else {
            return [false, "No existe ninguna sesión asignada para este usuario!"];
        }

    }

    public function actualizarParteDeSesion() {
        if (!empty($_POST["sesion-data"])) {
            print_r($_POST["sesion-data"]);
            $sesion_data = base64_decode($_POST["sesion-data"]);
            $post_sesionid = explode(",", $sesion_data)[0];
            $post_sesionid = intval($post_sesionid);
            $sql = "UPDATE sesion SET parte = 0 WHERE id = $post_sesionid";
            $this->db->obtenerColumnaSql($sql);
        }
    }
}
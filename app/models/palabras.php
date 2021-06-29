<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Palabras extends Controller {
    
    private $db;
    public $usuario_id;

    public $phpexcel;
    
    public function __construct() {
        $this->db = new Database;
        $this->usuario_id = (isset($_SESSION["usuario_id"])) ? $_SESSION["usuario_id"] : "";
    }
    /******************************************************/
    public function getPalabrasAll($tipo = "json") {
        $this->db->select("palabra", "*");
        $resultado = $this->db->getQueryResult();
        if ($tipo == "json") {
            return '{"data":' . json_encode($resultado) . '}';
        } else {
            return $resultado;
        }
    }
    /******************************************************/
    public function editar() {
        
        $post_palabra_id = $_POST["hdn-palabra-id"];
        $post_palabra_id = base64_decode($post_palabra_id);

        $post_palabra_nombre = $_POST['in-palabra-nombre'];
        $post_palabra_significado = $_POST['in-palabra-significado'];

        $sql = "UPDATE palabra SET nombre = ?, significado = ? WHERE id = ?";
        
        try {
            $this->db->conn->autocommit(false);
            if (!$sql = $this->db->conn->prepare($sql)) {
                throw new Exception('Error al editar datos del usuario.');
            }
            $sql->bind_param("ssi", $post_palabra_nombre, $post_palabra_significado, $post_palabra_id);
            if ($sql->execute()) {
                return $this->db->conn->commit();
            } else { 
                throw new Exception('No se logró actualizar los datos del usuario.'); 
            }
        } catch (Exception $ex) {
            $this->db->conn->rollback();
            return $ex->getMessage();
        }
    }
    /******************************************************/
    public function previsualizar() {
        if ($_FILES['file-upload']['name'] != null) {
            $inputFile = $_FILES["file-upload"]["tmp_name"];

            $inputFileType = IOFactory::identify($inputFile);
            $reader = IOFactory::createReader($inputFileType);
            $spreadsheet = $reader->load($inputFile);
            $cantidad = $spreadsheet->getActiveSheet()->toArray();
    
            $html = "";
            $j = 0;
    
            for ($i = 1; $i < count($cantidad); $i++) {
                $column = $cantidad[$i];
                if (strlen($column[0]) > 0 && strlen($column[1]) > 0) {
                    $j++;
                    $html .= "<tr>";
                    if ($column[0] !== "") {
                        $html .= "<td>".$column[0]."</td>";
                        $html .= "<td>".$column[1]."</td>";
                    }
                    $html .= "</tr>";
                }
            }
            $cantidad_registros = $j;
            $texto_registros = "registros";
            if ($cantidad_registros == 0) return [false, "No existen registros en la tabla de excel."];
            if ($cantidad_registros == 1) $texto_registros = "registro";
    
            $array_rt = ["cantidad" => $cantidad_registros. " ".$texto_registros, "html" => $html];
    
            return $array_rt;
        } else {
            return [false, "No existe ningún archivo cargado."];
        }
       
    }
    /******************************************************/
    public function migracion_bd() {
        if ($_FILES['file-upload']['name'] != null) {

            $inputFile = $_FILES["file-upload"]["tmp_name"];
            $inputFileType = IOFactory::identify($inputFile);
            $reader = IOFactory::createReader($inputFileType);
            $spreadsheet = $reader->load($inputFile);
            $cantidad = $spreadsheet->getActiveSheet()->toArray();

            $sql1 = "INSERT INTO palabra (nombre, significado) VALUES (?, ?)";
            
            try {
                $this->db->conn->autocommit(false);
                $j = 0;
                for ($i = 1; $i < count($cantidad); $i++) {
                    $column = $cantidad[$i];
                    if (strlen($column[0]) > 0 && strlen($column[1]) > 0) {
                        $j++;
                        $palabra = $column[0];
                        $significado = $column[1];
                        if (!$sql = $this->db->conn->prepare($sql1)) {
                            throw new Exception('Error al importar las palabras.');
                        }
                        $sql->bind_param("ss", $palabra, $significado);
                        if (!$sql->execute()) return [false, "No se logró importar la data."];
                    }
                }
                $cantidad_registros = $j;
                $texto_registros = "registros";
                if ($cantidad_registros == 0) return [false, "No existen registros en la tabla de excel."];
                if ($cantidad_registros == 1) $texto_registros = "registro";
                $this->db->conn->commit();
                return [true, "Se logró importar ".$cantidad_registros." ".$texto_registros." con éxito!"];
            } catch (Exception $ex) {
                $this->db->conn->rollback();
                return [false, $ex->getMessage()];
            }
        } else {
            return [false, "No existe ningún archivo cargado."];
        }
    }

    public function eliminar($id) {
        $sql = "DELETE FROM palabra WHERE id = ?";
        try {
            $this->db->conn->autocommit(false);
            if (!$sql = $this->db->conn->prepare($sql)) {
                throw new Exception('Error al eliminar palabra.');
            }
            $sql->bind_param("i", $id);
            if ($sql->execute()) {
                return $this->db->conn->commit();
            } else { 
                throw new Exception('No se logró eliminar la palabra'); 
            }
        } catch (Exception $ex) {
            $this->db->conn->rollback();
            return $ex->getMessage();
        }
    }
}
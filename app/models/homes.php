<?php
class Homes extends Controller {
    
    private $db;
    public $usuario_id;
    
    public function __construct() {
        $this->db = new Database;
        $this->usuario_id = (isset($_SESSION["usuario_id"])) ? $_SESSION["usuario_id"] : "";
    }
    /******************************************************/
}
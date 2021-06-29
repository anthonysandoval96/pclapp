<?php
class Database {
    private $db_host = DB_HOST;
    private $db_user = DB_USUARIO;
    private $db_pass = DB_PASSWORD;
    private $db_name = DB_NOMBRE;
    public $conn = null;
    
    private $query_result = array(); // any results from a query will be stored here
    private $query_text = ""; // used for debugging process with SQL return
    private $results_num = null;// used for returning the number of rows
    
    public function __construct() {
        if (!$this->conn) {
            $this->conn = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
            if ($this->conn->connect_error) {
                die("Connection failed: " . $this->conn->connect_error);
            }
            if (!$this->conn->set_charset("utf8mb4")) {
                die("Error loading character set. " . $this->conn->error);
            }
            if (!$this->conn->query("SET time_zone = '-5:00'")) {
                die("Error setting timezone. " . $this->conn->error);
            }
        }
    }
    
    public function select($table, $rows = '*', $join = null, $where = null, $order = null, $limit = null) {
        $sql = 'SELECT '.$rows.' FROM '.$table;
        if ($join != null) {
            $sql .= ' JOIN '.$join;
        }
        if ($where != null) {
            $sql .= ' WHERE '.$where;
		}
        if ($order != null) {
            $sql .= ' ORDER BY '.$order;
		}
        if ($limit != null) {
            $sql .= ' LIMIT '.$limit;
        }
        $this->query_text = $sql;
        $query = $this->conn->query($sql);
        if ($query) {
            $this->results_num = $query->num_rows;
            // Loop through the query results by the number of rows returned
            for ($i = 0; $i < $this->results_num; $i++) {
                $r = $query->fetch_array();
                $key = array_keys($r);
                for ($x = 0; $x < count($key); $x++) {
                    // Sanitizes keys so only alphavalues are allowed
                    if (!is_int($key[$x])) {
                        if ($query->num_rows >= 1) {
                            $this->query_result[$i][$key[$x]] = $r[$key[$x]];
                        } else {
                            $this->query_result[$i][$key[$x]] = null;
                        }
                    }
                }
            }
            return true;
        } else {
            array_push($this->query_result, $this->conn->error);
            return false;
        }
    }
    
    public function insert($table, $params = array()) {
        if ($this->tableExists($table)) {
            $sql = 'INSERT INTO `'.$table.'` (`'.implode('`, `',array_keys($params)).'`) VALUES("' . implode('", "', $params) . '")';
            $this->query_text = $sql;
            if ($insert = $this->conn->query($sql)) {
            	array_push($this->query_result, $this->conn->insert_id);
                return true;
            } else {
            	array_push($this->query_result, $this->conn->error);
                return false;
            }
        } else {
            return false;
        }
    }
    
    public function delete($table, $where = null) {
    	// Check to see if table exists
    	 if ($this->tableExists($table)) {
            // The table exists check to see if we are deleting rows or table
            if($where == null) {
                $delete = 'DROP TABLE '.$table; // Create query to delete table
            } else {
                $delete = 'DELETE FROM '.$table.' WHERE '.$where; // Create query to delete rows
            }
            if ($this->conn->query($delete)) {
            	array_push($this->query_result, $this->conn->affected_rows);
                $this->query_text = $delete;
                return true;
            } else {
            	array_push($this->query_result, $this->conn->error);
               	return false;
            }
        } else {
            return false; // The table does not exist
        }
    }
    
    public function update($table, $params = array(), $where) {
    	if ($this->tableExists($table)) {
            // Create Array to hold all the columns to update
            $args = array();
            foreach($params as $field => $value) {
                // Seperate each column out with it's corresponding value
                $args[] = $field.'="'.$value.'"';
            }
            $sql = 'UPDATE '.$table.' SET '.implode(',',$args).' WHERE '.$where;
            $this->query_text = $sql;
            if ($this->conn->query($sql)) {
                array_push($this->query_result, $this->conn->affected_rows);
                return true;
            } else {
                array_push($this->query_result, $this->conn->error);
                return false;
            }
        } else {
            return false;
        }
    }

    public function tableExists($table){
        $tablesInDb = $this->conn->query('SHOW TABLES FROM '.$this->db_name.' LIKE "'.$table.'"');
        if ($tablesInDb) {
            if ($tablesInDb->num_rows == 1) {
                return true;
            } else {
                array_push($this->query_result, $table." does not exist in this database");
                return false;
            }
        }
    }
    
    public function obtenerColumnaSql($sql, $unico = true) {
        if (!$sql = $this->conn->prepare($sql)) {
            array_push($this->query_result, "Prepare failed: (" . $this->conn->errno . ") " . $this->conn->error);
            return false;
        }
        if ($sql->execute()) {
            $result = $this->get_result($sql);
            if (count($result) === 0) {
                return null;
            }
            if ($unico) {
                return array_values($result[0])[0];
            } else {
                return array_values($result);
            }
        } else {
            array_push($this->query_result, "Execute failed: (" . $this->conn->errno . ") " . $this->conn->error);
            return false;
        }
    }
    
    // Public function to return the data to the user
    public function getQueryResult() {
        $val = $this->query_result;
        $this->query_result = array();
        return $val;
    }

    //Pass the SQL back for debugging
    public function getQueryText() {
        $val = $this->query_text;
        $this->query_text = "";
        return $val;
    }

    //Pass the number of rows back
    public function getRowsNum() {
        $val = $this->results_num;
        $this->results_num = null;
        return $val;
    }

    public function get_result($statement) {
        $result = array();
        $statement->store_result();
        for ($i = 0; $i < $statement->num_rows; $i++) {
            $metadata = $statement->result_metadata();
            $params = array();
            while ($field = $metadata->fetch_field()) {
                $params[] = &$result[$i][$field->name];
            }
            call_user_func_array(array( $statement, 'bind_result' ), $params);
            $statement->fetch();
        }
        return $result;
    }
    
    public function disconnect() {
    	if ($this->conn) {
            if ($this->conn->close()) {
                $this->conn = null;
                return true;
            } else {
                return false;
            }
        }
    }
}
<?php
const DB_HOST = 'localhost';
const DB_USERNAME = 'root';
const DB_NAME = 'db_hewanlaut';
const DB_PASS = '';

class Database {
    public $mysqli;
    
    public function __construct() {
        $this->mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASS, DB_NAME);
        if ($this->mysqli->connect_error) {
            echo "Error: koneksi gagal";
        }
    }
    
    public function __destruct() {
        $this->mysqli->close();
    }
    
    public function select($table, $where = null) {
        $sql = "SELECT * FROM $table";
        
        if ($where != null) {
            foreach ($where as $key => $value) {
                $sql .= " WHERE $key = '$value'";
            }
        }
        
        $result = $this->mysqli->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function insert($table, $data) {
        $columns = implode(", ", array_keys($data));
        $values = "'" . implode("', '", array_values($data)) . "'";
        $sql = "INSERT INTO $table ($columns) VALUES ($values)";
        
        return $this->mysqli->query($sql);
    }
    
    public function update($table, $data, $where) {
        $sets = [];
        foreach ($data as $key => $value) {
            $sets[] = "$key = '$value'";
        }
        $setClause = implode(", ", $sets);
        
        $whereClause = [];
        foreach ($where as $key => $value) {
            $whereClause[] = "$key = '$value'";
        }
        $whereClause = implode(" AND ", $whereClause);
        
        $sql = "UPDATE $table SET $setClause WHERE $whereClause";
        
        return $this->mysqli->query($sql);
    }
    
    public function delete($table, $where) {
        $whereClause = [];
        foreach ($where as $key => $value) {
            $whereClause[] = "$key = '$value'";
        }
        $whereClause = implode(" AND ", $whereClause);
        
        $sql = "DELETE FROM $table WHERE $whereClause";
        
        return $this->mysqli->query($sql);
    }
}
?>
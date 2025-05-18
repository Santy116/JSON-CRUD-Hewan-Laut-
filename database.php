<?php
const DB_HOST = 'localhost';
const DB_USERNAME = 'root';
const DB_NAME = 'santy_pwd8';
const DB_PASS = '';

class Database {
    public $mysqli;
    
    public function __construct() {
        $this->mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASS, DB_NAME);
        if ($this->mysqli->connect_error) {
            die("Error: koneksi gagal - " . $this->mysqli->connect_error);
        }
        $this->mysqli->set_charset("utf8mb4");
    }
    
    public function __destruct() {
        $this->mysqli->close();
    }
    
    public function select($table, $where = null) {
        $sql = "SELECT * FROM $table";
        
        if ($where != null) {
            $conditions = [];
            foreach ($where as $key => $value) {
                $conditions[] = "$key = ?";
            }
            $sql .= " WHERE " . implode(" AND ", $conditions);
            
            $stmt = $this->mysqli->prepare($sql);
            $types = str_repeat('s', count($where));
            $stmt->bind_param($types, ...array_values($where));
            $stmt->execute();
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        }
        
        $result = $this->mysqli->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function insert($table, $data) {
        $columns = implode(", ", array_keys($data));
        $placeholders = implode(", ", array_fill(0, count($data), "?"));
        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        
        $stmt = $this->mysqli->prepare($sql);
        $types = str_repeat('s', count($data));
        $stmt->bind_param($types, ...array_values($data));
        return $stmt->execute();
    }
    
    public function update($table, $data, $where) {
        $sets = [];
        foreach ($data as $key => $value) {
            $sets[] = "$key = ?";
        }
        $setClause = implode(", ", $sets);
        
        $whereClause = [];
        $whereValues = [];
        foreach ($where as $key => $value) {
            $whereClause[] = "$key = ?";
            $whereValues[] = $value;
        }
        $whereClause = implode(" AND ", $whereClause);
        
        $sql = "UPDATE $table SET $setClause WHERE $whereClause";
        
        $stmt = $this->mysqli->prepare($sql);
        $types = str_repeat('s', count($data) + count($where));
        $stmt->bind_param($types, ...array_merge(array_values($data), $whereValues));
        return $stmt->execute();
    }
    
    public function delete($table, $where) {
        $whereClause = [];
        $whereValues = [];
        foreach ($where as $key => $value) {
            $whereClause[] = "$key = ?";
            $whereValues[] = $value;
        }
        $whereClause = implode(" AND ", $whereClause);
        
        $sql = "DELETE FROM $table WHERE $whereClause";
        
        $stmt = $this->mysqli->prepare($sql);
        $types = str_repeat('s', count($where));
        $stmt->bind_param($types, ...$whereValues);
        return $stmt->execute();
    }
}
?>
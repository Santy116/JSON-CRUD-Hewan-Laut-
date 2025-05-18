<?php
require_once 'database.php';

class HewanLaut {
    public $db;
    
    public function __construct() {
        $this->db = new Database();
    }
    
    public function getAll() {
        return $this->db->select('hewan_laut');
    }
    
    public function getById($id) {
        return $this->db->select('hewan_laut', ['id' => $id]);
    }
    
    public function create($data) {
        return $this->db->insert('hewan_laut', $data);
    }
    
    public function update($id, $data) {
        return $this->db->update('hewan_laut', $data, ['id' => $id]);
    }
    
    public function delete($id) {
        return $this->db->delete('hewan_laut', ['id' => $id]);
    }
}
?>
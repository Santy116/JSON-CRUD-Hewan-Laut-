<?php
require_once 'database.php';

class HewanLaut {
    private $db;
    
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
        // Validasi data
        if (empty($data['nama']) || empty($data['jenis']) || empty($data['habitat'])) {
            return false;
        }
        
        return $this->db->insert('hewan_laut', $data);
    }
    
    public function update($id, $data) {
        // Validasi data
        if (empty($data['nama']) || empty($data['jenis']) || empty($data['habitat'])) {
            return false;
        }
        
        return $this->db->update('hewan_laut', $data, ['id' => $id]);
    }
    
    public function delete($id) {
        return $this->db->delete('hewan_laut', ['id' => $id]);
    }
    
    public function validate($data) {
        $errors = [];
        
        if (empty($data['nama'])) {
            $errors[] = "Nama hewan harus diisi";
        } elseif (strlen($data['nama']) > 100) {
            $errors[] = "Nama hewan maksimal 100 karakter";
        }
        
        if (empty($data['jenis'])) {
            $errors[] = "Jenis hewan harus dipilih";
        }
        
        if (empty($data['habitat'])) {
            $errors[] = "Habitat hewan harus diisi";
        }
        
        return $errors;
    }
}
?>
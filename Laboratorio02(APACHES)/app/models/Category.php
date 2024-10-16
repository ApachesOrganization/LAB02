<?php
class Category {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllCategories() {
        $this->db->query("SELECT * FROM categorias");
        return $this->db->resultSet();
    }

    public function addCategory($data) {
        $this->db->query("INSERT INTO categorias (nombre) VALUES (:nombre)");
        $this->db->bind(':nombre', $data['nombre']);
        
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    public function editCategory($id, $nombre) {
        $this->db->query("UPDATE categorias SET nombre = :nombre WHERE id = :id");
        $this->db->bind(':nombre', $nombre);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function deleteCategory($id) {
        $this->db->query("DELETE FROM categorias WHERE id = :id");
        $this->db->bind(':id', $id);
        
        return $this->db->execute();
    }
    public function getCategoryById($id) {
        $this->db->query("SELECT * FROM categorias WHERE id = :id");
        $this->db->bind(':id', $id);
    
        $result = $this->db->resultSet(); 
        if (!empty($result)) {
            return $result[0]; 
        } else {
            return null; 
    }
}
    
    public function updateCategory($data) {
        $this->db->query("UPDATE categorias SET nombre = :nombre WHERE id = :id");
        $this->db->bind(':nombre', $data['nombre']);
        $this->db->bind(':id', $data['id']);
        
        return $this->db->execute();
    }
}
?>
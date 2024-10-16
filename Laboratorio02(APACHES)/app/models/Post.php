<?php
class Post {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getPosts() {
        $this->db->query("SELECT p.*, c.nombre AS categoria_nombre FROM publicaciones p LEFT JOIN categorias c ON p.categoria_id = c.id ORDER BY p.id DESC");
        return $this->db->resultSet();
    }

    public function getPostById($id) {
        $this->db->query("SELECT * FROM publicaciones WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->singleRow();
    }

    public function addPost($data) {
        $this->db->query("INSERT INTO publicaciones (titulo, contenido, categoria_id) VALUES (:titulo, :contenido, :categoria_id)");
        $this->db->bind(':titulo', $data['titulo']);
        $this->db->bind(':contenido', $data['contenido']);
        $this->db->bind(':categoria_id', $data['categoria_id']);

        return $this->db->execute();
    }

    public function updatePost($data) {
        $this->db->query("UPDATE publicaciones SET titulo = :titulo, contenido = :contenido, categoria_id = :categoria_id WHERE id = :id");
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':titulo', $data['titulo']);
        $this->db->bind(':contenido', $data['contenido']);
        $this->db->bind(':categoria_id', $data['categoria_id']);

        return $this->db->execute();
    }

    public function deletePost($id) {
        $this->db->query("DELETE FROM publicaciones WHERE id = :id");
        $this->db->bind(':id', $id);

        return $this->db->execute();
    }

    public function getComentariosPorPublicacion($publicacion_id) {
        $this->db->query("SELECT * FROM comentarios WHERE publicacion_id = :publicacion_id ORDER BY fecha_comentario DESC");
        $this->db->bind(':publicacion_id', $publicacion_id);
        return $this->db->resultSet();
    }

    public function addComentario($data) {
        $this->db->query('INSERT INTO comentarios (publicacion_id, contenido, usuario_id, nombre_usuario) VALUES (:publicacion_id, :contenido, :usuario_id, :nombre_usuario)');
        $this->db->bind(':publicacion_id', $data['publicacion_id']);
        $this->db->bind(':contenido', $data['contenido']);
        $this->db->bind(':usuario_id', $data['usuario_id']);
        $this->db->bind(':nombre_usuario', $data['nombre_usuario']);
        return $this->db->execute();
    }
    
    public function addCategory($data) {
        $this->db->query("INSERT INTO categorias (nombre) VALUES (:nombre)");
        $this->db->bind(':nombre', $data['nombre']);

        return $this->db->execute();
    }

    public function getCategories() {
        $this->db->query("SELECT * FROM categorias ORDER BY nombre ASC");
        return $this->db->resultSet();
    }

    public function getCategoryById($id) {
        $this->db->query("SELECT * FROM categorias WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->singleRow();
    }

    public function updateCategory($data) {
        $this->db->query("UPDATE categorias SET nombre = :nombre WHERE id = :id");
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':nombre', $data['nombre']);

        return $this->db->execute();
    }

    public function deleteCategory($id) {
        $this->db->query("DELETE FROM categorias WHERE id = :id");
        $this->db->bind(':id', $id);

        return $this->db->execute();
    }
    public function getPostsByCategory($categoria_id) {
        $this->db->query("SELECT * FROM publicaciones WHERE categoria_id = :categoria_id");
        $this->db->bind(':categoria_id', $categoria_id);
        return $this->db->resultSet();
    }
    
}
?>
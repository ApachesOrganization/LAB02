<?php
class Posts extends Controller {
    public function __construct() {
        $this->postModel = $this->model('Post');
        $this->categoryModel = $this->model('Category');
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'titulo' => trim($_POST['titulo']),
                'contenido' => trim($_POST['contenido']),
                'categoria_id' => trim($_POST['categoria_id'])
            ];

            if ($this->postModel->addPost($data)) {
                echo "<script>alert('Post Agregado correctamente'); window.location.href='" . urlRoot . "/pages/adminPanel';</script>";
                exit();
            } else {
                die('Something went wrong');
            }
        } else {
            $categorias = $this->categoryModel->getAllCategories();
            $data = [
                'categorias' => $categorias ?: []
            ];
            $this->view('posts/add', $data);
        }
    }

    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'id' => $id,
                'titulo' => trim($_POST['titulo']),
                'contenido' => trim($_POST['contenido']),
                'categoria_id' => trim($_POST['categoria_id'])
            ];

            if ($this->postModel->updatePost($data)) {
                echo "<script>alert('Post actualizado correctamente'); window.location.href='" . urlRoot . "/pages/adminPanel';</script>";
                exit();
            } else {
                die('Something went wrong');
            }
        } else {
            $post = $this->postModel->getPostById($id);
            if (!$post) {
                die('Publicación no encontrada');
            }
            $categorias = $this->categoryModel->getAllCategories();
            $data = [
                'id' => $id,
                'titulo' => $post->titulo,
                'contenido' => $post->contenido,
                'categoria_id' => $post->categoria_id,
                'categorias' => $categorias ?: []
            ];
            $this->view('posts/editPublicaciones', $data);
        }
    }

    public function delete($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->postModel->deletePost($id)) {
                echo "<script>alert('Post Eliminado correctamente'); window.location.href='" . urlRoot . "/pages/adminPanel';</script>";
                exit();
            } else {
                die('Something went wrong');
            }
        }
    }
}
?>
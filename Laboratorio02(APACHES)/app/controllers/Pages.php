<?php
class Pages extends Controller {

    public function __construct() {
        $this->postModel = $this->model('Post');
        $this->categoryModel = $this->model('Category');
        $this->userModel = $this->model('User');
    }

    public function index() {
        $posts = $this->postModel->getPosts();
        $categorias = $this->categoryModel->getAllCategories();
        $data = [
            'title' => 'Página principal',
            'posts' => $posts,
            'categorias' => $categorias
        ];
        $this->view('pages/index', $data);
    }

    public function filtrarPorCategoria($categoria_id) {
        $posts = $this->postModel->getPostsByCategory($categoria_id);
        $categorias = $this->categoryModel->getAllCategories();
        $data = [
            'title' => 'Filtrado por Categoría',
            'posts' => $posts,
            'categorias' => $categorias
        ];
        $this->view('pages/index', $data);
    }
    public function adminPanel() {
        $posts = $this->postModel->getPosts();
        $categorias = $this->categoryModel->getAllCategories();
        $data = [
            'posts' => $posts ?: [],
            'categorias' => $categorias ?: []
        ];

        $this->view('pages/adminPanel', $data);
    }
    public function about() {
        $this->view('pages/about');
    }

    public function procesarComentario() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
            $data = [
                'publicacion_id' => $_POST['publicacion_id'],
                'contenido' => $_POST['comentario'],
                'usuario_id' => null,
                'nombre_usuario' => null
            ];
    
            if (isLoggedIn()) {
                $data['usuario_id'] = $_SESSION['usuario_id'];
            } else {
                if (empty($_POST['nombre_usuario'])) {
                    die('Por favor, ingresa tu nombre.');
                } else {
                    $data['nombre_usuario'] = trim($_POST['nombre_usuario']);
                }
            }
    
            if ($this->postModel->addComentario($data)) {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            } else {
                die('Error al agregar el comentario');
            }
        }
    }
    
    
}

?>
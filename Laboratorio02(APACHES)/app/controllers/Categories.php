<?php
class Categories extends Controller {
    public function __construct() {
        $this->categoryModel = $this->model('Category');
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'nombre' => trim($_POST['nombre']),
            ];

            if ($this->categoryModel->addCategory($data)) {
                echo "<script>alert('Categoría Agregada correctamente'); window.location.href='" . urlRoot . "/pages/adminPanel';</script>";
                exit();
            } else {
                die('Error al añadir la categoría');
            }
        }
    }

    public function delete($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->categoryModel->deleteCategory($id)) {
                echo "<script>alert('Categoría Borrada correctamente'); window.location.href='" . urlRoot . "/pages/adminPanel';</script>";
                exit();
            } else {
                die('Error al eliminar la categoría');
            }
        }
    }

    public function editCategory($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $data = [
                'id' => $id,
                'nombre' => trim($_POST['nombre'])
            ];

            if ($this->categoryModel->updateCategory($data)) {
                echo "<script>alert('Categoría actualizada correctamente'); window.location.href='" . urlRoot . "/pages/adminPanel';</script>";
                exit();
            } else {
                die('Error al actualizar la categoría');
            }
        } else {
            $categoria = $this->categoryModel->getCategoryById($id);
            if (!$categoria) {
                die('Categoría no encontrada');
            }

            $data = [
                'id' => $categoria->id,
                'nombre' => $categoria->nombre
            ];

            $this->view('categories/editCategory', $data);
        }
    }
}
?>
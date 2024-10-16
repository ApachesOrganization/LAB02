<?php
require_once('config.php'); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $comentario = $_POST['comentario'];
    $publicacion_id = $_POST['publicacion_id'];

    if (!empty($comentario) && !empty($publicacion_id)) {
        $sql = "INSERT INTO comentarios (contenido, publicacion_id) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$comentario, $publicacion_id])) {
            $mensaje = "Comentario enviado exitosamente.";
        } else {
            $mensaje = "Error al enviar el comentario. Inténtalo de nuevo.";
        }
    } else {
        $mensaje = "El comentario no puede estar vacío.";
    }

    header("Location: index.php?mensaje=" . urlencode($mensaje));
    exit();
}
?>

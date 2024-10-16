<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once(appRoot . '/views/includes/enca.php'); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo siteName; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php require_once(appRoot . '/views/includes/menu.php'); ?>

    <main class="container mt-4">
        <section class="row">
            <aside class="col-md-4">
                <div class="p-3 mb-3 bg-light rounded shadow-sm">
                    <h4 class="fst-italic">Categorías</h4>
                    <ul class="list-unstyled">
                        <?php if (isset($data['categorias']) && is_array($data['categorias'])): ?>
                            <?php foreach ($data['categorias'] as $categoria): ?>
                                <li>
                                    <a href="<?php echo urlRoot; ?>/pages/filtrarPorCategoria/<?php echo $categoria->id; ?>">
                                        <?php echo htmlspecialchars($categoria->nombre); ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li>No hay categorías disponibles</li>
                        <?php endif; ?>
                    </ul>
                </div>
            </aside>
            <div class="col-md-8">
                <?php if (isset($data['posts']) && is_array($data['posts'])): ?>
                    <?php foreach ($data['posts'] as $post): ?>
                        <div class="p-5 bg-white shadow rounded mb-4">
                            <h3><?php echo htmlspecialchars($post->titulo); ?></h3>
                            <p class="lead"><?php echo htmlspecialchars($post->contenido); ?></p>

                            <h4>Deja un comentario:</h4>
                            <form action="<?php echo urlRoot; ?>/pages/procesarComentario" method="POST">
                                <input type="hidden" name="publicacion_id" value="<?php echo $post->id; ?>">

                                <?php if (!isLoggedIn()): ?>
                                    <div class="mb-3">
                                        <label for="nombre<?php echo $post->id; ?>" class="form-label">Tu nombre:</label>
                                        <input type="text" class="form-control" id="nombre<?php echo $post->id; ?>" name="nombre_usuario" required>
                                    </div>
                                <?php endif; ?>

                                <div class="mb-3">
                                    <label for="comentario<?php echo $post->id; ?>" class="form-label">Tu comentario:</label>
                                    <textarea class="form-control" id="comentario<?php echo $post->id; ?>" name="comentario" rows="3" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Enviar Comentario</button>
                            </form>

                                <h4 class="mt-4">Comentarios:</h4>
                                <?php
                                $comentarios = $this->postModel->getComentariosPorPublicacion($post->id);
                                if ($comentarios):
                                    foreach ($comentarios as $comentario):
                                        echo '<div class="border rounded p-2 mb-2">';
                                        echo '<p>' . htmlspecialchars($comentario->contenido) . '</p>';

                                        if (!empty($comentario->usuario_id)) {
                                            $usuario = $this->userModel->getUserById($comentario->usuario_id);
                                            $nombre_comentarista = htmlspecialchars($usuario->nombre);
                                        } elseif (!empty($comentario->nombre_usuario)) {
                                            $nombre_comentarista = htmlspecialchars($comentario->nombre_usuario);
                                        } else {
                                            $nombre_comentarista = 'Anónimo';
                                        }

                                        echo '<small class="text-muted">Publicado por ' . $nombre_comentarista . ' el ' . $comentario->fecha_comentario . '</small>';
                                        echo '</div>';
                                    endforeach;
                                else:
                                    echo '<p>No hay comentarios aún. ¡Sé el primero en comentar!</p>';
                                endif;
                                ?>


                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No hay publicaciones disponibles.</p>
                <?php endif; ?>
            </div>
        </section>
    </main>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

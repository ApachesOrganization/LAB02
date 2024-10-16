<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once(appRoot . '/views/includes/enca.php'); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">  
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <title>Panel de Administración - <?php echo siteName; ?></title>
</head>
<body class="container-fluid bg-light">
    <header class="py-3 mb-4 border-bottom bg-dark text-light">
        <div class="container d-flex justify-content-between">
            <h1>Panel de Administración</h1>
            <div>
                <?php require_once(appRoot . '/views/includes/menu.php'); ?>
                <a href="<?php echo urlRoot; ?>/pages/index" class="btn btn-secondary ms-3">Volver al Inicio</a>
            </div>
        </div>     
    </header>

    <main class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Publicaciones</h2>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['posts'] as $post): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($post->titulo); ?></td>
                        <td>
                            <a href="<?php echo urlRoot; ?>/posts/edit/<?php echo $post->id; ?>" class="btn btn-warning">Editar</a>
                            <form action="<?php echo urlRoot; ?>/posts/delete/<?php echo $post->id; ?>" method="POST" class="d-inline">
                                <input type="submit" value="Eliminar" class="btn btn-danger">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="mt-5">
            <h2>Añadir Publicación</h2>
            <form action="<?php echo urlRoot; ?>/posts/add" method="POST">
                <div class="mb-3">
                    <label for="titulo" class="form-label">Título:</label>
                    <input type="text" name="titulo" class="form-control" id="titulo" required>
                </div>
                <div class="mb-3">
                    <label for="contenido" class="form-label">Contenido:</label>
                    <textarea name="contenido" class="form-control" id="contenido" rows="5" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="categoria" class="form-label">Categoría:</label>
                    <select name="categoria_id" id="categoria" class="form-select" required>
                        <?php foreach ($data['categorias'] as $categoria): ?>
                            <option value="<?php echo $categoria->id; ?>"><?php echo htmlspecialchars($categoria->nombre); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Añadir Publicación</button>
            </form>
        </div>

        <div class="mt-5">
            <h2>Categorías</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre de Categoría</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['categorias'] as $categoria): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($categoria->nombre); ?></td>
                            <td>
                                <a href="<?php echo urlRoot; ?>/categories/editCategory/<?php echo $categoria->id; ?>" class="btn btn-warning">Editar</a>
                                <form action="<?php echo urlRoot; ?>/categories/delete/<?php echo $categoria->id; ?>" method="POST" class="d-inline">
                                    <input type="submit" value="Eliminar" class="btn btn-danger">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <h3 class="mt-4">Añadir Categoría</h3>
            <form action="<?php echo urlRoot; ?>/categories/add" method="POST">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre de Categoría:</label>
                    <input type="text" name="nombre" class="form-control" id="nombre" required>
                </div>
                <button type="submit" class="btn btn-primary">Añadir Categoría</button>
            </form>
        </div>
    </main>

    <footer class="text-center py-4 mt-5 bg-dark text-light">
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?> <?php echo siteName; ?> - Todos los derechos reservados.</p>
            <?php require_once(appRoot . '/views/includes/pie.php'); ?>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
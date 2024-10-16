<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once(appRoot . '/views/includes/enca.php'); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">  
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <title>Editar Categoría - <?php echo siteName; ?></title>
</head>
<body class="container-fluid bg-light">
    <header class="py-3 mb-4 border-bottom bg-dark text-light">
        <div class="container d-flex justify-content-between">
            <h1>Editar Categoría</h1>
            <div>
                <a href="<?php echo urlRoot; ?>/posts/adminPanel" class="btn btn-secondary ms-3">Volver al Panel de Administración</a>
            </div>
        </div>     
    </header>

    <main class="container">
        <form action="<?php echo urlRoot; ?>/categories/editCategory/<?php echo $data['id']; ?>" method="POST">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre de la Categoría:</label>
                <input type="text" name="nombre" class="form-control" id="nombre" value="<?php echo htmlspecialchars($data['nombre']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Categoría</button>
        </form>
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

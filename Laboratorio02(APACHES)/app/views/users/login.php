<!DOCTYPE html>
<html lang="en">
<head>
    <?php
       require_once(appRoot . '/views/includes/enca.php');
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <title><?php echo siteName; ?></title>
</head>
<body class="container-fluid bg-light">
    <header class="py-3 mb-4 border-bottom bg-dark text-light">
        <div class="container d-flex justify-content-between">
            <h1><?php echo siteName; ?></h1>
            <?php
                require_once(appRoot . '/views/includes/menu.php');
            ?> 
        </div>     
    </header>

    <main class="container">
        <section class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-light">
                        <h4 class="card-title mb-0">Autenticación de usuarios</h4>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo urlRoot; ?>/users/login" method="post">
                            <div class="mb-3">
                                <label for="txtUsua" class="form-label"><strong>Usuario:</strong></label>
                                <input type="text" name="txtUsua" class="form-control <?php echo (!empty($data['userError'])) ? 'is-invalid' : ''; ?>" maxlength="15" required>
                                <div class="invalid-feedback">
                                    <?php echo $data['userError']; ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="txtContra" class="form-label"><strong>Contraseña:</strong></label>
                                <input type="password" name="txtContra" class="form-control <?php echo (!empty($data['passError'])) ? 'is-invalid' : ''; ?>" maxlength="15" required>
                                <div class="invalid-feedback">
                                    <?php echo $data['passError']; ?>
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Aceptar</button>
                            </div>
                        </form>
                        <div class="mt-3 text-center">
                            <a href="<?php echo urlRoot; ?>/users/register" class="text-decoration-none">Registrar usuario</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="text-center py-4 mt-5 bg-dark text-light">
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?> <?php echo siteName; ?> - Todos los derechos reservados.</p>
            <?php
                require_once(appRoot . '/views/includes/pie.php');
            ?>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

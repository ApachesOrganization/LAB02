<!DOCTYPE html>
<html lang="en">
<head>
    <?php
       require_once(appRoot . '/views/includes/enca.php');
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
        <section class="row">
            <div class="col-12">
                <div class="p-5 bg-white shadow rounded">
                    <h3>Acerca de Nosotros</h3>
                    <p class="lead">Somos un grupo dedicado a promover el aprendizaje y desarrollo personal a través de proyectos colaborativos y actividades innovadoras. Nuestro objetivo es crear un ambiente inclusivo donde cada miembro pueda aportar sus habilidades y crecer juntos.</p>

                    <h4>Miembros del Grupo</h4>
                    <ul>
                        <li><strong>Justin Vargas</strong> </li>
                        <li><strong>Yohel Rojas</strong> </li>
                        <li><strong>Dayron Anchia</strong></li>
                    </ul>

                    
            </div>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

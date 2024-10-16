

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="<?php echo urlRoot; ?>/pages/index"><?php echo siteName; ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo urlRoot; ?>/pages/index">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo urlRoot; ?>/pages/about">Acerca de Apaches</a>
                </li>

                <?php if(isLoggedIn()): ?>
                    <?php if(isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo urlRoot; ?>/pages/adminPanel">Panel de Administración</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo urlRoot; ?>/users/logout">Salir</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo urlRoot; ?>/users/login">Ingresar</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="jefe.php">MY MED</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Medicamentos</a>
                    <ul class="dropdown-menu">
                      <li class="nav-item">
                          <a class="nav-link active" aria-current="page" href="jefe.php">Inventario de Medicamentos</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="editarInventario.php">Editar Medicamento</a>
                      </li>
                      <li><hr class="dropdown-divider"></li>
                      <li class="nav-item">
                        <a class="nav-link" href="jefe-noti.php">Notificación Medicamentos</a>
                    </li>
                    </ul>
                  </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="agregarUsuario.php">Agregar Nuevo Usuario</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="jefe-compras.php">Compras</a>
		    </li>
                </ul>
                <span class="navbar-text">
                    <?php echo "<a class='nav-link' href='logout.php'>Logout $us</a>"; ?>
                </span>
            </div>
        </div>
    </nav>
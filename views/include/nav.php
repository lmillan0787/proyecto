<!--Navbar -->
<nav class="mb-1 navbar navbar-expand-lg navbar-dark elegant-color sticky-top">
  <a class="navbar-brand" href="#">SIJUNAIN</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333" aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item ">
        <a class="nav-link" href="<?php echo SERVERURL ?>home/">Inicio
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Delegaciones
        </a>
        <div class="dropdown-menu dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
          <a class="dropdown-item" href="<?php echo SERVERURL ?>deportistas/">Deportistas</a>
          <a class="dropdown-item" href="<?php echo SERVERURL ?>delegados/">Delegados</a>
          <a class="dropdown-item" href="<?php echo SERVERURL ?>medicos/">Medicos</a>          
        </div>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="<?php echo SERVERURL ?>invitados/">Invitados</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="<?php echo SERVERURL ?>tecnicos/">Personal Técnico</a>
      <li class="nav-item ">
        <a class="nav-link" href="<?php echo SERVERURL ?>participacion/">Participación</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="<?php echo SERVERURL ?>personas/">Personas</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto nav-flex-icons">
      <li class="nav-item active nav-link">
        <span class="sr-only">(current)</span>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
          <a class="dropdown-item" href="<?php echo SERVERURL ?>">Editar perfil</a>
          <a class="dropdown-item" href="<?php echo SERVERURL ?>usuarios">Usuarios</a>
          <a class="dropdown-item" href="<?php echo SERVERURL ?>eventos/">Eventos</a>
          <a class="dropdown-item" href="<?php echo SERVERURL ?>">Administrar</a>
          <a class="dropdown-item" href="../database/cerrar.php">Salir</a>
        </div>
      </li>
    </ul>
  </div>
</nav>
<!--/.Navbar -->
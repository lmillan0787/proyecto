<?php
require_once "./controllers/eventoControlador.php";
$insEvento = new eventoControlador();
?>
<!--Navbar -->
<div class="container unique-color-dark">
  <nav class="mb-1 navbar navbar-expand-lg navbar-dark unique-color-dark sticky-top z-depth-0" id="menu">
    <div class="container">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333" aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item ">
            <a class="nav-link" href="<?php echo SERVERURL ?>home/"><i class="fas fa-home"></i> INICIO
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-users"></i> Delegaciones
            </a>
            <div class="dropdown-menu dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
              <a class="dropdown-item" href="<?php echo SERVERURL ?>listaDeportistas/"><i class="fas fa-running"></i> Deportistas</a>
              <a class="dropdown-item" href="<?php echo SERVERURL ?>listaDelegados/"><i class="fas fa-sign-language"></i> Delegados</a>
              <a class="dropdown-item" href="<?php echo SERVERURL ?>listaMedicos/"><i class="fas fa-user-md"></i> Médicos</a>
            </div>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="<?php echo SERVERURL ?>listaInvitados/"><i class="fas fa-user-tag"></i> Invitados</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="<?php echo SERVERURL ?>listaTecnicos/"><i class="fas fa-user-cog"></i> Personal Técnico</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="<?php echo SERVERURL ?>listaPersonas/"><i class="fas fa-user"></i> Personas</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-check"></i> Participación
            </a>
            <div class="dropdown-menu dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
              <?php $insEvento->consultar_evento_activo() ?>
            </div>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto nav-flex-icons">
          <li class="nav-item active nav-link">
            <span class="sr-only">(current)</span>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-333" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-cogs"></i> <?php echo $_SESSION['des_usr_junain'] ?>
            </a>
            <div class="dropdown-menu dropdown-menu-center dropdown-default" aria-labelledby="navbarDropdownMenuLink-333">
              <a class="dropdown-item" href="<?php echo SERVERURL ?>listaUsuarios/"><i class="fas fa-user-cog"></i> Usuarios</a>
              <a class="dropdown-item" href="<?php echo SERVERURL ?>listaEventos/"><i class="far fa-calendar-alt"></i> Eventos</a>
              <a class="dropdown-item" href="<?php echo SERVERURL ?>listaPueblos/"><i class="fas fa-globe-americas"></i> Pueblos</a>
              <a class="dropdown-item" href="<?php echo SERVERURL ?>listaDisciplinas/"><i class="fas fa-futbol"></i> Disciplinas</a>
              <a class="dropdown-item" href="<?php echo SERVERURL ?>ajax/salirAjax.php"><i class="fas fa-power-off"></i> Salir</a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</div>
<!--/.Navbar -->
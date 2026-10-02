<?php

require_once __DIR__ . "/utilidades.php";

$headerBase = $headerBase ?? "..";

$rolesConSesion = ["administrador", "profesor", "alumno"];
$headerConSesion = $headerConSesion ?? (
  isset($_SESSION["id_usuario"])
  && in_array($_SESSION["rol"] ?? "", $rolesConSesion, true)
);

$nombreUsuario = $_SESSION["nombre"] ?? "Usuario";
$paginaActiva = $paginaActiva ?? "";

$enlaceIndex = $headerBase . "/index.php";
$enlaceLogin = $headerBase . "/paginas/login.php";
$enlaceLogout = $headerBase . "/controladores/logout.php";
$rutaImagenes = $headerBase . "/imagenes";
$enlaceCatalogo = ($headerBase === ".") ? "#catalogo" : $enlaceIndex . "#catalogo";
$enlaceTitulaciones = ($headerBase === ".") ? "#titulaciones" : $enlaceIndex . "#titulaciones";
$enlaceFormulario = $headerBase . "/paginas/formulario.php";
$enlaceConocenos = $headerBase . "/paginas/conocenos.php";
$enlaceAyuda = $headerBase . "/paginas/ayuda.php";

$enlaceLogo = $urlActual ?? $enlaceIndex;

?>

<?php if ($headerConSesion) { ?>

<header class="crescendo-header crescendo-header--sesion container-fluid py-3 px-4">

  <div class="crescendo-header__inner d-flex justify-content-between align-items-center w-100 gap-3 flex-wrap">

    <a href="<?php echo textoSeguro($enlaceLogo); ?>"
       class="logo-contenedor d-flex align-items-center text-decoration-none text-light ms-0">

      <img src="<?php echo textoSeguro($rutaImagenes); ?>/LOGO.png"
           class="logo-img d-block"
           alt="Logo Crescendo">

      <span class="logo-text">CRESCENDO</span>
    </a>

    <div class="crescendo-header__actions d-flex align-items-center gap-3 ms-lg-auto">

      <span class="crescendo-header__greeting text-secondary">
        Hola, <?php echo textoSeguro($nombreUsuario); ?>
      </span>

      <a href="<?php echo textoSeguro($enlaceLogout); ?>"
         class="btn-logout d-inline-flex align-items-center justify-content-center"
         title="Cerrar sesión"
         aria-label="Cerrar sesión">
        <span class="material-symbols-outlined" aria-hidden="true">logout</span>
      </a>

    </div>

  </div>

</header>

<?php } else { ?>

<header class="crescendo-header container-fluid py-3 px-4">

  <div class="crescendo-header__inner d-flex flex-wrap justify-content-between align-items-center gap-3 w-100">

    <a href="<?php echo textoSeguro($enlaceLogo); ?>"
       class="logo-contenedor d-flex align-items-center text-decoration-none text-light ms-0">

      <img src="<?php echo textoSeguro($rutaImagenes); ?>/LOGO.png"
           class="logo-img d-block"
           alt="Logo Crescendo">

      <span class="logo-text">CRESCENDO</span>
    </a>

    <a class="boton-acceso" href="<?php echo textoSeguro($enlaceLogin); ?>">
      Acceso a la plataforma
    </a>

  </div>

</header>

<nav class="navbar navbar-expand-lg navbar-dark mx-3 mb-4 rounded bg-black bg-opacity-25 aside-link">
  <div class="container-fluid">
    <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
      data-bs-target="#menuPrincipal" aria-label="Abrir menú de navegación">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="menuPrincipal">
      <ul class="navbar-nav mx-auto text-center">
        <li class="nav-item">
          <a class="nav-link <?php echo $paginaActiva === "catalogo" ? "is-active" : ""; ?>"
             href="<?php echo textoSeguro($enlaceCatalogo); ?>">Catálogo de clases</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo $paginaActiva === "titulaciones" ? "is-active" : ""; ?>"
             href="<?php echo textoSeguro($enlaceTitulaciones); ?>">Titulaciones</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo $paginaActiva === "formulario" ? "is-active" : ""; ?>"
             href="<?php echo textoSeguro($enlaceFormulario); ?>">Únete a nuestra escuela</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo $paginaActiva === "conocenos" ? "is-active" : ""; ?>"
             href="<?php echo textoSeguro($enlaceConocenos); ?>">Sobre nosotros</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo $paginaActiva === "ayuda" ? "is-active" : ""; ?>"
             href="<?php echo textoSeguro($enlaceAyuda); ?>">Ayuda</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<?php } ?>

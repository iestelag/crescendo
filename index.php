<?php
$headerBase = ".";
$headerConSesion = false;
$enlaceLogo = "index.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Crescendo</title>

  <link rel="icon" href="imagenes/LOGO.png">
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Estilos propios -->
  <link rel="stylesheet" href="estilos/estilos.css">
</head>

<body class="text-light">

<?php require_once __DIR__ . "/includes/header.php"; ?>

<main>

<!-- HERO -->
<section class="hero text-center d-flex align-items-center">

  <div class="container py-5">

    <div class="mx-auto" style="max-width:800px;">

      <h1 class="display-5 fw-bold mb-4">
        Formación musical personalizada y seguimiento académico digital
      </h1>

      <p class="lead mb-0">
        Clases de instrumento, lenguaje musical e iniciación para todas las edades.
        Además, acceso a Crescendo, nuestra plataforma privada de seguimiento.
      </p>

    </div>

  </div>

</section>


<!-- OFERTA FORMATIVA -->
<section id="catalogo" class="container py-5">

  <div class="text-center mb-5">
    <h2 class="mb-3">Nuestra oferta formativa</h2>
    <p class="text-light">Formación musical adaptada a todas las edades y niveles.</p>
  </div>

  <div class="row g-4">

    <div class="col-12 col-md-6 col-xl-3">
      <article class="card h-100 tarjeta-azul text-light border-info">
        <div class="card-img-wrapper">
          <img src="imagenes/oferta-instrumentos.png" class="card-img-top" alt="Instrumentos individuales">
        </div>

        <div class="card-body">
          <h3 class="card-title h5">Instrumentos individuales</h3>

          <ul class="mb-0">
            <li>Piano · Violín · Guitarra</li>
            <li>Canto · Batería · Flauta</li>
          </ul>

        </div>
      </article>
    </div>


    <div class="col-12 col-md-6 col-xl-3">
      <article class="card h-100 tarjeta-azul text-light border-danger">
        <div class="card-img-wrapper card-img-wrapper--iniciacion">
          <img src="imagenes/oferta-iniciacion.png" class="card-img-top" alt="Iniciación musical">
        </div>

        <div class="card-body">
          <h3 class="card-title h5">Iniciación musical</h3>

          <ul class="mb-0">
            <li>Música y movimiento</li>
            <li>Estimulación temprana</li>
          </ul>

        </div>
      </article>
    </div>


    <div class="col-12 col-md-6 col-xl-3">
      <article class="card h-100 tarjeta-azul text-light border-warning">
        <div class="card-img-wrapper">
          <img src="imagenes/oferta-lenguaje.jpg" class="card-img-top" alt="Lenguaje musical">
        </div>

        <div class="card-body">
          <h3 class="card-title h5">Lenguaje musical</h3>

          <ul class="mb-0">
            <li>Teoría · Lectura</li>
            <li>Preparación para pruebas</li>
          </ul>

        </div>
      </article>
    </div>


    <div class="col-12 col-md-6 col-xl-3">
      <article class="card h-100 tarjeta-azul text-light border-primary">
        <div class="card-img-wrapper card-img-wrapper--combo">
          <img src="imagenes/oferta-combo.png" class="card-img-top" alt="Formación moderna">
        </div>

        <div class="card-body">
          <h3 class="card-title h5">Formación moderna y colectiva</h3>

          <ul class="mb-0">
            <li>Combo · Coro</li>
            <li>Talleres · Música de cámara</li>
          </ul>

        </div>
      </article>
    </div>

  </div>

</section>


<!-- TITULACIONES -->
<section id="titulaciones" class="container py-5">

  <div class="text-center mb-5">
    <h2 class="mb-3">Elige tu camino musical</h2>
    <p class="text-light">Formación musical adaptada a todas las edades y niveles.</p>
  </div>

  <div class="row g-4">

    <div class="col-12 col-md-6 col-xl-3">
      <article class="card h-100 tarjeta-azul text-light border-info titulacion-card titulacion-card--acceso">

        <div class="titulacion-card-img-wrapper">
          <img src="imagenes/conservatorio.png" class="card-img-top" alt="Conservatorio">
        </div>

        <div class="card-body">
          <h3 class="card-title h5">Pruebas de acceso a conservatorio</h3>

          <ul class="mb-0">
            <li>Preparación personalizada para pruebas oficiales.</li>
            <li>Accede al curso y nivel que necesitas.</li>
          </ul>

        </div>

      </article>
    </div>


    <div class="col-12 col-md-6 col-xl-3">
      <article class="card h-100 tarjeta-azul text-light border-danger titulacion-card titulacion-card--abrsm">

        <div class="titulacion-card-img-wrapper">
          <img src="imagenes/abrsm.jpg" class="card-img-top" alt="ABRSM">
        </div>

        <div class="card-body">
          <h3 class="card-title h5">Títulos ABRSM</h3>

          <ul class="mb-0">
            <li>Titulaciones británicas reconocidas internacionalmente.</li>
            <li>Preparación oficial para exámenes ABRSM.</li>
          </ul>

        </div>

      </article>
    </div>


    <div class="col-12 col-md-6 col-xl-3">
      <article class="card h-100 tarjeta-azul text-light border-warning titulacion-card titulacion-card--rockschool">

        <div class="titulacion-card-img-wrapper">
          <img src="imagenes/rockschool.png" class="card-img-top" alt="Rockschool">
        </div>

        <div class="card-body">
          <h3 class="card-title h5">Títulos RockSchool</h3>

          <ul class="mb-0">
            <li>Formación moderna enfocada al rock y música actual.</li>
            <li>Obtén tu certificación oficial RockSchool.</li>
          </ul>

        </div>

      </article>
    </div>


    <div class="col-12 col-md-6 col-xl-3">
      <article class="card h-100 tarjeta-azul text-light border-primary titulacion-card titulacion-card--libre">

        <div class="titulacion-card-img-wrapper">
          <img src="imagenes/libre.png" class="card-img-top" alt="Formación libre">
        </div>

        <div class="card-body">
          <h3 class="card-title h5">Formación libre</h3>

          <ul class="mb-0">
            <li>Aprende música a tu ritmo y sin exámenes.</li>
            <li>Disfruta de una formación flexible y personalizada.</li>
          </ul>

        </div>

      </article>
    </div>

  </div>

</section>


<!-- UNETE -->
<section id="unete" class="hero-secundario text-center d-flex align-items-center">

  <div class="container py-5">

    <div class="mx-auto" style="max-width:800px;">

      <h2 class="mb-4">
        ¿Aún no formas parte de nuestra escuela?
      </h2>

      <p class="lead mb-4">
        Clases de instrumento, lenguaje musical e iniciación para todas las edades.
      </p>

      <a class="boton-acceso" href="paginas/formulario.php" >
        Únete
      </a>

    </div>

  </div>

</section>

</main>

<?php require_once __DIR__ . "/includes/footer.php"; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

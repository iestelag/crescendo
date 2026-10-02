<?php

require_once __DIR__ . "/../includes/alumno_acceso.php";
require_once __DIR__ . "/../includes/conexion.php";
require_once __DIR__ . "/../modelos/admin_modelo.php";
require_once __DIR__ . "/../includes/utilidades.php";

if (!isset($alumnoNombre)) {
  $alumnoNombre = $_SESSION["nombre"] ?? "Alumno";
}

$paginaActivaAlumno = "inicio";
$anunciosActivos = listarAnunciosActivos($conexion) ?? [];

?>

<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Panel del alumno | Crescendo</title>
  <link rel="icon" href="../imagenes/LOGO.png" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../estilos/estilos.css">
</head>

<body class="d-flex flex-column min-vh-100 text-light">
  <?php require_once __DIR__ . "/../includes/header.php"; ?>
  <div class="container-fluid flex-grow-1 panel-admin panel-alumno crescendo-panel">
    <div class="row g-4">
      <?php require_once __DIR__ . "/../includes/panel_alumno_aside.php"; ?>
      <main class="col-12 col-lg-9 bg-black bg-opacity-25 rounded p-3">
        <h1 class="panel-admin-title">Hola, <?php echo textoSeguro($alumnoNombre); ?></h1>
        <p class="panel-admin-tagline">

          Aquí encontrarás los avisos generales del centro, publicados por la administración.

        </p>



        <h2 class="panel-admin-section-title">Tablón de anuncios</h2>



        <?php if (empty($anunciosActivos)) { ?>

          <p class="text-secondary mb-0">No hay anuncios publicados en este momento.</p>

        <?php } else { ?>

          <?php foreach ($anunciosActivos as $indice => $anuncio) { ?>

            <?php

            $fechaAnuncio = !empty($anuncio["fecha_creacion"])

              ? date("d/m/Y H:i", strtotime($anuncio["fecha_creacion"]))

              : "";

            $esUltimo = $indice === count($anunciosActivos) - 1;

            ?>

            <div class="card alumno-anuncio-card text-light <?php echo $esUltimo ? "mb-0" : "mb-3"; ?>">

              <div class="card-body">

                <div class="d-flex align-items-start gap-2 mb-1">
                  <span class="material-symbols-outlined alumno-anuncio-icon flex-shrink-0"
                        aria-hidden="true"
                        title="Tablón oficial">campaign</span>
                  <h3 class="h6 mb-0"><?php echo textoSeguro($anuncio["titulo"]); ?></h3>
                </div>

                <p class="mb-2">

                  <?php echo nl2br(textoSeguro($anuncio["contenido"])); ?>

                </p>

                <?php if ($fechaAnuncio !== "") { ?>

                  <small class="text-secondary"><?php echo textoSeguro($fechaAnuncio); ?></small>

                <?php } ?>

              </div>

            </div>

          <?php } ?>

        <?php } ?>



      </main>



    </div>

  </div>



  <?php require_once __DIR__ . "/../includes/footer.php"; ?>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>



</body>

</html>


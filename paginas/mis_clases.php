<?php
require_once __DIR__ . "/../includes/alumno_acceso.php";
require_once __DIR__ . "/../includes/conexion.php";
require_once __DIR__ . "/../modelos/alumno_modelo.php";
require_once __DIR__ . "/../includes/utilidades.php";

$clases = listarClasesAlumno($conexion, $idAlumno);
$paginaActivaAlumno = "clases";
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title>Mis clases | Crescendo</title>

  <link rel="icon" href="../imagenes/LOGO.png" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../estilos/estilos.css">
</head>

<body class="d-flex flex-column min-vh-100 text-light">

  <?php require_once "../includes/header.php"; ?>

  <div class="container-fluid flex-grow-1 panel-admin panel-alumno crescendo-panel">
    <div class="row g-4">

      <?php require_once "../includes/panel_alumno_aside.php"; ?>

      <main class="col-12 col-lg-9 bg-black bg-opacity-25 rounded p-3">

        <h1 class="panel-admin-title">Mis clases</h1>

        <p class="panel-admin-tagline">
          Selecciona una clase para ver sus tareas, materiales y mensajes del profesor.
        </p>

        <?php if (empty($clases)) { ?>
          <p class="text-secondary mb-0">
            No estás matriculado en ninguna clase todavía.
          </p>
        <?php } else { ?>
          <div class="row g-4">
            <?php foreach ($clases as $c) { ?>
              <div class="col-12 col-md-6 col-xl-4">
                <article class="card card-clase h-100 bg-dark text-light bg-opacity-25">
                  <?php
                  $imagenAsignatura = imagenAsignatura($c["nombre_asignatura"]);
                  ?>
                  <img src="../imagenes/asignaturas/<?php echo textoSeguro($imagenAsignatura); ?>"
                       class="card-img-top panel-alumno-card-img"
                       alt="Imagen de <?php echo textoSeguro($c["nombre_asignatura"]); ?>">
                  <div class="card-body d-flex flex-column">
                    <p class="small text-secondary mb-1">
                      <?php echo textoSeguro($c["nombre_asignatura"]); ?>
                    </p>

                    <h3 class="card-title h5">
                      <?php echo textoSeguro($c["nombre_clase"]); ?>
                    </h3>

                    <?php if (!empty($c["profesor"])) { ?>
                      <p class="small text-secondary mb-3">
                        Profesor: <?php echo textoSeguro($c["profesor"]); ?>
                      </p>
                    <?php } ?>

                    <a class="boton-acceso boton-acceso--small mt-auto align-self-start"
                       href="clase.php?id_clase=<?php echo (int) $c["id_clase"]; ?>&tab=tareas">
                      Ver publicaciones
                    </a>
                  </div>
                </article>
              </div>
            <?php } ?>
          </div>
        <?php } ?>

      </main>

    </div>
  </div>

  <?php require_once "../includes/footer.php"; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>

</body>
</html>

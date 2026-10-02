<?php
require_once __DIR__ . "/../includes/alumno_acceso.php";
require_once __DIR__ . "/../includes/conexion.php";
require_once __DIR__ . "/../modelos/alumno_modelo.php";
require_once __DIR__ . "/../includes/utilidades.php";

function formatearFechaPanelAlumno($fecha)
{
  if ($fecha === null || $fecha === "") {
    return "";
  }

  $marca = strtotime((string) $fecha);

  if ($marca === false) {
    return (string) $fecha;
  }

  return date("d/m/Y H:i", $marca);
}

$idClase = isset($_GET["id_clase"]) ? (int) $_GET["id_clase"] : 0;
$tab = $_GET["tab"] ?? "tareas";

if ($idClase <= 0) {
  header("Location: mis_clases.php");
  exit;
}

if (!in_array($tab, ["tareas", "biblioteca", "mensajes"], true)) {
  $tab = "tareas";
}

$mapTabTipo = [
  "tareas" => "tarea",
  "biblioteca" => "material",
  "mensajes" => "mensaje",
];

$labelsTipo = [
  "tarea" => "Tarea",
  "material" => "Material",
  "mensaje" => "Mensaje",
];

$labelsTab = [
  "tareas" => "Tareas",
  "biblioteca" => "Biblioteca",
  "mensajes" => "Mensajes",
];

$claseActual = obtenerClaseAlumno($conexion, $idAlumno, $idClase);

if ($claseActual === null) {
  header("Location: mis_clases.php");
  exit;
}

$publicaciones = listarPublicacionesClaseAlumno(
  $conexion,
  $idAlumno,
  $idClase,
  $mapTabTipo[$tab]
);

$paginaActivaAlumno = "clases";
?>
<!doctype html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title><?php echo textoSeguro($claseActual["nombre_asignatura"]); ?> | Crescendo</title>

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

        <p class="mb-2">
          <a class="panel-admin-entity-link d-inline-flex align-items-center gap-1"
            href="mis_clases.php">
            <span class="material-symbols-outlined" aria-hidden="true">arrow_back</span>
            Volver a mis clases
          </a>
        </p>

        <h1 class="panel-admin-title">
          <?php echo textoSeguro($claseActual["nombre_asignatura"]); ?>
        </h1>

        <p class="panel-admin-tagline mb-1">
          <?php echo textoSeguro($claseActual["nombre_clase"]); ?>
        </p>

        <?php if (!empty($claseActual["profesor"])) { ?>
          <p class="text-secondary small mb-4">
            Profesor: <?php echo textoSeguro($claseActual["profesor"]); ?>
          </p>
        <?php } else { ?>
          <div class="mb-4"></div>
        <?php } ?>

        <ul class="panel-admin-actions-list list-unstyled d-flex flex-wrap justify-content-start mb-4 p-0">
          <?php foreach ($labelsTab as $claveTab => $etiquetaTab) { ?>
            <li class="nav-item">
              <a class="panel-admin-entity-link d-flex align-items-center gap-2 <?php echo $tab === $claveTab ? "is-active" : ""; ?>"
                href="clase.php?id_clase=<?php echo $idClase; ?>&tab=<?php echo textoSeguro($claveTab); ?>">
                <?php echo textoSeguro($etiquetaTab); ?>
              </a>
            </li>
          <?php } ?>
        </ul>

        <h2 class="panel-admin-section-title">
          <?php echo textoSeguro($labelsTab[$tab] ?? "Publicaciones"); ?>
        </h2>

        <?php if (empty($publicaciones)) { ?>
          <p class="text-secondary mb-0">
            No hay publicaciones disponibles en esta sección.
          </p>
        <?php } else { ?>
          <div class="row g-4 mt-2">
            <?php foreach ($publicaciones as $pub) { ?>
              <?php
              $tipo = $pub["tipo"];

              if (!in_array($tipo, ["tarea", "material", "mensaje"], true)) {
                $tipo = "tarea";
              }

              $fechaCreacion = formatearFechaPanelAlumno($pub["fecha_creacion"]);
              ?>

              <div class="col-12 col-xl-6">
                <article class="card prof-lienzo prof-lienzo--<?php echo textoSeguro($tipo); ?> h-100 text-light">
                  <div class="card-body">
                    <header class="prof-lienzo-cinta d-flex flex-wrap align-items-baseline justify-content-between gy-2 gx-3">
                      <span class="prof-lienzo-etiqueta">
                        <?php echo textoSeguro($labelsTipo[$tipo] ?? $tipo); ?>
                      </span>

                      <span class="prof-lienzo-fecha">
                        <?php echo textoSeguro($fechaCreacion); ?>
                      </span>
                    </header>

                    <h3 class="h5 card-title">
                      <?php echo textoSeguro($pub["titulo"]); ?>
                    </h3>

                    <p class="card-text mb-0">
                      <?php echo nl2br(textoSeguro($pub["contenido"])); ?>
                    </p>
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
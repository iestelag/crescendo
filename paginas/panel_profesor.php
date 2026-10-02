<?php
session_start();

require_once "../includes/utilidades.php";
require_once "../includes/conexion.php";
require_once "../modelos/profesor_modelo.php";

if (!isset($_SESSION["id_usuario"]) || $_SESSION["rol"] !== "profesor") {
  header("Location: login.php");
  exit;
}

$idProfesor = (int) $_SESSION["id_usuario"];
$profesorNombre = $_SESSION["nombre"] ?? "Profesor";

$vista = $_GET["vista"] ?? "tablero";

if (!in_array($vista, ["tablero", "nueva"], true)) {
  $vista = "tablero";
}

$idClaseFiltro = isset($_GET["id_clase"]) ? (int) $_GET["id_clase"] : 0;

$success = "";
$error = "";

$clases = listarClasesProfesor($conexion, $idProfesor);
$idsClasesPermitidas = array_map("intval", array_column($clases, "id_clase"));

if ($idClaseFiltro > 0 && !in_array($idClaseFiltro, $idsClasesPermitidas, true)) {
  $idClaseFiltro = 0;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  try {
    $accion = $_POST["accion"] ?? "";

    if ($accion === "crear") {
      $idClase = (int) ($_POST["id_clase"] ?? 0);
      $tipo = $_POST["tipo"] ?? "";
      $titulo = trim((string) ($_POST["titulo"] ?? ""));
      $contenido = trim((string) ($_POST["contenido"] ?? ""));

      if (!in_array($tipo, ["tarea", "material", "mensaje"], true)) {
        throw new Exception("Elige un tipo de tarjeta válido.");
      }

      if (!in_array($idClase, $idsClasesPermitidas, true)) {
        throw new Exception("Elige una clase válida.");
      }

      if ($titulo === "" || $contenido === "") {
        throw new Exception("Escribe título y contenido.");
      }

      crearPublicacion($conexion, $idProfesor, $idClase, $tipo, $titulo, $contenido);
      $success = "Tarjeta publicada.";
      $vista = "tablero";
    }

    if ($accion === "editar") {
      $idPublicacion = (int) ($_POST["id_publicacion"] ?? 0);
      $titulo = trim((string) ($_POST["titulo"] ?? ""));
      $contenido = trim((string) ($_POST["contenido"] ?? ""));

      if ($titulo === "" || $contenido === "") {
        throw new Exception("Título y contenido no pueden ir vacíos.");
      }

      editarPublicacion($conexion, $idPublicacion, $idProfesor, $titulo, $contenido);
      $success = "Cambios guardados.";
    }

    if ($accion === "eliminar") {
      $idPublicacion = (int) ($_POST["id_publicacion"] ?? 0);

      desactivarPublicacion($conexion, $idPublicacion, $idProfesor);
      $success = "Tarjeta eliminada.";
    }

  } catch (Exception $e) {
    $error = $e->getMessage();
  }
}

$publicaciones = listarPublicacionesProfesor($conexion, $idProfesor, $idClaseFiltro);

$labelsTipo = [
  "tarea" => "Nueva tarea",
  "material" => "Nuevo material",
  "mensaje" => "Nuevo mensaje",
];
?>

<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title>Panel del profesor | Crescendo</title>

  <link rel="icon" href="../imagenes/LOGO.png" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../estilos/estilos.css">
</head>

<body class="d-flex flex-column min-vh-100 text-light">

  <?php require_once "../includes/header.php"; ?>

  <div class="container-fluid flex-grow-1 panel-admin panel-profesor crescendo-panel">
    <div class="row g-4">

      <aside class="col-12 col-lg-3">
        <div class="rounded p-4 bg-black bg-opacity-25 h-100">

          <h2 class="panel-admin-aside-heading">Mi aula</h2>

          <ul class="panel-admin-entities list-unstyled d-flex flex-column mb-0 p-0">
            <li>
              <a class="panel-admin-entity-link d-flex align-items-center gap-2 <?php echo $vista === "tablero" ? "is-active" : ""; ?>"
                 href="?vista=tablero<?php echo $idClaseFiltro > 0 ? "&id_clase=" . (int) $idClaseFiltro : ""; ?>">
                <span class="material-symbols-outlined" aria-hidden="true">dashboard</span>
                Tablero
              </a>
            </li>

            <li>
              <a class="panel-admin-entity-link d-flex align-items-center gap-2 <?php echo $vista === "nueva" ? "is-active" : ""; ?>"
                 href="?vista=nueva<?php echo $idClaseFiltro > 0 ? "&id_clase=" . (int) $idClaseFiltro : ""; ?>">
                <span class="material-symbols-outlined" aria-hidden="true">post_add</span>
                Nueva tarjeta
              </a>
            </li>
          </ul>

          <p class="prof-filtro-titulo text-secondary small mt-3 mb-2">
            Filtrar por clase
          </p>

          <ul class="panel-admin-entities list-unstyled d-flex flex-column mb-0 p-0">
            <li>
              <a class="panel-admin-entity-link d-flex align-items-center gap-2 <?php echo $idClaseFiltro === 0 ? "is-active" : ""; ?>"
                 href="?vista=<?php echo textoSeguro($vista); ?>">
                Todas las clases
              </a>
            </li>

            <?php foreach ($clases as $c) { ?>
              <li>
                <a class="panel-admin-entity-link d-flex align-items-center gap-2 <?php echo $idClaseFiltro === (int) $c["id_clase"] ? "is-active" : ""; ?>"
                   href="?vista=<?php echo textoSeguro($vista); ?>&id_clase=<?php echo (int) $c["id_clase"]; ?>">
                  <span class="material-symbols-outlined" aria-hidden="true">class</span>
                  <?php echo textoSeguro($c["asignatura"] . " — " . $c["nombre"]); ?>
                </a>
              </li>
            <?php } ?>
          </ul>

        </div>
      </aside>

      <main class="col-12 col-lg-9 bg-black bg-opacity-25 rounded p-3">

        <h1 class="panel-admin-title">Panel del profesor</h1>

        <p class="panel-admin-tagline">
          Crea tarjetas de tarea, material o mensaje para tus clases.
        </p>

        <nav class="panel-admin-actions" aria-label="Vistas">
          <ul class="panel-admin-actions-list list-unstyled d-flex flex-wrap justify-content-center mb-0 p-0">

            <li>
              <a class="panel-admin-action-link d-inline-block <?php echo $vista === "tablero" ? "is-active" : ""; ?>"
                 href="?vista=tablero<?php echo $idClaseFiltro > 0 ? "&id_clase=" . (int) $idClaseFiltro : ""; ?>">
                Tablero
              </a>
            </li>

            <li>
              <a class="panel-admin-action-link d-inline-block <?php echo $vista === "nueva" ? "is-active" : ""; ?>"
                 href="?vista=nueva<?php echo $idClaseFiltro > 0 ? "&id_clase=" . (int) $idClaseFiltro : ""; ?>">
                Nueva tarjeta
              </a>
            </li>

          </ul>
        </nav>

        <?php if ($success !== "") { ?>
          <div class="alert alert-success">
            <?php echo textoSeguro($success); ?>
          </div>
        <?php } ?>

        <?php if ($error !== "") { ?>
          <div class="alert alert-danger">
            <?php echo textoSeguro($error); ?>
          </div>
        <?php } ?>

        <?php if ($vista === "nueva") { ?>

          <h2 class="panel-admin-section-title">Nueva tarjeta</h2>

          <?php if (empty($clases)) { ?>

            <p class="text-secondary">
              No tienes clases asignadas. Cuando el administrador te asigne una clase, podrás publicar aquí.
            </p>

          <?php } else { ?>

            <form method="POST" class="prof-lienzo prof-lienzo--borrador prof-lienzo--tarea row g-3" id="profFormNueva">

              <input type="hidden" name="accion" value="crear" />

              <div class="col-12 col-md-4">
                <label class="form-label">Tipo de tarjeta</label>

                <select class="form-select" name="tipo" id="profTipoNueva" required>
                  <option value="tarea">Nueva tarea</option>
                  <option value="material">Nuevo material</option>
                  <option value="mensaje">Nuevo mensaje</option>
                </select>
              </div>

              <div class="col-12 col-md-8">
                <label class="form-label">Clase</label>

                <select class="form-select" name="id_clase" required>
                  <option value="">Selecciona una clase…</option>

                  <?php foreach ($clases as $c) { ?>
                    <option value="<?php echo (int) $c["id_clase"]; ?>"
                      <?php echo $idClaseFiltro === (int) $c["id_clase"] ? "selected" : ""; ?>>
                      <?php echo textoSeguro($c["asignatura"] . " — " . $c["nombre"]); ?>
                    </option>
                  <?php } ?>
                </select>
              </div>

              <div class="col-12">
                <label class="form-label">Título</label>

                <input
                  class="form-control"
                  type="text"
                  name="titulo"
                  id="profTituloNueva"
                  maxlength="150"
                  required
                  placeholder="Ej: Tarea para el lunes"
                />
              </div>

              <div class="col-12">
                <label class="form-label">Contenido</label>

                <textarea
                  class="form-control prof-lienzo-textarea"
                  name="contenido"
                  rows="6"
                  required
                  placeholder="Escribe aquí la tarea, el aviso o el mensaje…"
                ></textarea>
              </div>

              <div class="col-12">
                <button type="submit" class="boton-acceso">
                  Publicar tarjeta
                </button>
              </div>

            </form>

          <?php } ?>

        <?php } else { ?>

          <h2 class="panel-admin-section-title">Tablero</h2>

          <?php if (empty($publicaciones)) { ?>
            <p class="text-secondary mb-0">
              Aún no hay tarjetas. Usa «Nueva tarjeta» para crear la primera.
            </p>
          <?php } ?>

          <div class="row g-4 mt-2">

            <?php foreach ($publicaciones as $pub) { ?>

              <?php
                $tipo = $pub["tipo"];

                if (!in_array($tipo, ["tarea", "material", "mensaje"], true)) {
                  $tipo = "tarea";
                }

                $fechaMostrar = !empty($pub["fecha_edicion"])
                  ? $pub["fecha_edicion"]
                  : $pub["fecha_creacion"];

                $etiquetaFecha = !empty($pub["fecha_edicion"])
                  ? "Editada"
                  : "Creada";
              ?>

              <div class="col-12 col-xl-6">

                <article class="prof-lienzo prof-lienzo--<?php echo textoSeguro($tipo); ?>">

                  <header class="prof-lienzo-cinta d-flex flex-wrap align-items-baseline justify-content-between gy-2 gx-3">
                    <span class="prof-lienzo-etiqueta">
                      <?php echo textoSeguro($labelsTipo[$tipo] ?? $tipo); ?>
                    </span>

                    <span class="prof-lienzo-fecha">
                      <?php echo textoSeguro($etiquetaFecha); ?>:
                      <?php echo textoSeguro($fechaMostrar); ?>
                    </span>
                  </header>

                  <p class="prof-lienzo-clase small text-secondary mb-2">
                    <?php echo textoSeguro($pub["asignatura"] . " — " . $pub["nombre_clase"]); ?>
                  </p>

                  <form method="POST" class="prof-lienzo-form">

                    <input type="hidden" name="accion" value="editar" />
                    <input type="hidden" name="id_publicacion" value="<?php echo (int) $pub["id_publicacion"]; ?>" />

                    <div class="mb-2">
                      <label class="form-label small">Título</label>

                      <input
                        class="form-control form-control-sm"
                        type="text"
                        name="titulo"
                        maxlength="150"
                        value="<?php echo textoSeguro($pub["titulo"]); ?>"
                        required
                      />
                    </div>

                    <div class="mb-3">
                      <label class="form-label small">Contenido</label>

                      <textarea
                        class="form-control prof-lienzo-textarea"
                        name="contenido"
                        rows="5"
                        required
                      ><?php echo textoSeguro($pub["contenido"]); ?></textarea>
                    </div>

                    <div class="d-flex flex-wrap gap-2 align-items-center">
                      <button type="submit" class="boton-acceso">
                        Guardar cambios
                      </button>
                    </div>

                  </form>

                  <form
                    method="POST"
                    class="mt-2"
                    data-confirmar-accion="eliminar"
                    data-confirmar-elemento="<?php echo textoSeguro($pub["titulo"]); ?>"
                  >
                    <input type="hidden" name="accion" value="eliminar" />
                    <input type="hidden" name="id_publicacion" value="<?php echo (int) $pub["id_publicacion"]; ?>" />

                    <button type="submit" class="btn btn-outline-danger btn-sm">
                      Eliminar
                    </button>
                  </form>

                </article>

              </div>

            <?php } ?>

          </div>

        <?php } ?>

      </main>

    </div>
  </div>

  <?php require_once "../includes/footer.php"; ?>

  <?php require_once "../includes/modal_confirmacion.php"; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="../js/admin_confirmacion.js"></script>
  <script src="../js/panel_profesor.js" defer></script>

</body>
</html>
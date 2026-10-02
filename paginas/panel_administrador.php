<?php
session_start();

require_once "../includes/utilidades.php";
require_once "../includes/conexion.php";
require_once "../modelos/admin_modelo.php";

if (!isset($_SESSION["id_usuario"]) || $_SESSION["rol"] !== "administrador") {
  header("Location: login.php");
  exit;
}

$adminNombre = $_SESSION["nombre"] ?? "Administrador";

$entity = $_GET["entity"] ?? "profesores";
$action = $_GET["action"] ?? "ver";

if (!in_array($entity, ["profesores", "alumnos", "asignaturas", "clases", "matriculas", "anuncios"])) {
  $entity = "profesores";
}

if (!in_array($action, ["ver", "crear", "editar", "desactivar", "activar"])) {
  $action = "ver";
}

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  try {

    if ($entity === "profesores") {

      if ($action === "crear") {
        crearProfesor($conexion, $_POST["nombre"], $_POST["apellidos"], $_POST["email"], $_POST["password"], $_POST["especialidad"]);
        $success = "Profesor creado correctamente.";
      }

      if ($action === "desactivar") {
        desactivarProfesor($conexion, $_POST["id_usuario"]);
        $success = "Profesor desactivado correctamente.";
      }

      if ($action === "activar") {
        activarUsuario($conexion, $_POST["id_usuario"]);
        $success = "Profesor activado correctamente.";
      }
    }

    if ($entity === "alumnos") {

      if ($action === "crear") {
        crearAlumno($conexion, $_POST["nombre"], $_POST["apellidos"], $_POST["email"], $_POST["password"], $_POST["nombre_tutor"], $_POST["telefono_tutor"]);
        $success = "Alumno creado correctamente.";
      }

      if ($action === "desactivar") {
        desactivarAlumno($conexion, $_POST["id_usuario"]);
        $success = "Alumno desactivado correctamente.";
      }

      if ($action === "activar") {
        activarUsuario($conexion, $_POST["id_usuario"]);
        $success = "Alumno activado correctamente.";
      }
    }

    if ($entity === "asignaturas") {

      if ($action === "crear") {
        crearAsignatura($conexion, $_POST["nombre"], $_POST["descripcion"]);
        $success = "Asignatura creada correctamente.";
      }

      if ($action === "desactivar") {
        cambiarEstadoAsignatura($conexion, $_POST["id_asignatura"], 0);
        $success = "Asignatura desactivada correctamente.";
      }

      if ($action === "activar") {
        cambiarEstadoAsignatura($conexion, $_POST["id_asignatura"], 1);
        $success = "Asignatura activada correctamente.";
      }
    }

    if ($entity === "clases") {

      if ($action === "crear") {
        crearClase(
          $conexion,
          $_POST["id_asignatura"],
          $_POST["id_profesor"],
          $_POST["nombre"],
          $_POST["horario"],
          $_POST["aula"]
        );
        $success = "Clase creada correctamente.";
      }

      if ($action === "desactivar") {
        cambiarEstadoClase($conexion, $_POST["id_clase"], 0);
        $success = "Clase desactivada correctamente.";
      }

      if ($action === "activar") {
        cambiarEstadoClase($conexion, $_POST["id_clase"], 1);
        $success = "Clase activada correctamente.";
      }
    }

    if ($entity === "matriculas") {

      if ($action === "crear") {
        asignarAlumnoAClase($conexion, $_POST["id_alumno"], $_POST["id_clase"]);
        $success = "Matrícula registrada correctamente.";
      }

      if ($action === "desactivar") {
        cambiarEstadoMatricula($conexion, $_POST["id_matricula"], 0);
        $success = "Matrícula desactivada correctamente.";
      }

      if ($action === "activar") {
        cambiarEstadoMatricula($conexion, $_POST["id_matricula"], 1);
        $success = "Matrícula reactivada correctamente.";
      }
    }

    if ($entity === "anuncios") {

      if ($action === "crear") {
        crearAnuncio(
          $conexion,
          (int) $_SESSION["id_usuario"],
          $_POST["titulo"],
          $_POST["contenido"]
        );
        $success = "Anuncio publicado correctamente.";
      }

      if ($action === "editar") {
        editarAnuncio(
          $conexion,
          (int) $_POST["id_anuncio"],
          $_POST["titulo"],
          $_POST["contenido"]
        );
        $success = "Anuncio actualizado correctamente.";
      }

      if ($action === "desactivar") {
        desactivarAnuncio($conexion, (int) $_POST["id_anuncio"]);
        $success = "Anuncio desactivado correctamente.";
      }

      if ($action === "activar") {
        activarAnuncio($conexion, (int) $_POST["id_anuncio"]);
        $success = "Anuncio activado correctamente.";
      }
    }
  } catch (PDOException $e) {
    $codigoMysql = isset($e->errorInfo[1]) ? (int) $e->errorInfo[1] : 0;
    if ($codigoMysql === 1062) {
      if ($entity === "matriculas") {
        $error = "Ese alumno ya está matriculado en esa clase. Si lo quitaste antes, reactívala en «Activar» en lugar de crearla de nuevo.";
      } else {
        $error = "Ya existe otro registro igual en la base de datos (no se permite duplicar).";
      }
    } else {
      $error = $e->getMessage();
    }
  } catch (Exception $e) {
    $error = $e->getMessage();
  }
}

$profesores = listarProfesores($conexion) ?? [];
$alumnos = listarAlumnos($conexion) ?? [];
$asignaturas = listarAsignaturas($conexion) ?? [];
$asignaturasActivas = listarAsignaturasActivas($conexion) ?? [];
$clases = listarClases($conexion) ?? [];
$matriculas = listarMatriculas($conexion) ?? [];
$alumnosActivos = listarAlumnosActivos($conexion) ?? [];
$clasesActivasLista = listarClasesActivas($conexion) ?? [];
$anuncios = listarAnuncios($conexion) ?? [];
$anuncioEditar = null;

if ($entity === "anuncios" && $action === "editar" && !empty($_GET["id_anuncio"])) {
  $anuncioEditar = obtenerAnuncioPorId($conexion, (int) $_GET["id_anuncio"]);
}
?>

<!doctype html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Panel de Gestión Académica | Crescendo</title>


  <link rel="icon" href="../imagenes/LOGO.png" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../estilos/estilos.css">
</head>

<body class="d-flex flex-column min-vh-100 text-light">

  <?php require_once "../includes/header.php"; ?>

  <div class="container-fluid flex-grow-1 panel-admin crescendo-panel">
    <div class="row g-4">

      <!-- ASIDE DE ENTIDADES -->
      <aside class="col-12 col-lg-3">
        <div class="rounded p-4 bg-black bg-opacity-25 h-100">
          <div class="panel-admin-aside-bar d-flex d-lg-none align-items-center justify-content-between gap-2 mb-2">
            <h2 class="panel-admin-aside-heading mb-0">Administración</h2>
            <button
              type="button"
              class="panel-admin-menu-toggle"
              data-bs-toggle="collapse"
              data-bs-target="#panelAdminEntities"
              aria-controls="panelAdminEntities"
              aria-expanded="false"
              aria-label="Mostrar u ocultar menú de entidades">
              <span class="material-symbols-outlined" aria-hidden="true">menu</span>
              <span class="visually-hidden">Menú de entidades</span>
            </button>
          </div>

          <h2 class="panel-admin-aside-heading d-none d-lg-block">Administración</h2>

          <div id="panelAdminEntities" class="panel-admin-entities-collapse collapse d-lg-block">
          <ul class="panel-admin-entities list-unstyled d-flex flex-column mb-0 p-0">
            <li>
              <a class="panel-admin-entity-link d-flex align-items-center gap-2 <?php echo $entity === "profesores" ? "is-active" : ""; ?>"
                href="?entity=profesores&action=<?php echo textoSeguro($action); ?>">
                <span class="material-symbols-outlined" aria-hidden="true">school</span>
                Profesores
              </a>
            </li>
            <li>
              <a class="panel-admin-entity-link d-flex align-items-center gap-2 <?php echo $entity === "alumnos" ? "is-active" : ""; ?>"
                href="?entity=alumnos&action=<?php echo textoSeguro($action); ?>">
                <span class="material-symbols-outlined" aria-hidden="true">groups</span>
                Alumnos
              </a>
            </li>
            <li>
              <a class="panel-admin-entity-link d-flex align-items-center gap-2 <?php echo $entity === "asignaturas" ? "is-active" : ""; ?>"
                href="?entity=asignaturas&action=<?php echo textoSeguro($action); ?>">
                <span class="material-symbols-outlined" aria-hidden="true">library_books</span>
                Asignaturas
              </a>
            </li>
            <li>
              <a class="panel-admin-entity-link d-flex align-items-center gap-2 <?php echo $entity === "clases" ? "is-active" : ""; ?>"
                href="?entity=clases&action=<?php echo textoSeguro($action); ?>">
                <span class="material-symbols-outlined" aria-hidden="true">menu_book</span>
                Clases
              </a>
            </li>
            <li>
              <a class="panel-admin-entity-link d-flex align-items-center gap-2 <?php echo $entity === "matriculas" ? "is-active" : ""; ?>"
                href="?entity=matriculas&action=<?php echo textoSeguro($action); ?>">
                <span class="material-symbols-outlined" aria-hidden="true">how_to_reg</span>
                Matrículas
              </a>
            </li>
            <li>
              <a class="panel-admin-entity-link d-flex align-items-center gap-2 <?php echo $entity === "anuncios" ? "is-active" : ""; ?>"
                href="?entity=anuncios&action=<?php echo textoSeguro($action); ?>">
                <span class="material-symbols-outlined" aria-hidden="true">campaign</span>
                Anuncios
              </a>
            </li>
          </ul>
          </div>
        </div>
      </aside>

      <!-- MAIN -->
      <main class="col-12 col-lg-9 bg-black bg-opacity-25 rounded p-3">
        <h1 class="panel-admin-title">Panel de gestión académica</h1>
        <p class="panel-admin-tagline">
          Gestiona clases, profesores y alumnos desde un solo lugar.
        </p>

        <nav class="panel-admin-actions" aria-label="Acciones del panel">
          <ul class="panel-admin-actions-list list-unstyled d-flex flex-wrap justify-content-center mb-0 p-0">
            <li>
              <a class="panel-admin-action-link d-inline-block <?php echo $action === "ver" ? "is-active" : ""; ?>"
                href="?entity=<?php echo textoSeguro($entity); ?>&action=ver">Ver</a>
            </li>
            <li>
              <a class="panel-admin-action-link d-inline-block <?php echo $action === "crear" ? "is-active" : ""; ?>"
                href="?entity=<?php echo textoSeguro($entity); ?>&action=crear">Crear</a>
            </li>
            <?php if ($entity === "anuncios") { ?>
            <li>
              <a class="panel-admin-action-link d-inline-block <?php echo $action === "editar" ? "is-active" : ""; ?>"
                href="?entity=anuncios&action=editar">Editar</a>
            </li>
            <?php } ?>
            <li>
              <a class="panel-admin-action-link d-inline-block <?php echo $action === "desactivar" ? "is-active" : ""; ?>"
                href="?entity=<?php echo textoSeguro($entity); ?>&action=desactivar">Desactivar</a>
            </li>
            <li>
              <a class="panel-admin-action-link d-inline-block <?php echo $action === "activar" ? "is-active" : ""; ?>"
                href="?entity=<?php echo textoSeguro($entity); ?>&action=activar">Activar</a>
            </li>
          </ul>
        </nav>

        <div id="mensaje-admin" class="alert d-none mb-3"></div>

        <?php if ($success !== "") { ?>
          <div class="alert alert-success"><?php echo textoSeguro($success); ?></div>
        <?php } ?>

        <?php if ($error !== "") { ?>
          <div class="alert alert-danger"><?php echo textoSeguro($error); ?></div>
        <?php } ?>

        <?php if ($entity === "profesores") { ?>

          <h2 class="panel-admin-section-title">Profesores — <?php echo ucfirst($action); ?></h2>

          <?php if ($action === "crear") { ?>
            <form method="POST" class="row g-3">
              <div class="col-md-6"><label class="form-label">Nombre</label><input class="form-control" type="text" name="nombre"
                  pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]{2,50}"
                  title="Solo letras y espacios (2-50 caracteres)"
                  required></div>
              <div class="col-md-6"><label class="form-label">Apellidos</label><input class="form-control" type="text" name="apellidos"
                  pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]{2,80}"
                  title="Solo letras y espacios"
                  required></div>
              <div class="col-md-6"><label class="form-label">Email</label><input class="form-control" type="email" name="email"
                  pattern="[a-zA-Z0-9._%+\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,}"
                  title="Introduce un correo válido"
                  required></div>
              <div class="col-md-6"><label class="form-label">Contraseña</label><input class="form-control" type="text" name="password"
                  pattern="(?=.*[A-Za-z])(?=.*[0-9]).{6,}"
                  title="Mínimo 6 caracteres, una letra y un número"
                  required></div>
              <div class="col-md-6"><label class="form-label">Especialidad</label><input class="form-control" type="text" name="especialidad"
                  pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]{2,50}"
                  title="Solo letras y espacios"
                  required></div>
              <div class="col-12"><button class="boton-acceso" type="submit">Guardar profesor</button></div>
            </form>

          <?php } elseif ($action === "desactivar") { ?>
            <form method="POST" class="row g-3" data-confirmar-accion="desactivar">
              <div class="col-md-8">
                <label class="form-label">Profesor</label>
                <select class="form-select" name="id_usuario" required>
                  <option value="">Selecciona...</option>
                  <?php foreach ($profesores as $profesor) {
                    if ($profesor["activo"] == 0) continue; ?>
                    <option value="<?php echo textoSeguro($profesor["id_usuario"]); ?>">
                      <?php echo textoSeguro($profesor["nombre"] . " " . $profesor["apellidos"] . " - " . $profesor["email"]); ?>
                    </option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-md-4 d-flex align-items-end">
                <button class="boton-acceso w-100 boton-desactivar" type="submit">Desactivar profesor</button>
              </div>
            </form>

          <?php } elseif ($action === "activar") { ?>
            <form method="POST" class="row g-3" data-confirmar-accion="activar">
              <div class="col-md-8">
                <label class="form-label">Profesor</label>
                <select class="form-select" name="id_usuario" required>
                  <option value="">Selecciona...</option>
                  <?php foreach ($profesores as $profesor) {
                    if ($profesor["activo"] == 1) continue; ?>
                    <option value="<?php echo textoSeguro($profesor["id_usuario"]); ?>">
                      <?php echo textoSeguro($profesor["nombre"] . " " . $profesor["apellidos"] . " - " . $profesor["email"]); ?>
                    </option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-md-4 d-flex align-items-end">
                <button class="boton-acceso w-100" type="submit">Activar profesor</button>
              </div>
            </form>

          <?php } else { ?>
            <div class="table-responsive">
              <table class="table table-dark table-striped align-middle" data-inline-entity="profesores">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Email</th>
                    <th>Especialidad</th>
                    <th>Activo</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (empty($profesores)) { ?>
                    <tr>
                      <td colspan="7">No hay profesores registrados.</td>
                    </tr>
                  <?php } ?>
                  <?php foreach ($profesores as $profesor) { ?>
                    <tr data-id="<?php echo textoSeguro($profesor["id_usuario"]); ?>">
                      <td><?php echo textoSeguro($profesor["id_usuario"]); ?></td>
                      <td data-field="nombre"><?php echo textoSeguro($profesor["nombre"]); ?></td>
                      <td data-field="apellidos"><?php echo textoSeguro($profesor["apellidos"]); ?></td>
                      <td data-field="email"><?php echo textoSeguro($profesor["email"]); ?></td>
                      <td data-field="especialidad"><?php echo textoSeguro($profesor["especialidad"]); ?></td>
                      <td><?php echo $profesor["activo"] ? "Sí" : "No"; ?></td>
                      <td>
                        <button type="button" class="btn btn-outline-light btn-sm boton-inline-editar">Editar</button>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          <?php } ?>

        <?php } elseif ($entity === "alumnos") { ?>

          <h2 class="panel-admin-section-title">Alumnos — <?php echo ucfirst($action); ?></h2>

          <?php if ($action === "crear") { ?>
            <form method="POST" class="row g-3">
              <div class="col-md-6"><label class="form-label">Nombre</label><input class="form-control" type="text" name="nombre"
                  pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]{2,50}"
                  title="Solo letras y espacios (2-50 caracteres)"
                  required></div>
              <div class="col-md-6"><label class="form-label">Apellidos</label><input class="form-control" type="text" name="apellidos"
                  pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]{2,80}"
                  title="Solo letras y espacios"
                  required></div>
              <div class="col-md-6"><label class="form-label">Email</label><input class="form-control" type="email" name="email"
                  pattern="[a-zA-Z0-9._%+\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,}"
                  title="Introduce un correo válido"
                  required></div>
              <div class="col-md-6"><label class="form-label">Contraseña</label><input class="form-control" type="text" name="password"
                  pattern="(?=.*[A-Za-z])(?=.*[0-9]).{6,}"
                  title="Mínimo 6 caracteres, una letra y un número"
                  required></div>
              <div class="col-md-6"><label class="form-label">Nombre del tutor</label><input class="form-control" type="text" name="nombre_tutor"
                  pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]{2,50}"
                  title="Solo letras y espacios (2-50 caracteres)"></div>
              <div class="col-md-6"><label class="form-label">Teléfono del tutor</label><input class="form-control" type="text" name="telefono_tutor"
                  pattern="[0-9]{9}"
                  title="Debe contener 9 números"></div>
              <div class="col-12"><button class="boton-acceso" type="submit">Guardar alumno</button></div>
            </form>

          <?php } elseif ($action === "desactivar") { ?>
            <form method="POST" class="row g-3" data-confirmar-accion="desactivar">
              <div class="col-md-8">
                <label class="form-label">Alumno</label>
                <select class="form-select" name="id_usuario" required>
                  <option value="">Selecciona...</option>
                  <?php foreach ($alumnos as $alumno) {
                    if ($alumno["activo"] == 0) continue; ?>
                    <option value="<?php echo textoSeguro($alumno["id_usuario"]); ?>">
                      <?php echo textoSeguro($alumno["nombre"] . " " . $alumno["apellidos"] . " - " . $alumno["email"]); ?>
                    </option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-md-4 d-flex align-items-end">
                <button class="boton-acceso w-100 boton-desactivar" type="submit">Desactivar alumno</button>
              </div>
            </form>

          <?php } elseif ($action === "activar") { ?>
            <form method="POST" class="row g-3" data-confirmar-accion="activar">
              <div class="col-md-8">
                <label class="form-label">Alumno</label>
                <select class="form-select" name="id_usuario" required>
                  <option value="">Selecciona...</option>
                  <?php foreach ($alumnos as $alumno) {
                    if ($alumno["activo"] == 1) continue; ?>
                    <option value="<?php echo textoSeguro($alumno["id_usuario"]); ?>">
                      <?php echo textoSeguro($alumno["nombre"] . " " . $alumno["apellidos"] . " - " . $alumno["email"]); ?>
                    </option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-md-4 d-flex align-items-end">
                <button class="boton-acceso w-100" type="submit">Activar alumno</button>
              </div>
            </form>

          <?php } else { ?>
            <div class="table-responsive">
              <table class="table table-dark table-striped align-middle" data-inline-entity="alumnos">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Email</th>
                    <th>Tutor</th>
                    <th>Teléfono tutor</th>
                    <th>Activo</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (empty($alumnos)) { ?>
                    <tr>
                      <td colspan="8">No hay alumnos registrados.</td>
                    </tr>
                  <?php } ?>
                  <?php foreach ($alumnos as $alumno) { ?>
                    <tr data-id="<?php echo textoSeguro($alumno["id_usuario"]); ?>">
                      <td><?php echo textoSeguro($alumno["id_usuario"]); ?></td>
                      <td data-field="nombre"><?php echo textoSeguro($alumno["nombre"]); ?></td>
                      <td data-field="apellidos"><?php echo textoSeguro($alumno["apellidos"]); ?></td>
                      <td data-field="email"><?php echo textoSeguro($alumno["email"]); ?></td>
                      <td data-field="nombre_tutor"><?php echo textoSeguro($alumno["nombre_tutor"]); ?></td>
                      <td data-field="telefono_tutor"><?php echo textoSeguro($alumno["telefono_tutor"]); ?></td>
                      <td><?php echo $alumno["activo"] ? "Sí" : "No"; ?></td>
                      <td>
                        <button type="button" class="btn btn-outline-light btn-sm boton-inline-editar">Editar</button>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          <?php } ?>

        <?php } elseif ($entity === "asignaturas") { ?>

          <h2 class="panel-admin-section-title">Asignaturas — <?php echo ucfirst($action); ?></h2>

          <?php if ($action === "crear") { ?>
            <form method="POST" class="row g-3">
              <div class="col-md-6"><label class="form-label">Nombre</label><input class="form-control" type="text" name="nombre" required></div>
              <div class="col-12"><label class="form-label">Descripción</label><textarea class="form-control" name="descripcion" rows="3"></textarea></div>
              <div class="col-12"><button class="boton-acceso" type="submit">Guardar asignatura</button></div>
            </form>

          <?php } elseif ($action === "desactivar") { ?>
            <form method="POST" class="row g-3" data-confirmar-accion="desactivar">
              <div class="col-md-8">
                <label class="form-label">Asignatura</label>
                <select class="form-select" name="id_asignatura" required>
                  <option value="">Selecciona...</option>
                  <?php foreach ($asignaturas as $asig) { ?>
                    <?php if ($asig["activo"] == 0) {
                      continue;
                    } ?>
                    <option value="<?php echo textoSeguro($asig["id_asignatura"]); ?>">
                      <?php echo textoSeguro($asig["nombre"]); ?>
                    </option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-md-4 d-flex align-items-end">
                <button class="boton-acceso w-100 boton-desactivar" type="submit">Desactivar asignatura</button>
              </div>
            </form>

          <?php } elseif ($action === "activar") { ?>
            <form method="POST" class="row g-3" data-confirmar-accion="activar">
              <div class="col-md-8">
                <label class="form-label">Asignatura</label>
                <select class="form-select" name="id_asignatura" required>
                  <option value="">Selecciona...</option>
                  <?php foreach ($asignaturas as $asig) { ?>
                    <?php if ($asig["activo"] == 1) {
                      continue;
                    } ?>
                    <option value="<?php echo textoSeguro($asig["id_asignatura"]); ?>">
                      <?php echo textoSeguro($asig["nombre"]); ?>
                    </option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-md-4 d-flex align-items-end">
                <button class="boton-acceso w-100" type="submit">Activar asignatura</button>
              </div>
            </form>

          <?php } else { ?>
            <div class="table-responsive">
              <table class="table table-dark table-striped align-middle">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Activa</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (empty($asignaturas)) { ?>
                    <tr>
                      <td colspan="4">No hay asignaturas.</td>
                    </tr>
                  <?php } ?>
                  <?php foreach ($asignaturas as $asig) { ?>
                    <tr>
                      <td><?php echo textoSeguro($asig["id_asignatura"]); ?></td>
                      <td><?php echo textoSeguro($asig["nombre"]); ?></td>
                      <td><?php echo textoSeguro($asig["descripcion"]); ?></td>
                      <td><?php echo $asig["activo"] ? "Sí" : "No"; ?></td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          <?php } ?>

        <?php } elseif ($entity === "clases") { ?>

          <h2 class="panel-admin-section-title">Clases — <?php echo ucfirst($action); ?></h2>

          <?php if ($action === "crear") { ?>
            <form method="POST" class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Asignatura</label>
                <select class="form-select" name="id_asignatura" required>
                  <option value="">Selecciona...</option>
                  <?php foreach ($asignaturasActivas as $asig) { ?>
                    <option value="<?php echo textoSeguro($asig["id_asignatura"]); ?>">
                      <?php echo textoSeguro($asig["nombre"]); ?>
                    </option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label">Profesor</label>
                <select class="form-select" name="id_profesor" required>
                  <option value="">Selecciona...</option>
                  <?php foreach ($profesores as $prof) { ?>
                    <?php if ($prof["activo"] == 0) {
                      continue;
                    } ?>
                    <option value="<?php echo textoSeguro($prof["id_usuario"]); ?>">
                      <?php echo textoSeguro($prof["nombre"] . " " . $prof["apellidos"]); ?>
                    </option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-md-6"><label class="form-label">Nombre de la clase</label><input class="form-control" type="text" name="nombre" required></div>
              <div class="col-md-6"><label class="form-label">Horario</label><input class="form-control" type="text" name="horario" placeholder="Ej: Lunes 10:00-11:00"></div>
              <div class="col-md-6"><label class="form-label">Aula</label><input class="form-control" type="text" name="aula"></div>
              <div class="col-12"><button class="boton-acceso" type="submit">Guardar clase</button></div>
            </form>

          <?php } elseif ($action === "desactivar") { ?>
            <form method="POST" class="row g-3" data-confirmar-accion="desactivar">
              <div class="col-md-8">
                <label class="form-label">Clase</label>
                <select class="form-select" name="id_clase" required>
                  <option value="">Selecciona...</option>
                  <?php foreach ($clases as $cl) { ?>
                    <?php if ($cl["activo"] == 0) {
                      continue;
                    } ?>
                    <option value="<?php echo textoSeguro($cl["id_clase"]); ?>">
                      <?php echo textoSeguro($cl["nombre"]); ?>
                    </option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-md-4 d-flex align-items-end">
                <button class="boton-acceso w-100 boton-desactivar" type="submit">Desactivar clase</button>
              </div>
            </form>

          <?php } elseif ($action === "activar") { ?>
            <form method="POST" class="row g-3" data-confirmar-accion="activar">
              <div class="col-md-8">
                <label class="form-label">Clase</label>
                <select class="form-select" name="id_clase" required>
                  <option value="">Selecciona...</option>
                  <?php foreach ($clases as $cl) { ?>
                    <?php if ($cl["activo"] == 1) {
                      continue;
                    } ?>
                    <option value="<?php echo textoSeguro($cl["id_clase"]); ?>">
                      <?php echo textoSeguro($cl["nombre"]); ?>
                    </option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-md-4 d-flex align-items-end">
                <button class="boton-acceso w-100" type="submit">Activar clase</button>
              </div>
            </form>

          <?php } else { ?>
            <div class="table-responsive">
              <table class="table table-dark table-striped align-middle">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Clase</th>
                    <th>Asignatura</th>
                    <th>Profesor</th>
                    <th>Horario</th>
                    <th>Aula</th>
                    <th>Activa</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (empty($clases)) { ?>
                    <tr>
                      <td colspan="7">No hay clases.</td>
                    </tr>
                  <?php } ?>
                  <?php foreach ($clases as $cl) { ?>
                    <tr>
                      <td><?php echo textoSeguro($cl["id_clase"]); ?></td>
                      <td><?php echo textoSeguro($cl["nombre"]); ?></td>
                      <td><?php echo textoSeguro($cl["asignatura"]); ?></td>
                      <td><?php echo textoSeguro($cl["profesor"]); ?></td>
                      <td><?php echo textoSeguro($cl["horario"]); ?></td>
                      <td><?php echo textoSeguro($cl["aula"]); ?></td>
                      <td><?php echo $cl["activo"] ? "Sí" : "No"; ?></td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          <?php } ?>

        <?php } elseif ($entity === "matriculas") { ?>

          <h2 class="panel-admin-section-title">Matrículas — <?php echo ucfirst($action); ?></h2>

          <?php if ($action === "crear") { ?>
            <form method="POST" class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Alumno</label>
                <select class="form-select" name="id_alumno" required>
                  <option value="">Selecciona...</option>
                  <?php foreach (($alumnosActivos ?? []) as $alu) { ?>
                    <option value="<?php echo textoSeguro($alu["id_usuario"]); ?>">
                      <?php echo textoSeguro($alu["nombre"] . " " . $alu["apellidos"] . " — " . $alu["email"]); ?>
                    </option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label">Clase</label>
                <select class="form-select" name="id_clase" required>
                  <option value="">Selecciona...</option>
                  <?php foreach ($clasesActivasLista as $cla) { ?>
                    <option value="<?php echo textoSeguro($cla["id_clase"]); ?>">
                      <?php echo textoSeguro($cla["asignatura"] . " — " . $cla["nombre"]); ?>
                    </option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-12"><button class="boton-acceso" type="submit">Asignar alumno a la clase</button></div>
            </form>

          <?php } elseif ($action === "desactivar") { ?>
            <form method="POST" class="row g-3" data-confirmar-accion="desactivar">
              <div class="col-md-8">
                <label class="form-label">Matrícula activa</label>
                <select class="form-select" name="id_matricula" required>
                  <option value="">Selecciona...</option>
                  <?php foreach ($matriculas as $mat) { ?>
                    <?php if ($mat["activo"] == 0) {
                      continue;
                    } ?>
                    <option value="<?php echo textoSeguro($mat["id_matricula"]); ?>">
                      <?php echo textoSeguro($mat["alumno"] . " → " . $mat["asignatura"] . " — " . $mat["clase"]); ?>
                    </option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-md-4 d-flex align-items-end">
                <button class="boton-acceso w-100 boton-desactivar" type="submit">Desactivar matrícula</button>
              </div>
            </form>

          <?php } elseif ($action === "activar") { ?>
            <form method="POST" class="row g-3" data-confirmar-accion="activar">
              <div class="col-md-8">
                <label class="form-label">Matrícula inactiva</label>
                <select class="form-select" name="id_matricula" required>
                  <option value="">Selecciona...</option>
                  <?php foreach ($matriculas as $mat) { ?>
                    <?php if ($mat["activo"] == 1) {
                      continue;
                    } ?>
                    <option value="<?php echo textoSeguro($mat["id_matricula"]); ?>">
                      <?php echo textoSeguro($mat["alumno"] . " → " . $mat["asignatura"] . " — " . $mat["clase"]); ?>
                    </option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-md-4 d-flex align-items-end">
                <button class="boton-acceso w-100" type="submit">Reactivar matrícula</button>
              </div>
            </form>

          <?php } else { ?>
            <div class="table-responsive">
              <table class="table table-dark table-striped align-middle">
                <thead>
                  <tr>
                    <th>Alumno</th>
                    <th>Asignatura</th>
                    <th>Clase</th>
                    <th>Fecha</th>
                    <th>Activa</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (empty($matriculas)) { ?>
                    <tr>
                      <td colspan="5">No hay matrículas.</td>
                    </tr>
                  <?php } ?>
                  <?php foreach ($matriculas as $mat) { ?>
                    <tr>
                      <td><?php echo textoSeguro($mat["alumno"]); ?></td>
                      <td><?php echo textoSeguro($mat["asignatura"]); ?></td>
                      <td><?php echo textoSeguro($mat["clase"]); ?></td>
                      <td><?php echo textoSeguro($mat["fecha_matricula"]); ?></td>
                      <td><?php echo $mat["activo"] ? "Sí" : "No"; ?></td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          <?php } ?>

        <?php } elseif ($entity === "anuncios") { ?>

          <h2 class="panel-admin-section-title">Anuncios — <?php echo ucfirst($action); ?></h2>

          <?php if ($action === "crear") { ?>
            <form method="POST" class="row g-3">
              <div class="col-12">
                <label class="form-label">Título</label>
                <input class="form-control" type="text" name="titulo" maxlength="150" required>
              </div>
              <div class="col-12">
                <label class="form-label">Contenido</label>
                <textarea class="form-control" name="contenido" rows="5" required></textarea>
              </div>
              <div class="col-12">
                <button class="boton-acceso" type="submit">Publicar anuncio</button>
              </div>
            </form>

          <?php } elseif ($action === "editar") { ?>

            <?php if (!$anuncioEditar) { ?>
              <form method="GET" class="row g-3 mb-4">
                <input type="hidden" name="entity" value="anuncios">
                <input type="hidden" name="action" value="editar">
                <div class="col-md-8">
                  <label class="form-label">Selecciona un anuncio</label>
                  <select class="form-select" name="id_anuncio" required onchange="this.form.submit()">
                    <option value="">Selecciona...</option>
                    <?php foreach ($anuncios as $anuncio) { ?>
                      <option value="<?php echo textoSeguro($anuncio["id_anuncio"]); ?>">
                        <?php echo textoSeguro($anuncio["titulo"]); ?>
                      </option>
                    <?php } ?>
                  </select>
                </div>
              </form>
            <?php } else { ?>
              <form method="POST" class="row g-3">
                <input type="hidden" name="id_anuncio" value="<?php echo textoSeguro($anuncioEditar["id_anuncio"]); ?>">
                <div class="col-12">
                  <label class="form-label">Título</label>
                  <input class="form-control" type="text" name="titulo" maxlength="150"
                    value="<?php echo textoSeguro($anuncioEditar["titulo"]); ?>" required>
                </div>
                <div class="col-12">
                  <label class="form-label">Contenido</label>
                  <textarea class="form-control" name="contenido" rows="5" required><?php echo textoSeguro($anuncioEditar["contenido"]); ?></textarea>
                </div>
                <div class="col-12">
                  <button class="boton-acceso" type="submit">Guardar cambios</button>
                </div>
              </form>
            <?php } ?>

          <?php } elseif ($action === "desactivar") { ?>
            <form method="POST" class="row g-3" data-confirmar-accion="desactivar">
              <div class="col-md-8">
                <label class="form-label">Anuncio</label>
                <select class="form-select" name="id_anuncio" required>
                  <option value="">Selecciona...</option>
                  <?php foreach ($anuncios as $anuncio) { ?>
                    <?php if ((int) $anuncio["activo"] === 0) {
                      continue;
                    } ?>
                    <option value="<?php echo textoSeguro($anuncio["id_anuncio"]); ?>">
                      <?php echo textoSeguro($anuncio["titulo"]); ?>
                    </option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-md-4 d-flex align-items-end">
                <button class="boton-acceso w-100 boton-desactivar" type="submit">Desactivar anuncio</button>
              </div>
            </form>

          <?php } elseif ($action === "activar") { ?>
            <form method="POST" class="row g-3" data-confirmar-accion="activar">
              <div class="col-md-8">
                <label class="form-label">Anuncio</label>
                <select class="form-select" name="id_anuncio" required>
                  <option value="">Selecciona...</option>
                  <?php foreach ($anuncios as $anuncio) { ?>
                    <?php if ((int) $anuncio["activo"] === 1) {
                      continue;
                    } ?>
                    <option value="<?php echo textoSeguro($anuncio["id_anuncio"]); ?>">
                      <?php echo textoSeguro($anuncio["titulo"]); ?>
                    </option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-md-4 d-flex align-items-end">
                <button class="boton-acceso w-100" type="submit">Activar anuncio</button>
              </div>
            </form>

          <?php } else { ?>
            <div class="table-responsive">
              <table class="table table-dark table-striped align-middle">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Administrador</th>
                    <th>Creación</th>
                    <th>Edición</th>
                    <th>Activo</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (empty($anuncios)) { ?>
                    <tr>
                      <td colspan="6">No hay anuncios.</td>
                    </tr>
                  <?php } ?>
                  <?php foreach ($anuncios as $anuncio) { ?>
                    <tr>
                      <td><?php echo textoSeguro($anuncio["id_anuncio"]); ?></td>
                      <td><?php echo textoSeguro($anuncio["titulo"]); ?></td>
                      <td><?php echo textoSeguro($anuncio["administrador"]); ?></td>
                      <td><?php echo textoSeguro($anuncio["fecha_creacion"]); ?></td>
                      <td><?php echo $anuncio["fecha_edicion"] ? textoSeguro($anuncio["fecha_edicion"]) : "—"; ?></td>
                      <td><?php echo (int) $anuncio["activo"] ? "Sí" : "No"; ?></td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          <?php } ?>

        <?php } ?>
      </main>
    </div>
  </div>

  <?php require_once "../includes/footer.php"; ?>

  <?php require_once "../includes/modal_confirmacion.php"; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="../js/admin_ajax.js"></script>
  <script src="../js/admin_confirmacion.js"></script>

</body>

</html>
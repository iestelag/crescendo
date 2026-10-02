<?php
$paginaActiva = "formulario";
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Crescendo | Solicitud de matrícula</title>

  <link rel="icon" href="../imagenes/LOGO.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../estilos/estilos.css">
</head>

<body class="d-flex flex-column min-vh-100 text-light">

  <?php require_once "../includes/header.php"; ?>

  <main class="container flex-grow-1 py-4 py-md-5">
    <section class="mx-auto formulario-crescendo" style="max-width: 950px;">

      <div class="text-center rounded p-4 mb-4 bg-black bg-opacity-25">
        <h1 class="h2 mb-3">Solicitud de matrícula</h1>
        <p class="mb-0 text-secondary">
          Completa los datos y te contactaremos para confirmar tu plaza.
        </p>
      </div>

      <form id="formularioContacto"
            class="formulario-ficticio rounded p-4 p-md-5 bg-black bg-opacity-25"
            data-mensaje-exito="Solicitud enviada correctamente. Nos pondremos en contacto contigo próximamente."
            action="#"
            method="post">

        <div class="alert alert-success mensaje-exito d-none mb-3" role="status" aria-live="polite">
          Solicitud enviada correctamente. Nos pondremos en contacto contigo próximamente.
        </div>

        <div class="row g-4 mb-5">
          <div class="col-12 col-md-6">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text"
                   id="nombre"
                   name="nombre"
                   class="form-control formulario-crescendo-input"
                   required
                   pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]{2,50}$"
                   title="Introduce solo letras y espacios, entre 2 y 50 caracteres">
          </div>

          <div class="col-12 col-md-6">
            <label for="apellidos" class="form-label">Apellidos</label>
            <input type="text"
                   id="apellidos"
                   name="apellidos"
                   class="form-control formulario-crescendo-input"
                   required
                   pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]{2,50}$"
                   title="Introduce solo letras y espacios, entre 2 y 50 caracteres">
          </div>

          <div class="col-12 col-md-6">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="tel"
                   id="telefono"
                   name="telefono"
                   class="form-control formulario-crescendo-input"
                   required
                   pattern="^[679][0-9]{8}$"
                   title="Introduce un teléfono válido de 9 dígitos">
          </div>

          <div class="col-12 col-md-6">
            <label for="tutor" class="form-label">Nombre del tutor/a (si es menor)</label>
            <input type="text"
                   id="tutor"
                   name="tutor"
                   class="form-control formulario-crescendo-input"
                   pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]{2,50}$"
                   title="Introduce solo letras y espacios, entre 2 y 50 caracteres">
          </div>

          <div class="col-12 col-md-6">
            <label for="dni" class="form-label">DNI (del tutor o del alumno si es mayor)</label>
            <input type="text"
                   id="dni"
                   name="dni"
                   class="form-control formulario-crescendo-input"
                   required
                   pattern="^[0-9]{8}[A-Za-z]$|^[XYZxyz][0-9]{7}[A-Za-z]$"
                   title="Introduce un DNI (8 dígitos y letra) o un NIE (X, Y o Z, 7 dígitos y letra) válido"
                   maxlength="9">
          </div>

          <div class="col-12 col-md-6">
            <label for="iban" class="form-label">IBAN</label>
            <input type="text"
                   id="iban"
                   name="iban"
                   class="form-control formulario-crescendo-input"
                   required
                   pattern="^[Ee][Ss][0-9]{2}(?:\s?[0-9]{4}){5}$"
                   title="Introduce un IBAN español válido (ES + 22 dígitos; puedes usar espacios cada 4 cifras)"
                   maxlength="32">
          </div>
        </div>

        <div class="mb-5">
          <h2 class="h4 mb-4">Instrumentos</h2>

          <div class="row g-3">
            <div class="col-12 col-sm-6 col-lg-4">
              <div class="form-check">
                <input class="form-check-input instrumento-check"
                       type="checkbox"
                       name="instrumentos[]"
                       value="Piano"
                       id="piano">
                <label class="form-check-label" for="piano">Piano</label>
              </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-4">
              <div class="form-check">
                <input class="form-check-input instrumento-check"
                       type="checkbox"
                       name="instrumentos[]"
                       value="Guitarra"
                       id="guitarra">
                <label class="form-check-label" for="guitarra">Guitarra</label>
              </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-4">
              <div class="form-check">
                <input class="form-check-input instrumento-check"
                       type="checkbox"
                       name="instrumentos[]"
                       value="Violín"
                       id="violin">
                <label class="form-check-label" for="violin">Violín</label>
              </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-4">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="instrumentos" value="Canto" id="canto">
                <label class="form-check-label" for="canto">Canto</label>
              </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-4">
              <div class="form-check">
                <input class="form-check-input instrumento-check"
                       type="checkbox"
                       name="instrumentos[]"
                       value="Batería"
                       id="bateria">
                <label class="form-check-label" for="bateria">Batería</label>
              </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-4">
              <div class="form-check">
                <input class="form-check-input instrumento-check"
                       type="checkbox"
                       name="instrumentos[]"
                       value="Flauta"
                       id="flauta">
                <label class="form-check-label" for="flauta">Flauta</label>
              </div>
            </div>
          </div>
        </div>

        <div class="mb-5">
          <h2 class="h4 mb-4">Duración semanal</h2>

          <div class="row g-3">
            <div class="col-12 col-md-4">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="duracion" value="30min" id="duracion30" required>
                <label class="form-check-label" for="duracion30">30 minutos</label>
              </div>
            </div>

            <div class="col-12 col-md-4">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="duracion" value="1h" id="duracion1h">
                <label class="form-check-label" for="duracion1h">1 hora</label>
              </div>
            </div>

            <div class="col-12 col-md-4">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="duracion" value="2h" id="duracion2h">
                <label class="form-check-label" for="duracion2h">2 horas</label>
              </div>
            </div>
          </div>
        </div>

        <div class="text-center">
          <button type="submit" class="boton-acceso px-4 py-2">
            Enviar solicitud
          </button>
        </div>

      </form>

    </section>
  </main>

  <?php require_once "../includes/footer.php"; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
  <script src="../js/formulario.js" defer></script>

</body>
</html>

<?php
$paginaActiva = "ayuda";
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Crescendo | Soporte</title>

  <link rel="icon" href="../imagenes/LOGO.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../estilos/estilos.css">
</head>

<body class="d-flex flex-column min-vh-100 text-light">

  <?php require_once "../includes/header.php"; ?>

  <div class="container-fluid px-4 flex-grow-1">
    <div class="row g-4">
      <main class="col-12 col-lg-9 mx-auto text-center">
        <div class="rounded p-4 p-md-5 bg-black bg-opacity-25 formulario-crescendo">

          <section class="mb-5 text-center">
            <h1 class="mb-3">Centro de Soporte</h1>
            <p class="text-light mb-0">
              Consulta las preguntas frecuentes y, si lo necesitas, envíanos tu
              duda a través del buzón de consultas.
            </p>
          </section>

          <section id="faq" class="mb-5 text-start">
            <h2 class="h4 mb-4 text-center">Preguntas frecuentes</h2>

            <div class="accordion" id="acordeonAyuda">

              <div class="accordion-item border-secondary">
                <h3 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#pregunta1" aria-expanded="false" aria-controls="pregunta1">
                    ¿Cómo accedo a mis clases?
                  </button>
                </h3>
                <div id="pregunta1" class="accordion-collapse collapse" data-bs-parent="#acordeonAyuda">
                  <div class="accordion-body">
                    Debes dirigirte al apartado <strong>Mis clases</strong>
                    desde el menú de navegación. Allí podrás entrar en cada
                    asignatura y consultar su contenido.
                  </div>
                </div>
              </div>

              <div class="accordion-item border-secondary">
                <h3 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#pregunta2" aria-expanded="false" aria-controls="pregunta2">
                    ¿Dónde puedo consultar mis mensajes?
                  </button>
                </h3>
                <div id="pregunta2" class="accordion-collapse collapse" data-bs-parent="#acordeonAyuda">
                  <div class="accordion-body">
                    En la sección <strong>Mensajes</strong> encontrarás la
                    información relacionada con la comunicación dentro de la
                    plataforma.
                  </div>
                </div>
              </div>

              <div class="accordion-item border-secondary">
                <h3 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#pregunta3" aria-expanded="false" aria-controls="pregunta3">
                    ¿Qué hago si no se reproduce un contenido multimedia?
                  </button>
                </h3>
                <div id="pregunta3" class="accordion-collapse collapse" data-bs-parent="#acordeonAyuda">
                  <div class="accordion-body">
                    Comprueba tu conexión a internet, revisa el volumen del
                    dispositivo y actualiza la página. También es recomendable
                    utilizar un navegador actualizado.
                  </div>
                </div>
              </div>

              <div class="accordion-item border-secondary">
                <h3 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#pregunta4" aria-expanded="false" aria-controls="pregunta4">
                    ¿Qué navegador se recomienda para usar Crescendo?
                  </button>
                </h3>
                <div id="pregunta4" class="accordion-collapse collapse" data-bs-parent="#acordeonAyuda">
                  <div class="accordion-body">
                    Se recomienda utilizar navegadores actualizados como
                    Google Chrome, Microsoft Edge o Mozilla Firefox para una
                    mejor experiencia.
                  </div>
                </div>
              </div>

              <div class="accordion-item border-secondary">
                <h3 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#pregunta5" aria-expanded="false" aria-controls="pregunta5">
                    ¿Cómo puedo solicitar información sobre una clase?
                  </button>
                </h3>
                <div id="pregunta5" class="accordion-collapse collapse" data-bs-parent="#acordeonAyuda">
                  <div class="accordion-body">
                    Puedes usar el formulario de esta página o la sección
                    <strong>Únete a nuestra escuela</strong> para enviar una solicitud.
                    Indica la clase que te interesa y te contactaremos con los detalles.
                  </div>
                </div>
              </div>

              <div class="accordion-item border-secondary">
                <h3 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#pregunta6" aria-expanded="false" aria-controls="pregunta6">
                    ¿Las clases pueden ser individuales o colectivas?
                  </button>
                </h3>
                <div id="pregunta6" class="accordion-collapse collapse" data-bs-parent="#acordeonAyuda">
                  <div class="accordion-body">
                    Sí. En Crescendo ofrecemos clases individuales y colectivas según
                    la asignatura y el grupo. Al solicitar información puedes indicar
                    qué modalidad prefieres.
                  </div>
                </div>
              </div>

              <div class="accordion-item border-secondary">
                <h3 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#pregunta7" aria-expanded="false" aria-controls="pregunta7">
                    ¿Puedo cambiar de grupo más adelante?
                  </button>
                </h3>
                <div id="pregunta7" class="accordion-collapse collapse" data-bs-parent="#acordeonAyuda">
                  <div class="accordion-body">
                    En la mayoría de casos es posible, siempre que haya plazas
                    disponibles en el nuevo grupo. Contacta con secretaría o envía
                    tu consulta a través del buzón de esta página.
                  </div>
                </div>
              </div>

              <div class="accordion-item border-secondary">
                <h3 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#pregunta8" aria-expanded="false" aria-controls="pregunta8">
                    ¿Necesito tener conocimientos previos?
                  </button>
                </h3>
                <div id="pregunta8" class="accordion-collapse collapse" data-bs-parent="#acordeonAyuda">
                  <div class="accordion-body">
                    No es imprescindible. Tenemos grupos para distintos niveles,
                    desde iniciación hasta avanzado. El profesorado adaptará el
                    contenido a tu experiencia.
                  </div>
                </div>
              </div>

              <div class="accordion-item border-secondary">
                <h3 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#pregunta9" aria-expanded="false" aria-controls="pregunta9">
                    ¿Cómo accedo a la plataforma online?
                  </button>
                </h3>
                <div id="pregunta9" class="accordion-collapse collapse" data-bs-parent="#acordeonAyuda">
                  <div class="accordion-body">
                    Pulsa <strong>Acceso a la plataforma</strong> en la parte superior
                    de la web e inicia sesión con el usuario y contraseña que te
                    haya facilitado el centro.
                  </div>
                </div>
              </div>

            </div>
          </section>

        </div>
      </main>

      <section id="buzon-consultas" class="col-12 col-lg-9 mx-auto mb-4">
        <div class="text-center mb-4">
          <h2 class="h4 mb-3">Buzón de consultas</h2>
          <p class="text-secondary mb-0">
            Si tienes alguna duda, sugerencia o incidencia, puedes enviarnos un
            mensaje a través de este formulario.
          </p>
        </div>

        <form id="formularioAyuda"
              class="formulario-ficticio rounded p-4 p-md-5 bg-black bg-opacity-25 text-start formulario-crescendo"
              data-mensaje-exito="Mensaje enviado correctamente. Te responderemos lo antes posible."
              action="#"
              method="post">

          <div class="alert alert-success mensaje-exito d-none mb-3 text-start" role="status" aria-live="polite">
            Mensaje enviado correctamente. Te responderemos lo antes posible.
          </div>

          <div class="row g-3">
            <div class="col-12 col-md-6">
              <label for="nombre" class="form-label">Nombre</label>
              <input type="text"
                     class="form-control formulario-crescendo-input"
                     id="nombre"
                     name="nombre"
                     placeholder="Introduce tu nombre"
                     required
                     pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]{2,50}$"
                     title="Introduce solo letras y espacios, entre 2 y 50 caracteres"
                     autocomplete="name">
            </div>

            <div class="col-12 col-md-6">
              <label for="correo" class="form-label">Correo electrónico</label>
              <input type="email"
                     class="form-control formulario-crescendo-input"
                     id="correo"
                     name="correo"
                     placeholder="nombre@correo.com"
                     required
                     maxlength="60"
                     title="Introduce un correo electrónico válido"
                     autocomplete="email">
            </div>

            <div class="col-12">
              <label for="asunto" class="form-label">Asunto</label>
              <input type="text"
                     class="form-control formulario-crescendo-input"
                     id="asunto"
                     name="asunto"
                     placeholder="Escribe el asunto de tu consulta"
                     required
                     minlength="3">
            </div>

            <div class="col-12">
              <label for="mensaje" class="form-label">Mensaje</label>
              <textarea class="form-control formulario-crescendo-input"
                        id="mensaje"
                        name="mensaje"
                        rows="5"
                        placeholder="Escribe aquí tu consulta"
                        required
                        minlength="10"
                        maxlength="1000"
                        title="El mensaje debe tener entre 10 y 1000 caracteres"></textarea>
            </div>

            <div class="col-12">
              <div class="form-check">
                <input class="form-check-input"
                       type="checkbox"
                       id="privacidad"
                       name="privacidad"
                       required>
                <label class="form-check-label" for="privacidad">
                  He leído y acepto la política de privacidad
                </label>
              </div>
            </div>

            <div class="col-12 text-center">
              <button type="submit" class="boton-acceso fw-semibold px-4">
                Enviar consulta
              </button>
            </div>
          </div>
        </form>
      </section>

    </div>
  </div>

  <?php require_once "../includes/footer.php"; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
  <script src="../js/formulario.js" defer></script>

</body>

</html>

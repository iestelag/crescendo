<?php
$paginaActiva = "conocenos";
?>
<!doctype html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Crescendo | Sobre nosotros</title>

  <link rel="icon" href="../imagenes/LOGO.png" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../estilos/estilos.css" />
</head>

<body class="d-flex flex-column min-vh-100 text-light">

  <?php require_once "../includes/header.php"; ?>

  <main class="container py-5 ">
    <section class="mb-5 text-center">
      <h2 class="mb-3">Galería de imágenes</h2>
      <p class="text-light">
        Descubre nuestras clases, actividades y el ambiente que se vive en
        Crescendo.
      </p>
    </section>

    <div id="galeriaCarousel" class="carousel slide mb-5" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#galeriaCarousel" data-bs-slide-to="0" class="active" aria-current="true"
          aria-label="Imagen 1"></button>
        <button type="button" data-bs-target="#galeriaCarousel" data-bs-slide-to="1" aria-label="Imagen 2"></button>
        <button type="button" data-bs-target="#galeriaCarousel" data-bs-slide-to="2" aria-label="Imagen 3"></button>
        <button type="button" data-bs-target="#galeriaCarousel" data-bs-slide-to="3" aria-label="Imagen 4"></button>
      </div>

      <div class="carousel-inner rounded">
        <div class="carousel-item active">
          <img src="../imagenes/Galeria/aula-piano.jpg" class="d-block w-100 imagen-carrusel" alt="Aula de piano" />
          <div class="carousel-caption d-none d-md-block fondo-caption rounded">
            <h3 class="h5">Aula de piano</h3>
            <p class="mb-0">Clases individuales</p>
          </div>
        </div>

        <div class="carousel-item">
          <img src="../imagenes/Galeria/salon-actos.jpg" class="d-block w-100 imagen-carrusel" alt="Salón de actos" />
          <div class="carousel-caption d-none d-md-block fondo-caption rounded">
            <h3 class="h5">Salón de actos</h3>
            <p class="mb-0">Lugar donde se realizan conciertos</p>
          </div>
        </div>

        <div class="carousel-item">
          <img src="../imagenes/Galeria/concierto.jpg" class="d-block w-100 imagen-carrusel" alt="Concierto" />
          <div class="carousel-caption d-none d-md-block fondo-caption rounded">
            <h3 class="h5">Conciertos</h3>
            <p class="mb-0">Experiencia escénica</p>
          </div>
        </div>

        <div class="carousel-item">
          <img src="../imagenes/Galeria/evento.png" class="d-block w-100 imagen-carrusel" alt="Evento Crescendo" />
          <div class="carousel-caption d-none d-md-block fondo-caption rounded">
            <h3 class="h5">Evento Crescendo</h3>
            <p class="mb-0">Fiesta de fin de curso</p>
          </div>
        </div>
      </div>

      <button class="carousel-control-prev" type="button" data-bs-target="#galeriaCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
      </button>

      <button class="carousel-control-next" type="button" data-bs-target="#galeriaCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Siguiente</span>
      </button>
    </div>
    <section class="mb-5">
      <div class="text-center mb-4">
        <h2 class="mb-3">Nuestro profesorado</h2>
        <p class="text-light">
          Conoce a los profesionales que forman parte de Crescendo.
        </p>
      </div>
      <div class="row g-4 justify-content-center">

        <div class="col-12 col-sm-6 col-md-4 col-xl-3">
          <div class="card-profe card  bg-black bg-opacity-25 text-light border-secondary h-100">
            <img src="../imagenes/profesores/lucia-herrera.png" class="card-img-top" alt="Profesora de piano">

            <div class="card-body text-center">
              <h3 class="h5 card-title">Lucía Herrera</h3>
              <p class="card-text text-secondary">Profesora de Piano</p>

              <button type="button" class="boton-acceso boton-acceso--small" data-bs-toggle="modal"
                data-bs-target="#modalLucia">
                Ver biografía
              </button>
            </div>
          </div>
        </div>

        <div class="col-12 col-sm-6 col-md-4 col-xl-3">
          <div class="card-profe card bg-black bg-opacity-25 text-light border-secondary h-100">
            <img src="../imagenes/profesores/daniel-ruiz.png" class="card-img-top" alt="Profesor de guitarra">

            <div class="card-body text-center">
              <h3 class="h5 card-title">Daniel Ruiz</h3>
              <p class="card-text text-secondary">Profesor de Guitarra</p>

              <button type="button" class="boton-acceso boton-acceso--small" data-bs-toggle="modal"
                data-bs-target="#modalDaniel">
                Ver biografía
              </button>
            </div>
          </div>
        </div>

        <div class="col-12 col-sm-6 col-md-4 col-xl-3">
          <div class="card-profe card  bg-black bg-opacity-25 text-light border-secondary h-100">
            <img src="../imagenes/profesores/marta-lopez.png" class="card-img-top" alt="Profesora de canto">

            <div class="card-body text-center">
              <h3 class="h5 card-title">Marta López</h3>
              <p class="card-text text-secondary">Profesora de Canto</p>

              <button type="button" class="boton-acceso boton-acceso--small" data-bs-toggle="modal"
                data-bs-target="#modalMarta">
                Ver biografía
              </button>
            </div>
          </div>
        </div>

        <div class="col-12 col-sm-6 col-md-4 col-xl-3">
          <div class="card-profe card  bg-black bg-opacity-25 text-light border-secondary h-100">
            <img src="../imagenes/profesores/alvaro-montes.png" class="card-img-top" alt="Profesor de violín">

            <div class="card-body text-center">
              <h3 class="h5 card-title">Álvaro Montes</h3>
              <p class="card-text text-secondary">Profesor de Violín</p>

              <button type="button" class="boton-acceso boton-acceso--small" data-bs-toggle="modal"
                data-bs-target="#modalAlvaro">
                Ver biografía
              </button>
            </div>
          </div>
        </div>

        <div class="col-12 col-sm-6 col-md-4 col-xl-3">
          <div class="card-profe card  bg-black bg-opacity-25 text-light border-secondary h-100">
            <img src="../imagenes/profesores/sergio-valdes.png" class="card-img-top" alt="Profesor de batería">

            <div class="card-body text-center">
              <h3 class="h5 card-title">Sergio Valdés</h3>
              <p class="card-text text-secondary">Profesor de Batería</p>

              <button type="button" class="boton-acceso boton-acceso--small" data-bs-toggle="modal"
                data-bs-target="#modalSergio">
                Ver biografía
              </button>
            </div>
          </div>
        </div>

        <div class="col-12 col-sm-6 col-md-4 col-xl-3">
          <div class="card-profe card  bg-black bg-opacity-25 text-light border-secondary h-100">
            <img src="../imagenes/profesores/alejandro-vega.png" class="card-img-top" alt="Director musical">

            <div class="card-body text-center">
              <h3 class="h5 card-title">Alejandro Vega</h3>
              <p class="card-text text-secondary">Head of Music</p>

              <button type="button" class="boton-acceso boton-acceso--small" data-bs-toggle="modal"
                data-bs-target="#modalAlejandro">
                Ver biografía
              </button>
            </div>
          </div>
        </div>

      </div>
    </section>
    <div class="modal fade" id="modalLucia" tabindex="-1" aria-labelledby="modalLuciaLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-light">
          <div class="modal-header border-secondary">
            <h2 class="modal-title fs-5" id="modalLuciaLabel">
              Lucía Herrera
            </h2>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
              aria-label="Cerrar"></button>
          </div>
          <div class="modal-body">
            <p>
              Lucía Herrera es profesora de piano con más de 10 años de
              experiencia en formación musical. Especializada en música
              clásica y moderna, acompaña al alumnado en su desarrollo técnico
              y expresivo desde nivel inicial hasta avanzado.
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="modalDaniel" tabindex="-1" aria-labelledby="modalDanielLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-light">
          <div class="modal-header border-secondary">
            <h2 class="modal-title fs-5" id="modalDanielLabel">
              Daniel Ruiz
            </h2>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
              aria-label="Cerrar"></button>
          </div>
          <div class="modal-body">
            <p>
              Daniel Ruiz es guitarrista y docente especializado en guitarra
              acústica y eléctrica. Su metodología combina técnica, repertorio
              y creatividad para que cada estudiante avance a su ritmo y
              disfrute del aprendizaje musical.
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="modalMarta" tabindex="-1" aria-labelledby="modalMartaLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-light">
          <div class="modal-header border-secondary">
            <h2 class="modal-title fs-5" id="modalMartaLabel">Marta López</h2>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
              aria-label="Cerrar"></button>
          </div>
          <div class="modal-body">
            <p>
              Marta López es profesora de canto y técnica vocal. Trabaja
              respiración, afinación, interpretación y presencia escénica,
              ayudando al alumnado a desarrollar su voz con confianza y
              seguridad.
            </p>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modalAlvaro" tabindex="-1" aria-labelledby="modalAlvaroLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-light">
          <div class="modal-header border-secondary">
            <h2 class="modal-title fs-5" id="modalAlvaroLabel">Álvaro Montes</h2>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
              aria-label="Cerrar"></button>
          </div>
          <div class="modal-body">
            <p>
              Álvaro Montes es profesor de violín y lenguaje musical. Su enfoque
              combina disciplina técnica y sensibilidad artística, ayudando al
              alumnado a desarrollar oído, musicalidad y seguridad en escena.
            </p>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modalSergio" tabindex="-1" aria-labelledby="modalSergioLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-light">
          <div class="modal-header border-secondary">
            <h2 class="modal-title fs-5" id="modalSergioLabel">Sergio Valdés</h2>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
              aria-label="Cerrar"></button>
          </div>
          <div class="modal-body">
            <p>
              Sergio Valdés es profesor de batería y percusión. En sus clases
              trabaja ritmo, coordinación y creatividad, adaptando el aprendizaje
              al nivel de cada estudiante para que avance de forma dinámica y práctica.
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="modalAlejandro" tabindex="-1" aria-labelledby="modalAlejandroLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-light">
          <div class="modal-header border-secondary">
            <h2 class="modal-title fs-5" id="modalAlejandroLabel">
              Alejandro Vega
            </h2>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
              aria-label="Cerrar"></button>
          </div>
          <div class="modal-body">
            <p>
              Alejandro Vega es el Director Musical y Head of Music de Crescendo.
              Con una amplia trayectoria en interpretación y dirección pedagógica,
              coordina el equipo docente y supervisa el desarrollo académico de
              las clases para garantizar una formación musical completa y de calidad.
            </p>
          </div>
        </div>
      </div>
    </div>
    <section class="container my-5">

  <div class="text-center mb-5">
    <h2>Nuestro alumnado</h2>
    <p class="text-light">
      Algunas interpretaciones realizadas por estudiantes y profesorado de Crescendo.
    </p>
  </div>

  <div class="row g-4">

    <div class="col-12 col-md-6">
      <div class="card h-100 bg-dark text-light">
        <div class="ratio ratio-16x9">
          <iframe src="https://www.youtube.com/embed/rR28r0BJs2Q" allowfullscreen></iframe>
        </div>
        <div class="card-body">
          <h3 class="h5 card-title">Día de Andalucía</h3>
          <p class="card-text">
            Estela Gómez Fernández interpreta una obra original de música española
            compuesta para el concierto del Día de Andalucía.
          </p>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-6">
      <div class="card h-100 bg-dark text-light">
        <div class="ratio ratio-16x9">
          <iframe src="https://www.youtube.com/embed/7yKFlIJgSiI" allowfullscreen></iframe>
        </div>
        <div class="card-body">
          <h3 class="h5 card-title">Tributo a Danny Elfman</h3>
          <p class="card-text">
            Interpretación pianística inspirada en la música del compositor Danny Elfman.
          </p>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-6">
      <div class="card h-100 bg-dark text-light">
        <div class="ratio ratio-16x9">
          <iframe src="https://www.youtube.com/embed/_wfe2LjnBfk" allowfullscreen></iframe>
        </div>
        <div class="card-body">
          <h3 class="h5 card-title">Interpretación al piano</h3>
          <p class="card-text">
            Actuación musical interpretada por alumnado del centro.
          </p>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-6">
      <div class="card h-100 bg-dark text-light">
        <div class="ratio ratio-16x9">
          <iframe src="https://www.youtube.com/embed/dP2h56gqziQ" allowfullscreen></iframe>
        </div>
        <div class="card-body">
          <h3 class="h5 card-title">Interpretación musical</h3>
          <p class="card-text">
            Ejemplo del trabajo artístico realizado por nuestro alumnado.
          </p>
        </div>
      </div>
    </div>

  </div>
  </section>
</main>

  <?php require_once "../includes/footer.php"; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
</body>

</html>

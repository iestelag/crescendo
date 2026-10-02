<aside class="col-12 col-lg-3">
  <div class="rounded p-4 bg-black bg-opacity-25 h-100">

    <h2 class="panel-admin-aside-heading">Panel del alumno</h2>

    <ul class="panel-admin-entities list-unstyled d-flex flex-column mb-0 p-0">
      <li>
        <a class="panel-admin-entity-link d-flex align-items-center gap-2 <?php echo $paginaActivaAlumno === "inicio" ? "is-active" : ""; ?>"
           href="panel_alumno.php">
          <span class="material-symbols-outlined" aria-hidden="true">dashboard</span>
          Inicio
        </a>
      </li>

      <li>
        <a class="panel-admin-entity-link d-flex align-items-center gap-2 <?php echo $paginaActivaAlumno === "clases" ? "is-active" : ""; ?>"
           href="mis_clases.php">
          <span class="material-symbols-outlined" aria-hidden="true">class</span>
          Mis clases
        </a>
      </li>
    </ul>

  </div>
</aside>

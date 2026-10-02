(function () {
  "use strict";

  function bindFormNuevaTarjeta() {
    var selectTipo = document.getElementById("profTipoNueva");
    var titulo = document.getElementById("profTituloNueva");
    var formNueva = document.getElementById("profFormNueva");

    if (!selectTipo || !formNueva) {
      return;
    }

    function actualizarFormulario() {
      if (titulo) {
        if (selectTipo.value === "tarea") {
          titulo.placeholder = "Ej: Tarea para el lunes";
        }

        if (selectTipo.value === "material") {
          titulo.placeholder = "Ej: Nuevo material — unidad 2";
        }

        if (selectTipo.value === "mensaje") {
          titulo.placeholder = "Ej: Recordatorio de clase";
        }
      }

      formNueva.className =
        "prof-lienzo prof-lienzo--borrador prof-lienzo--" +
        selectTipo.value +
        " row g-3";
    }

    selectTipo.addEventListener("change", actualizarFormulario);
    actualizarFormulario();
  }

  function init() {
    bindFormNuevaTarjeta();
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", init);
  } else {
    init();
  }
})();

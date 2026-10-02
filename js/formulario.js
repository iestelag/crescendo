document.addEventListener("DOMContentLoaded", function () {
  const selectores = ["#formularioContacto", "#formularioAyuda"];

  selectores.forEach(function (selector) {
    const formulario = document.querySelector(selector);

    if (!formulario) {
      return;
    }

    enlazarFormularioFicticio(formulario);
  });
});

function enlazarFormularioFicticio(formulario) {
  const instrumentos = formulario.querySelectorAll(".instrumento-check");
  const mensajeExito = formulario.querySelector(".mensaje-exito");

  function validarInstrumentos() {
    if (instrumentos.length === 0) {
      return;
    }

    const algunoMarcado = Array.from(instrumentos).some(function (instrumento) {
      return instrumento.checked;
    });

    instrumentos[0].setCustomValidity(
      algunoMarcado ? "" : "Selecciona al menos un instrumento"
    );
  }

  if (instrumentos.length > 0) {
    instrumentos.forEach(function (instrumento) {
      instrumento.addEventListener("change", validarInstrumentos);
    });
  }

  formulario.addEventListener("submit", function (evento) {
    evento.preventDefault();

    validarInstrumentos();

    if (!formulario.checkValidity()) {
      formulario.reportValidity();
      return;
    }

    if (mensajeExito) {
      mensajeExito.textContent =
        formulario.dataset.mensajeExito || mensajeExito.textContent;
      mensajeExito.classList.remove("d-none");
    }

    formulario.reset();
  });
}

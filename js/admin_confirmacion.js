$(document).ready(function () {

    const modalElement = document.getElementById("modalConfirmarAccion");

    if (!modalElement) {
        return;
    }

    const modal = new bootstrap.Modal(modalElement);
    const $modal = $(modalElement);
    let formularioPendiente = null;

    const textosAccion = {
        desactivar: {
            pregunta: "¿Seguro que quieres desactivar este elemento?",
            detalle: "Esta acción cambiará su estado en el sistema.",
            confirmar: "Desactivar"
        },
        activar: {
            pregunta: "¿Seguro que quieres activar este elemento?",
            detalle: "Esta acción cambiará su estado en el sistema.",
            confirmar: "Activar"
        },
        eliminar: {
            pregunta: "¿Eliminar esta tarjeta?",
            detalle: "Se borrará de forma permanente.",
            confirmar: "Eliminar"
        }
    };

    modalElement.addEventListener("hidden.bs.modal", function () {
        formularioPendiente = null;
    });

    $(document).on("submit", "form[data-confirmar-accion]", function (e) {
        e.preventDefault();

        const formulario = this;

        if (!formulario.checkValidity()) {
            formulario.reportValidity();
            return;
        }

        const select = $(formulario).find("select[required]").first();

        if (select.length && !select.val()) {
            formulario.reportValidity();
            return;
        }

        const accion = $(formulario).data("confirmar-accion");
        const textos = textosAccion[accion] || textosAccion.desactivar;
        const nombreElemento =
            ($(formulario).data("confirmar-elemento") || "").toString().trim() ||
            (select.length ? select.find("option:selected").text().trim() : "");

        $modal.find(".modal-crescendo-pregunta").text(textos.pregunta);
        $modal.find(".modal-crescendo-detalle").text(textos.detalle);
        $modal.find(".modal-crescendo-elemento").text(nombreElemento);
        $("#modalConfirmarAccionBtn").text(textos.confirmar);

        formularioPendiente = formulario;
        modal.show();
    });

    $("#modalConfirmarAccionBtn").on("click", function () {
        if (!formularioPendiente) {
            return;
        }

        const formulario = formularioPendiente;
        formularioPendiente = null;
        modal.hide();
        formulario.submit();
    });

});

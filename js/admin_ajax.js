$(document).ready(function () {

    function mostrarMensaje(texto, tipo) {

        let mensaje = $("#mensaje-admin");

        if (mensaje.length === 0) {
            return;
        }

        mensaje
            .removeClass("d-none alert-success alert-danger")
            .addClass("alert-" + tipo)
            .text(texto);

        setTimeout(function () {

            mensaje
                .addClass("d-none")
                .text("");

        }, 3000);
    }

    $(document).on("click", ".boton-inline-editar", function () {

        let boton = $(this);
        let fila = boton.closest("tr");

        fila.find("[data-field]").each(function () {

            let celda = $(this);
            let valor = celda.text().trim();

            celda.html(
                '<input class="form-control form-control-sm" value="' +
                valor +
                '">'
            );
        });

        boton
            .removeClass("boton-inline-editar")
            .addClass("boton-inline-guardar")
            .text("Guardar");
    });

    $(document).on("click", ".boton-inline-guardar", function () {

        let boton = $(this);

        let fila = boton.closest("tr");

        let entidad = fila
            .closest("[data-inline-entity]")
            .data("inline-entity");

        let datos = {
            id_usuario: fila.data("id")
        };

        fila.find("[data-field]").each(function () {

            let campo = $(this).data("field");

            let valor = $(this)
                .find("input")
                .val();

            datos[campo] = valor;
        });

        let url = entidad === "profesores"
            ? "../ajax/actualizar_profesor.php"
            : "../ajax/actualizar_alumno.php";

        $.ajax({

            url: url,

            type: "POST",

            data: datos,

            dataType: "json",

            success: function (respuesta) {

                if (!respuesta.ok) {

                    mostrarMensaje(respuesta.mensaje, "danger");

                    return;
                }

                fila.find("[data-field]").each(function () {

                    let campo = $(this).data("field");

                    $(this).text(datos[campo]);
                });

                boton
                    .removeClass("boton-inline-guardar")
                    .addClass("boton-inline-editar")
                    .text("Editar");

                mostrarMensaje(respuesta.mensaje, "success");
            },

            error: function () {

                mostrarMensaje(
                    "Error en la petición AJAX.",
                    "danger"
                );
            }
        });
    });

});
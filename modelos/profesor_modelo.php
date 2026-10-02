<?php

function listarClasesProfesor($conexion, $idProfesor)
{
    $sql = "SELECT c.id_clase, c.nombre,
                   a.nombre AS asignatura
            FROM clases c
            INNER JOIN asignaturas a
            ON c.id_asignatura = a.id_asignatura
            WHERE c.id_profesor = :id_profesor
            AND c.activo = 1
            ORDER BY a.nombre, c.nombre";

    $stmt = $conexion->prepare($sql);

    $stmt->execute([
        ":id_profesor" => $idProfesor
    ]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function crearPublicacion(
    $conexion,
    $idProfesor,
    $idClase,
    $tipo,
    $titulo,
    $contenido
)
{
    $sql = "INSERT INTO publicaciones
            (
                id_profesor,
                id_clase,
                tipo,
                titulo,
                contenido
            )
            VALUES
            (
                :id_profesor,
                :id_clase,
                :tipo,
                :titulo,
                :contenido
            )";

    $stmt = $conexion->prepare($sql);

    $stmt->execute([
        ":id_profesor" => $idProfesor,
        ":id_clase" => $idClase,
        ":tipo" => $tipo,
        ":titulo" => $titulo,
        ":contenido" => $contenido
    ]);
}
function listarPublicacionesProfesor($conexion, $idProfesor, $idClaseFiltro = 0)
{
    $sql = "SELECT p.id_publicacion, p.id_clase, p.tipo, p.titulo, p.contenido,
                   p.fecha_creacion, p.fecha_edicion, p.activo,
                   c.nombre AS nombre_clase,
                   a.nombre AS asignatura
            FROM publicaciones p
            INNER JOIN clases c ON p.id_clase = c.id_clase
            INNER JOIN asignaturas a ON c.id_asignatura = a.id_asignatura
            WHERE p.id_profesor = :id_profesor
            AND p.activo = 1";

    $params = [
        ":id_profesor" => $idProfesor
    ];

    if ($idClaseFiltro > 0) {
        $sql .= " AND p.id_clase = :id_clase";
        $params[":id_clase"] = $idClaseFiltro;
    }

    $sql .= " ORDER BY p.fecha_creacion DESC";

    $stmt = $conexion->prepare($sql);
    $stmt->execute($params);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function editarPublicacion($conexion, $idPublicacion, $idProfesor, $titulo, $contenido)
{
    $sql = "UPDATE publicaciones
            SET titulo = :titulo,
                contenido = :contenido,
                fecha_edicion = NOW()
            WHERE id_publicacion = :id_publicacion
            AND id_profesor = :id_profesor
            AND activo = 1";

    $stmt = $conexion->prepare($sql);

    $stmt->execute([
        ":titulo" => $titulo,
        ":contenido" => $contenido,
        ":id_publicacion" => $idPublicacion,
        ":id_profesor" => $idProfesor
    ]);
}
function desactivarPublicacion($conexion, $idPublicacion, $idProfesor)
{
    $sql = "UPDATE publicaciones
            SET activo = 0
            WHERE id_publicacion = :id_publicacion
            AND id_profesor = :id_profesor";

    $stmt = $conexion->prepare($sql);

    $stmt->execute([
        ":id_publicacion" => $idPublicacion,
        ":id_profesor" => $idProfesor
    ]);
}
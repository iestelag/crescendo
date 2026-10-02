<?php

function listarClasesAlumno($conexion, $idAlumno)
{
    $sql = "SELECT c.id_clase,
                   c.nombre AS nombre_clase,
                   a.nombre AS nombre_asignatura,
                   CONCAT(u.nombre, ' ', u.apellidos) AS profesor
            FROM alumno_clase ac
            INNER JOIN clases c ON ac.id_clase = c.id_clase
            INNER JOIN asignaturas a ON c.id_asignatura = a.id_asignatura
            INNER JOIN usuarios u ON c.id_profesor = u.id_usuario
            WHERE ac.id_alumno = :id_alumno
            AND ac.activo = 1
            AND c.activo = 1
            AND a.activo = 1
            ORDER BY a.nombre, c.nombre";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([
        ":id_alumno" => $idAlumno
    ]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function obtenerClaseAlumno($conexion, $idAlumno, $idClase)
{
    $sql = "SELECT c.id_clase,
                   c.nombre AS nombre_clase,
                   a.nombre AS nombre_asignatura,
                   CONCAT(u.nombre, ' ', u.apellidos) AS profesor
            FROM alumno_clase ac
            INNER JOIN clases c ON ac.id_clase = c.id_clase
            INNER JOIN asignaturas a ON c.id_asignatura = a.id_asignatura
            INNER JOIN usuarios u ON c.id_profesor = u.id_usuario
            WHERE ac.id_alumno = :id_alumno
            AND ac.id_clase = :id_clase
            AND ac.activo = 1
            AND c.activo = 1
            AND a.activo = 1
            LIMIT 1";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([
        ":id_alumno" => $idAlumno,
        ":id_clase" => $idClase
    ]);

    $fila = $stmt->fetch(PDO::FETCH_ASSOC);

    return $fila ?: null;
}

function listarPublicacionesClaseAlumno($conexion, $idAlumno, $idClase, $tipo)
{
    if (!in_array($tipo, ["tarea", "material", "mensaje"], true)) {
        return [];
    }

    $sql = "SELECT p.id_publicacion,
                   p.tipo,
                   p.titulo,
                   p.contenido,
                   p.fecha_creacion,
                   p.fecha_edicion,
                   c.nombre AS nombre_clase,
                   a.nombre AS nombre_asignatura,
                   CONCAT(u.nombre, ' ', u.apellidos) AS profesor
            FROM publicaciones p
            INNER JOIN clases c ON p.id_clase = c.id_clase
            INNER JOIN asignaturas a ON c.id_asignatura = a.id_asignatura
            INNER JOIN usuarios u ON p.id_profesor = u.id_usuario
            INNER JOIN alumno_clase ac ON p.id_clase = ac.id_clase
            WHERE ac.id_alumno = :id_alumno
            AND ac.id_clase = :id_clase
            AND p.id_clase = :id_clase_pub
            AND ac.activo = 1
            AND p.activo = 1
            AND p.tipo = :tipo
            ORDER BY p.fecha_creacion DESC";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([
        ":id_alumno" => $idAlumno,
        ":id_clase" => $idClase,
        ":id_clase_pub" => $idClase,
        ":tipo" => $tipo
    ]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

<?php



/* =========================
   PROFESORES
========================= */

function listarProfesores($conexion)
{
    $sql = "SELECT u.id_usuario, u.nombre, u.apellidos, u.email, u.activo,
                   p.especialidad
            FROM usuarios u
            INNER JOIN profesores p ON u.id_usuario = p.id_usuario
            WHERE u.rol = 'profesor'
            ORDER BY u.id_usuario DESC";

    $stmt = $conexion->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function crearProfesor($conexion, $nombre, $apellidos, $email, $password, $especialidad)
{
    $sql = "INSERT INTO usuarios (nombre, apellidos, email, password, rol)
            VALUES (:nombre, :apellidos, :email, :password, 'profesor')";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([
        ":nombre" => $nombre,
        ":apellidos" => $apellidos,
        ":email" => $email,
        ":password" => $password
    ]);

    $idUsuario = $conexion->lastInsertId();

    $sql = "INSERT INTO profesores (id_usuario, especialidad)
            VALUES (:id_usuario, :especialidad)";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([
        ":id_usuario" => $idUsuario,
        ":especialidad" => $especialidad
    ]);
}

function desactivarProfesor($conexion, $idUsuario)
{
    $sql = "UPDATE usuarios 
            SET activo = 0 
            WHERE id_usuario = :id_usuario 
            AND rol = 'profesor'";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([":id_usuario" => $idUsuario]);
}

/* =========================
   ALUMNOS
========================= */

function listarAlumnos($conexion)
{
    $sql = "SELECT u.id_usuario, u.nombre, u.apellidos, u.email, u.activo,
                   a.nombre_tutor, a.telefono_tutor
            FROM usuarios u
            INNER JOIN alumnos a ON u.id_usuario = a.id_usuario
            WHERE u.rol = 'alumno'
            ORDER BY u.id_usuario DESC";

    $stmt = $conexion->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function crearAlumno($conexion, $nombre, $apellidos, $email, $password, $nombreTutor, $telefonoTutor)
{
    $sql = "INSERT INTO usuarios (nombre, apellidos, email, password, rol)
            VALUES (:nombre, :apellidos, :email, :password, 'alumno')";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([
        ":nombre" => $nombre,
        ":apellidos" => $apellidos,
        ":email" => $email,
        ":password" => $password
    ]);

    $idUsuario = $conexion->lastInsertId();

    $sql = "INSERT INTO alumnos (id_usuario, nombre_tutor, telefono_tutor)
            VALUES (:id_usuario, :nombre_tutor, :telefono_tutor)";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([
        ":id_usuario" => $idUsuario,
        ":nombre_tutor" => $nombreTutor,
        ":telefono_tutor" => $telefonoTutor
    ]);
}

function desactivarAlumno($conexion, $idUsuario)
{
    $sql = "UPDATE usuarios 
            SET activo = 0 
            WHERE id_usuario = :id_usuario 
            AND rol = 'alumno'";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([":id_usuario" => $idUsuario]);
}
function obtenerProfesorPorId($conexion, $idUsuario)
{
    $sql = "SELECT u.id_usuario, u.nombre, u.apellidos, u.email, u.activo,
                   p.especialidad
            FROM usuarios u
            INNER JOIN profesores p ON u.id_usuario = p.id_usuario
            WHERE u.id_usuario = :id_usuario
            AND u.rol = 'profesor'";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([":id_usuario" => $idUsuario]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function editarProfesor($conexion, $idUsuario, $nombre, $apellidos, $email, $password, $especialidad)
{
    if ($password !== "") {
        $sql = "UPDATE usuarios
                SET nombre = :nombre,
                    apellidos = :apellidos,
                    email = :email,
                    password = :password
                WHERE id_usuario = :id_usuario
                AND rol = 'profesor'";

        $stmt = $conexion->prepare($sql);
        $stmt->execute([
            ":nombre" => $nombre,
            ":apellidos" => $apellidos,
            ":email" => $email,
            ":password" => $password,
            ":id_usuario" => $idUsuario
        ]);
    } else {
        $sql = "UPDATE usuarios
                SET nombre = :nombre,
                    apellidos = :apellidos,
                    email = :email
                WHERE id_usuario = :id_usuario
                AND rol = 'profesor'";

        $stmt = $conexion->prepare($sql);
        $stmt->execute([
            ":nombre" => $nombre,
            ":apellidos" => $apellidos,
            ":email" => $email,
            ":id_usuario" => $idUsuario
        ]);
    }

    $sql = "UPDATE profesores
            SET especialidad = :especialidad
            WHERE id_usuario = :id_usuario";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([
        ":especialidad" => $especialidad,
        ":id_usuario" => $idUsuario
    ]);
}

function actualizarProfesorAjax($conexion, $idUsuario, $nombre, $apellidos, $email, $especialidad)
{
    $sql = "UPDATE usuarios
            SET nombre = :nombre,
                apellidos = :apellidos,
                email = :email
            WHERE id_usuario = :id_usuario
            AND rol = 'profesor'";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([
        ":nombre" => $nombre,
        ":apellidos" => $apellidos,
        ":email" => $email,
        ":id_usuario" => $idUsuario
    ]);

    $sql = "UPDATE profesores
            SET especialidad = :especialidad
            WHERE id_usuario = :id_usuario";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([
        ":especialidad" => $especialidad,
        ":id_usuario" => $idUsuario
    ]);
}

function obtenerAlumnoPorId($conexion, $idUsuario)
{
    $sql = "SELECT u.id_usuario, u.nombre, u.apellidos, u.email, u.activo,
                   a.nombre_tutor, a.telefono_tutor
            FROM usuarios u
            INNER JOIN alumnos a ON u.id_usuario = a.id_usuario
            WHERE u.id_usuario = :id_usuario
            AND u.rol = 'alumno'";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([":id_usuario" => $idUsuario]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function editarAlumno($conexion, $idUsuario, $nombre, $apellidos, $email, $password, $nombreTutor, $telefonoTutor)
{
    if ($password !== "") {
        $sql = "UPDATE usuarios
                SET nombre = :nombre,
                    apellidos = :apellidos,
                    email = :email,
                    password = :password
                WHERE id_usuario = :id_usuario
                AND rol = 'alumno'";

        $stmt = $conexion->prepare($sql);
        $stmt->execute([
            ":nombre" => $nombre,
            ":apellidos" => $apellidos,
            ":email" => $email,
            ":password" => $password,
            ":id_usuario" => $idUsuario
        ]);
    } else {
        $sql = "UPDATE usuarios
                SET nombre = :nombre,
                    apellidos = :apellidos,
                    email = :email
                WHERE id_usuario = :id_usuario
                AND rol = 'alumno'";

        $stmt = $conexion->prepare($sql);
        $stmt->execute([
            ":nombre" => $nombre,
            ":apellidos" => $apellidos,
            ":email" => $email,
            ":id_usuario" => $idUsuario
        ]);
    }

    $sql = "UPDATE alumnos
            SET nombre_tutor = :nombre_tutor,
                telefono_tutor = :telefono_tutor
            WHERE id_usuario = :id_usuario";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([
        ":nombre_tutor" => $nombreTutor,
        ":telefono_tutor" => $telefonoTutor,
        ":id_usuario" => $idUsuario
    ]);
}

function actualizarAlumnoAjax($conexion, $idUsuario, $nombre, $apellidos, $email, $nombreTutor, $telefonoTutor)
{
    $sql = "UPDATE usuarios
            SET nombre = :nombre,
                apellidos = :apellidos,
                email = :email
            WHERE id_usuario = :id_usuario
            AND rol = 'alumno'";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([
        ":nombre" => $nombre,
        ":apellidos" => $apellidos,
        ":email" => $email,
        ":id_usuario" => $idUsuario
    ]);

    $sql = "UPDATE alumnos
            SET nombre_tutor = :nombre_tutor,
                telefono_tutor = :telefono_tutor
            WHERE id_usuario = :id_usuario";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([
        ":nombre_tutor" => $nombreTutor,
        ":telefono_tutor" => $telefonoTutor,
        ":id_usuario" => $idUsuario
    ]);
}

function activarUsuario($conexion, $idUsuario)
{
    $sql = "UPDATE usuarios
            SET activo = 1
            WHERE id_usuario = :id_usuario";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([":id_usuario" => $idUsuario]);
}
/* =========================
   ASIGNATURAS (PDO, misma idea que tus funciones mysqli)
========================= */

function listarAsignaturas($conexion)
{
    $sql = "SELECT id_asignatura, nombre, descripcion, activo
            FROM asignaturas
            ORDER BY nombre";

    $stmt = $conexion->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function listarAsignaturasActivas($conexion)
{
    $sql = "SELECT id_asignatura, nombre, descripcion, activo
            FROM asignaturas
            WHERE activo = 1
            ORDER BY nombre";

    $stmt = $conexion->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function crearAsignatura($conexion, $nombre, $descripcion)
{
    $sql = "INSERT INTO asignaturas (nombre, descripcion, activo)
            VALUES (:nombre, :descripcion, 1)";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([
        ":nombre" => $nombre,
        ":descripcion" => $descripcion
    ]);
}

function editarAsignatura($conexion, $idAsignatura, $nombre, $descripcion)
{
    $sql = "UPDATE asignaturas
            SET nombre = :nombre,
                descripcion = :descripcion
            WHERE id_asignatura = :id_asignatura";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([
        ":nombre" => $nombre,
        ":descripcion" => $descripcion,
        ":id_asignatura" => $idAsignatura
    ]);
}

function cambiarEstadoAsignatura($conexion, $idAsignatura, $activo)
{
    $sql = "UPDATE asignaturas
            SET activo = :activo
            WHERE id_asignatura = :id_asignatura";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([
        ":activo" => $activo,
        ":id_asignatura" => $idAsignatura
    ]);
}

/* =========================
   CLASES
========================= */

function listarClases($conexion)
{
    $sql = "SELECT c.id_clase, c.nombre, c.horario, c.aula, c.activo,
                   a.nombre AS asignatura,
                   CONCAT(u.nombre, ' ', u.apellidos) AS profesor
            FROM clases c
            INNER JOIN asignaturas a ON c.id_asignatura = a.id_asignatura
            INNER JOIN usuarios u ON c.id_profesor = u.id_usuario
            ORDER BY c.nombre";

    $stmt = $conexion->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function crearClase($conexion, $idAsignatura, $idProfesor, $nombre, $horario, $aula)
{
    $sql = "INSERT INTO clases (id_asignatura, id_profesor, nombre, horario, aula, activo)
            VALUES (:id_asignatura, :id_profesor, :nombre, :horario, :aula, 1)";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([
        ":id_asignatura" => $idAsignatura,
        ":id_profesor" => $idProfesor,
        ":nombre" => $nombre,
        ":horario" => $horario,
        ":aula" => $aula
    ]);
}

function editarClase($conexion, $idClase, $idAsignatura, $idProfesor, $nombre, $horario, $aula)
{
    $sql = "UPDATE clases
            SET id_asignatura = :id_asignatura,
                id_profesor = :id_profesor,
                nombre = :nombre,
                horario = :horario,
                aula = :aula
            WHERE id_clase = :id_clase";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([
        ":id_asignatura" => $idAsignatura,
        ":id_profesor" => $idProfesor,
        ":nombre" => $nombre,
        ":horario" => $horario,
        ":aula" => $aula,
        ":id_clase" => $idClase
    ]);
}

function cambiarEstadoClase($conexion, $idClase, $activo)
{
    $sql = "UPDATE clases
            SET activo = :activo
            WHERE id_clase = :id_clase";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([
        ":activo" => $activo,
        ":id_clase" => $idClase
    ]);
}
function listarAlumnosActivos($conexion)
{
    $sql = "SELECT id_usuario, nombre, apellidos, email
            FROM usuarios
            WHERE rol = 'alumno'
            AND activo = 1
            ORDER BY nombre";

    $stmt = $conexion->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function listarClasesActivas($conexion)
{
    $sql = "SELECT c.id_clase, c.nombre, c.horario, c.aula,
                   a.nombre AS asignatura
            FROM clases c
            INNER JOIN asignaturas a ON c.id_asignatura = a.id_asignatura
            WHERE c.activo = 1
            AND a.activo = 1
            ORDER BY a.nombre, c.nombre";

    $stmt = $conexion->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function asignarAlumnoAClase($conexion, $idAlumno, $idClase)
{
    $sql = "INSERT INTO alumno_clase 
            (id_alumno, id_clase, fecha_matricula, activo)
            VALUES (:id_alumno, :id_clase, CURDATE(), 1)";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([
        ":id_alumno" => $idAlumno,
        ":id_clase" => $idClase
    ]);
}
function listarMatriculas($conexion)
{
    $sql = "SELECT ac.id_matricula, ac.id_alumno, ac.id_clase, ac.fecha_matricula, ac.activo,
                   CONCAT(u.nombre, ' ', u.apellidos) AS alumno,
                   c.nombre AS clase,
                   a.nombre AS asignatura
            FROM alumno_clase ac
            INNER JOIN usuarios u ON ac.id_alumno = u.id_usuario
            INNER JOIN clases c ON ac.id_clase = c.id_clase
            INNER JOIN asignaturas a ON c.id_asignatura = a.id_asignatura
            ORDER BY a.nombre, c.nombre, u.nombre";

    $stmt = $conexion->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function cambiarEstadoMatricula($conexion, $idMatricula, $activo)
{
    $sql = "UPDATE alumno_clase
            SET activo = :activo
            WHERE id_matricula = :id_matricula";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([
        ":activo" => $activo,
        ":id_matricula" => $idMatricula
    ]);
}

/* =========================
   ANUNCIOS (TABLÓN)
========================= */

function crearAnuncio($conexion, $idAdministrador, $titulo, $contenido)
{
    $sql = "INSERT INTO anuncios (id_administrador, titulo, contenido, activo)
            VALUES (:id_administrador, :titulo, :contenido, 1)";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([
        ":id_administrador" => $idAdministrador,
        ":titulo" => $titulo,
        ":contenido" => $contenido
    ]);
}

function listarAnuncios($conexion)
{
    $sql = "SELECT a.id_anuncio, a.id_administrador, a.titulo, a.contenido,
                   a.fecha_creacion, a.fecha_edicion, a.activo,
                   CONCAT(u.nombre, ' ', u.apellidos) AS administrador
            FROM anuncios a
            INNER JOIN usuarios u ON a.id_administrador = u.id_usuario
            ORDER BY a.fecha_creacion DESC";

    $stmt = $conexion->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function listarAnunciosActivos($conexion)
{
    $sql = "SELECT id_anuncio, titulo, contenido, fecha_creacion
            FROM anuncios
            WHERE activo = 1
            ORDER BY fecha_creacion DESC
            LIMIT 7";

    $stmt = $conexion->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function obtenerAnuncioPorId($conexion, $idAnuncio)
{
    $sql = "SELECT id_anuncio, id_administrador, titulo, contenido,
                   fecha_creacion, fecha_edicion, activo
            FROM anuncios
            WHERE id_anuncio = :id_anuncio";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([":id_anuncio" => $idAnuncio]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function editarAnuncio($conexion, $idAnuncio, $titulo, $contenido)
{
    $sql = "UPDATE anuncios
            SET titulo = :titulo,
                contenido = :contenido,
                fecha_edicion = NOW()
            WHERE id_anuncio = :id_anuncio";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([
        ":titulo" => $titulo,
        ":contenido" => $contenido,
        ":id_anuncio" => $idAnuncio
    ]);
}

function desactivarAnuncio($conexion, $idAnuncio)
{
    $sql = "UPDATE anuncios
            SET activo = 0
            WHERE id_anuncio = :id_anuncio";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([":id_anuncio" => $idAnuncio]);
}

function activarAnuncio($conexion, $idAnuncio)
{
    $sql = "UPDATE anuncios
            SET activo = 1
            WHERE id_anuncio = :id_anuncio";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([":id_anuncio" => $idAnuncio]);
}
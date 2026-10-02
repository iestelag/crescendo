<?php
session_start();

header("Content-Type: application/json; charset=UTF-8");

require_once "../includes/conexion.php";
require_once "../modelos/admin_modelo.php";

function responder($ok, $mensaje)
{
    echo json_encode(["ok" => $ok, "mensaje" => $mensaje]);
    exit;
}

if (
    !isset($_SESSION["id_usuario"]) ||
    $_SESSION["rol"] !== "administrador" ||
    $_SERVER["REQUEST_METHOD"] !== "POST"
) {
    responder(false, "Acceso no permitido.");
}

$idUsuario = (int) ($_POST["id_usuario"] ?? 0);
$nombre = trim($_POST["nombre"] ?? "");
$apellidos = trim($_POST["apellidos"] ?? "");
$email = trim($_POST["email"] ?? "");
$nombreTutor = trim($_POST["nombre_tutor"] ?? "");
$telefonoTutor = trim($_POST["telefono_tutor"] ?? "");

if (!$idUsuario || !$nombre || !$apellidos || !$email) {
    responder(false, "Completa nombre, apellidos y email del alumno.");
}

try {
    actualizarAlumnoAjax(
        $conexion,
        $idUsuario,
        $nombre,
        $apellidos,
        $email,
        $nombreTutor,
        $telefonoTutor
    );

    responder(true, "Alumno actualizado correctamente.");
} catch (PDOException $e) {
    responder(false, "No se pudo actualizar el alumno.");
}

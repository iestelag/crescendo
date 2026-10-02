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
$especialidad = trim($_POST["especialidad"] ?? "");

if (!$idUsuario || !$nombre || !$apellidos || !$email || !$especialidad) {
    responder(false, "Completa todos los campos del profesor.");
}

try {
    actualizarProfesorAjax(
        $conexion,
        $idUsuario,
        $nombre,
        $apellidos,
        $email,
        $especialidad
    );

    responder(true, "Profesor actualizado correctamente.");
} catch (PDOException $e) {
    responder(false, "No se pudo actualizar el profesor.");
}
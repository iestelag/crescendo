<?php

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

if (!isset($_SESSION["id_usuario"]) || ($_SESSION["rol"] ?? "") !== "alumno") {
  header("Location: login.php");
  exit;
}

$idAlumno = (int) $_SESSION["id_usuario"];

$alumnoNombre = trim((string) ($_SESSION["nombre"] ?? ""));
if ($alumnoNombre === "") {
  $alumnoNombre = "Alumno";
}

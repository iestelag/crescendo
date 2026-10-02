<?php
session_start();

require_once "../includes/conexion.php";
require_once "../modelos/usuario_modelo.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

  $email = trim($_POST["email"]);
  $password = trim($_POST["password"]);

  $usuario = usuarioAutenticar($conexion, $email, $password);

  if ($usuario) {

    $_SESSION["id_usuario"] = $usuario["id_usuario"];
    $_SESSION["nombre"] = $usuario["nombre"];
    $_SESSION["apellidos"] = $usuario["apellidos"];
    $_SESSION["email"] = $usuario["email"];
    $_SESSION["rol"] = $usuario["rol"];

    if ($usuario["rol"] === "administrador") {
      header("Location: panel_administrador.php");
      exit;
    }

    if ($usuario["rol"] === "profesor") {
      header("Location: panel_profesor.php");
      exit;
    }

    if ($usuario["rol"] === "alumno") {
      header("Location: panel_alumno.php");
      exit;
    }

  } else {

    $error = "Correo o contraseña incorrectos.";

  }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Crescendo - Login</title>
  <link rel="icon" href="../imagenes/LOGO.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../estilos/estilos.css" />
 
  <script src="../js/login.js" defer></script>
</head>

<body class="login-body d-flex align-items-center justify-content-center min-vh-100 m-0">

  <main class="login-container text-center">

    <div class="login-logo d-flex flex-column align-items-center">
      <a href="../index.php" class="login-logo-link d-flex flex-column align-items-center justify-content-center w-100" title="Ir al inicio">
        <img src="../imagenes/LOGO.png" alt="Logo Crescendo" class="logo-img d-block mx-auto" />
        <span class="logo-text">CRESCENDO</span>
      </a>
      <p class="login-subtitle">Tu talento, sin límites</p>
    </div>

    <h1>Inicia sesión</h1>
    <p class="login-subtitle">Accede a tu plataforma musical</p>

    <?php if (!empty($error)) { ?>

      <div class="error-login text-center">
        <?php echo $error; ?>
      </div>

    <?php } ?>
    <form method="POST" action="">
      <label class="d-block text-start" for="email">Correo electrónico</label>
      <input
        class="w-100"
        type="email"
        id="email"
        name="email"
        placeholder="ejemplo@correo.com"
        required />

      <label class="d-block text-start" for="password">Contraseña</label>

      <div class="password-container">
        <input
          class="w-100"
          type="password"
          id="password"
          name="password"
          placeholder="Tu contraseña"
          required />
        <span class="toggle-password">visibility_off</span>
      </div>

      <a href="#"
         class="forgot d-block text-end mt-2"
         data-bs-toggle="collapse"
         data-bs-target="#olvidoContrasenaAviso"
         aria-expanded="false"
         aria-controls="olvidoContrasenaAviso">¿Olvidaste tu contraseña?</a>

      <div class="collapse" id="olvidoContrasenaAviso">
        <p class="login-aviso-recuperacion alert text-start mb-0 mt-2" role="alert">
          Si no recuerdas tu contraseña, contacta con el administrador del centro para que pueda generarte una nueva.
        </p>
      </div>

      <button type="submit" class="boton-acceso login-acceso w-100">
        Iniciar sesión
      </button>
    </form>

    <p class="register">
      ¿No tienes cuenta? <a href="formulario.php">Regístrate aquí</a>
    </p>

  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>

</body>

</html>
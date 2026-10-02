<?php

function usuarioBuscarActivoPorEmail($conexion, $email)
{
    $sql = "SELECT * 
            FROM usuarios 
            WHERE email = :email 
            AND activo = 1";

    $stmt = $conexion->prepare($sql);
    $stmt->execute([
        ":email" => $email
    ]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function usuarioAutenticar($conexion, $email, $password)
{
    $usuario = usuarioBuscarActivoPorEmail($conexion, $email);

    if (!$usuario) {
        return null;
    }

    if ($password !== $usuario["password"]) {
        return null;
    }

    return $usuario;
}
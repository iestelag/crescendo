<?php

if (!function_exists("textoSeguro")) {
    function textoSeguro($texto)
    {
        return htmlspecialchars((string) $texto, ENT_QUOTES, "UTF-8");
    }
}

if (!function_exists("imagenAsignatura")) {
    function imagenAsignatura($asignatura)
    {
        $nombre = strtolower(trim((string) $asignatura));
        $nombre = strtr($nombre, [
            "á" => "a",
            "é" => "e",
            "í" => "i",
            "ó" => "o",
            "ú" => "u",
            "ñ" => "n",
        ]);

        $imagenes = [
            "piano" => "piano.png",
            "violin" => "violin.png",
            "bateria" => "bateria.png",
            "lenguaje musical" => "lenguaje.png",
            "flauta" => "flauta.png",
            "guitarra" => "guitarra.png",
            "canto"=> "canto.png",
        ];

        return $imagenes[$nombre] ?? "default.png";
    }
}

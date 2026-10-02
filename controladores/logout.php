<?php
session_start();

$_SESSION = [];

session_destroy();

header("Location: ../paginas/login.php");
exit;
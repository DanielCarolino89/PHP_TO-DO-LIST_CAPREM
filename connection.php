<?php

$server = "localhost";
$user = "root";
$pass = "";
$banco = "banco_do_teste";


$conn = new mysqli($server, $user, $pass, $banco);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

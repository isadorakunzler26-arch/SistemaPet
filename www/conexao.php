<?php

$servidor = "banco";
$usuario = "pet";
$senha = "pet123";
$banco = "petshop";

$conn = new mysqli($servidor, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("Erro na conexão com o banco: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

?>
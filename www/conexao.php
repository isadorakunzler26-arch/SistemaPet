<?php

$host = "mysql";
$usuario = "pet";
$senha = "pet123";
$banco = "petshop";

$conexao = mysqli_connect(
    $host,
    $usuario,
    $senha,
    $banco
);

if (!$conexao) {
    die("Erro ao conectar ao banco de dados.");
}

mysqli_set_charset($conexao, "utf8mb4");

?>
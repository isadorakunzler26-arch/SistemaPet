<?php

$host = "banco";
$usuario = "pet";
$senha = "pet123";
$banco = "petshop";

$conexao = mysqli_connect(
    $host,
    $usuario,
    $senha,
    $banco
);

if(!$conexao){
    die("Erro ao conectar.");
}

?>
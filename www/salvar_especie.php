<?php

require_once __DIR__ . "/conexao.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: cadastro_especie.php");
    exit;
}

$nome = trim($_POST["especie"] ?? "");

if ($nome === "") {
    die("O nome da espécie é obrigatório.");
}

$sql = "INSERT INTO especie (nome) VALUES (?)";

$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Erro ao preparar a consulta: " . $conn->error);
}

$stmt->bind_param("s", $nome);

if ($stmt->execute()) {
    header("Location: listaespecies.php");
    exit;
} else {
    die("Erro ao salvar espécie: " . $stmt->error);
}

$stmt->close();
$conn->close();

?>
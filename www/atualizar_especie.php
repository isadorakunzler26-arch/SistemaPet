<?php

require_once __DIR__ . "/conexao.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: listaespecies.php");
    exit;
}

$id = $_POST["id"] ?? "";
$nome = trim($_POST["nome"] ?? "");

if ($id === "" || !is_numeric($id)) {
    die("ID da espécie inválido.");
}

if ($nome === "") {
    die("O nome da espécie é obrigatório.");
}

$sql = "UPDATE especie SET nome = ? WHERE id = ?";

$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Erro ao preparar consulta: " . $conn->error);
}

$stmt->bind_param("si", $nome, $id);

if ($stmt->execute()) {

    header("Location: listaespecies.php");
    exit;

} else {

    die("Erro ao atualizar espécie: " . $stmt->error);

}

$stmt->close();
$conn->close();

?>
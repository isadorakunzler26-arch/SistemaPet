<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . "/conexao.php";

$id = $_GET["id"] ?? "";

if ($id === "" || !is_numeric($id)) {
    die("ID do pet inválido.");
}

$id = (int) $id;

$sql = "DELETE FROM pet WHERE id = ?";

$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Erro ao preparar a exclusão: " . $conn->error);
}

$stmt->bind_param("i", $id);

if (!$stmt->execute()) {
    die("Erro ao excluir o pet: " . $stmt->error);
}

$stmt->close();
$conn->close();

header("Location: listadepets.php");
exit;

?>
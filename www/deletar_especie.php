<?php

require_once __DIR__ . "/conexao.php";

$id = $_GET["id"] ?? "";

if ($id === "" || !is_numeric($id)) {
    die("ID da espécie inválido.");
}

$sql = "DELETE FROM especie WHERE id = ?";

$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Erro ao preparar consulta: " . $conn->error);
}

$stmt->bind_param("i", $id);

if ($stmt->execute()) {

    header("Location: listaespecies.php");
    exit;

} else {

    die("Erro ao excluir espécie: " . $stmt->error);

}

$stmt->close();
$conn->close();

?>
<?php

require_once __DIR__ . "/conexao.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: listadepets.php");
    exit;
}

$id = $_POST["id"] ?? "";
$nome = trim($_POST["nome"] ?? "");
$nascimento = $_POST["nascimento"] ?? "";
$especie_id = $_POST["especie"] ?? "";
$prontuario = trim($_POST["prontuario"] ?? "");
$genero = $_POST["genero"] ?? "";


/* Verifica o ID */

if ($id === "" || !is_numeric($id)) {
    die("ID do pet inválido.");
}

$id = (int) $id;


/* Verifica os campos */

if ($nome === "") {
    die("O nome do pet é obrigatório.");
}

if ($nascimento === "") {
    die("A data de nascimento é obrigatória.");
}

if ($especie_id === "" || !is_numeric($especie_id)) {
    die("Selecione uma espécie.");
}

if ($genero !== "M" && $genero !== "F") {
    die("Selecione o gênero.");
}

$especie_id = (int) $especie_id;


/* Atualiza o pet */

$sql = "UPDATE pet
        SET nome = ?,
            nascimento = ?,
            genero = ?,
            prontuario = ?,
            especie_id = ?
        WHERE id = ?";

$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Erro ao preparar a atualização: " . $conn->error);
}

$stmt->bind_param(
    "ssssii",
    $nome,
    $nascimento,
    $genero,
    $prontuario,
    $especie_id,
    $id
);


/* Executa a atualização */

if ($stmt->execute()) {

    $stmt->close();
    $conn->close();

    header("Location: listadepets.php");
    exit;

} else {

    die("Erro ao atualizar pet: " . $stmt->error);

}

?>
<?php

require_once __DIR__ . "/conexao.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: cadastro_pet.php");
    exit;
}

$nome = trim($_POST["nome"] ?? "");
$nascimento = $_POST["nascimento"] ?? "";
$especie_id = $_POST["especie"] ?? "";
$prontuario = trim($_POST["prontuario"] ?? "");
$genero = $_POST["genero"] ?? "";


/* Valida os campos */

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
    die("Selecione o gênero do pet.");
}


/* Insere o pet no banco */

$sql = "INSERT INTO pet
        (nome, nascimento, genero, prontuario, especie_id)
        VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Erro ao preparar o cadastro: " . $conn->error);
}


/* s = texto
   i = número inteiro */

$stmt->bind_param(
    "ssssi",
    $nome,
    $nascimento,
    $genero,
    $prontuario,
    $especie_id
);


/* Salva */

if ($stmt->execute()) {

    $stmt->close();
    $conn->close();

    header("Location: listadepets.php");
    exit;

} else {

    die("Erro ao salvar pet: " . $stmt->error);

}

?>
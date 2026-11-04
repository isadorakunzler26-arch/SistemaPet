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

$especie_id = (int) $especie_id;

$foto = null;
$caminhoFoto = null;

if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] !== UPLOAD_ERR_NO_FILE) {

    if ($_FILES["foto"]["error"] !== UPLOAD_ERR_OK) {
        die("Erro ao enviar a imagem.");
    }

    if ($_FILES["foto"]["size"] > 5 * 1024 * 1024) {
        die("A imagem deve ter no máximo 5 MB.");
    }

    $arquivoTemporario = $_FILES["foto"]["tmp_name"];

    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $tipo = $finfo->file($arquivoTemporario);

    $formatosPermitidos = [
        "image/jpeg" => "jpg",
        "image/png" => "png",
        "image/webp" => "webp"
    ];

    if (!array_key_exists($tipo, $formatosPermitidos)) {
        die("Formato de imagem não permitido. Use JPG, PNG ou WEBP.");
    }

    if (getimagesize($arquivoTemporario) === false) {
        die("O arquivo enviado não é uma imagem válida.");
    }

    $pastaUploads = __DIR__ . "/uploads/";

    if (!is_dir($pastaUploads)) {
        if (!mkdir($pastaUploads, 0755, true)) {
            die("Não foi possível criar a pasta de imagens.");
        }
    }

    $nomeArquivo = bin2hex(random_bytes(16)) . "." . $formatosPermitidos[$tipo];

    $caminhoFoto = "uploads/" . $nomeArquivo;

    if (!move_uploaded_file($arquivoTemporario, $pastaUploads . $nomeArquivo)) {
        die("Não foi possível salvar a imagem.");
    }

    $foto = $caminhoFoto;
}

$sql = "INSERT INTO pet
        (nome, nascimento, genero, prontuario, especie_id, foto)
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if ($stmt === false) {

    if ($caminhoFoto !== null) {
        unlink(__DIR__ . "/" . $caminhoFoto);
    }

    die("Erro ao preparar o cadastro: " . $conn->error);
}

$stmt->bind_param(
    "ssssis",
    $nome,
    $nascimento,
    $genero,
    $prontuario,
    $especie_id,
    $foto
);

if ($stmt->execute()) {

    $stmt->close();
    $conn->close();

    header("Location: listadepets.php");
    exit;

} else {

    if ($caminhoFoto !== null) {
        unlink(__DIR__ . "/" . $caminhoFoto);
    }

    die("Erro ao salvar pet: " . $stmt->error);
}

?>

<?php
require_once __DIR__ . "/conexao.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: listadepets.php");
    exit;
}

$id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
$nome = trim($_POST["nome"] ?? "");
$nascimento = $_POST["nascimento"] ?? "";
$especie = filter_input(INPUT_POST, "especie", FILTER_VALIDATE_INT);
$prontuario = trim($_POST["prontuario"] ?? "");
$genero = $_POST["genero"] ?? "";

if (!$id || $nome === "" || $nascimento === "" || !$especie || !in_array($genero, ["M", "F"], true)) {
    die("Preencha todos os campos obrigatórios corretamente.");
}

$stmt = $conn->prepare("SELECT foto FROM pet WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    die("Pet não encontrado.");
}

$petAtual = $resultado->fetch_assoc();
$fotoAtual = $petAtual["foto"] ?? "";
$stmt->close();

$novaFoto = $fotoAtual;
$arquivoAntigo = "";

if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] !== UPLOAD_ERR_NO_FILE) {

    if ($_FILES["foto"]["error"] !== UPLOAD_ERR_OK) {
        die("Erro ao enviar a foto.");
    }

    if ($_FILES["foto"]["size"] > 5 * 1024 * 1024) {
        die("A foto deve ter no máximo 5 MB.");
    }

    $tiposPermitidos = [
        "image/jpeg" => "jpg",
        "image/png" => "png",
        "image/webp" => "webp"
    ];

    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $tipo = $finfo->file($_FILES["foto"]["tmp_name"]);

    if (!isset($tiposPermitidos[$tipo]) || !getimagesize($_FILES["foto"]["tmp_name"])) {
        die("Formato de imagem inválido. Envie JPG, PNG ou WEBP.");
    }

    $pastaUploads = __DIR__ . "/uploads/";

    if (!is_dir($pastaUploads) && !mkdir($pastaUploads, 0755, true)) {
        die("Não foi possível criar a pasta de imagens.");
    }

    $nomeArquivo = bin2hex(random_bytes(16)) . "." . $tiposPermitidos[$tipo];
    $caminhoCompleto = $pastaUploads . $nomeArquivo;

    if (!move_uploaded_file($_FILES["foto"]["tmp_name"], $caminhoCompleto)) {
        die("Não foi possível salvar a nova foto.");
    }

    $novaFoto = "uploads/" . $nomeArquivo;
    $arquivoAntigo = $fotoAtual;
}

$sql = "UPDATE pet
        SET nome = ?, nascimento = ?, genero = ?, prontuario = ?, especie_id = ?, foto = ?
        WHERE id = ?";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    if ($novaFoto !== $fotoAtual) {
        @unlink(__DIR__ . "/" . $novaFoto);
    }
    die("Erro ao preparar atualização: " . $conn->error);
}

$stmt->bind_param(
    "ssssisi",
    $nome,
    $nascimento,
    $genero,
    $prontuario,
    $especie,
    $novaFoto,
    $id
);

if (!$stmt->execute()) {
    if ($novaFoto !== $fotoAtual) {
        @unlink(__DIR__ . "/" . $novaFoto);
    }
    die("Erro ao atualizar pet: " . $stmt->error);
}

$stmt->close();

if ($arquivoAntigo !== "" && $arquivoAntigo !== $novaFoto) {
    $caminhoAntigo = __DIR__ . "/" . $arquivoAntigo;

    if (is_file($caminhoAntigo)) {
        unlink($caminhoAntigo);
    }
}

header("Location: listadepets.php");
exit;
?>

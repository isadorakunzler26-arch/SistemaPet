
    <?php
    require_once __DIR__ . "/conexao.php";


    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        header("Location: listadepets.php");
        exit;

    }


            $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
            $nome = trim($_POST["nome"] ?? "");
            $nascimento = $_POST["nascimento"] ?? "";
            $especie_id = filter_input(INPUT_POST, "especie", FILTER_VALIDATE_INT);
            $prontuario = trim($_POST["prontuario"] ?? "");
            $genero = $_POST["genero"] ?? "";

        if (
            !$id ||
            $nome === "" ||
            $nascimento === "" ||
            !$especie_id ||
            !in_array($genero, ["M", "F"], true)
        ) {
            die("Preencha todos os campos corretamente.");
        }

    $stmt = $conn->prepare("SELECT foto FROM pet WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 0) {
        die("Pet não encontrado.");
    }

    $petAtual = $resultado->fetch_assoc();
    $fotoAtual = $petAtual["foto"] ?? null;

    $stmt->close();

    $novaFoto = $fotoAtual;

    if (
        isset($_FILES["foto"]) &&
        $_FILES["foto"]["error"] !== UPLOAD_ERR_NO_FILE
    ) {
        if ($_FILES["foto"]["error"] !== UPLOAD_ERR_OK) {
            die("Erro ao enviar a foto.");
        }

        if ($_FILES["foto"]["size"] > 5 * 1024 * 1024) {
            die("A foto deve ter no máximo 5 MB.");
        }

        $formatos = [
            "image/jpeg" => "jpg",
            "image/png" => "png",
            "image/webp" => "webp"
        ];

        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $tipo = $finfo->file($_FILES["foto"]["tmp_name"]);

        if (
            !isset($formatos[$tipo]) ||
            getimagesize($_FILES["foto"]["tmp_name"]) === false
        ) {
            die("Formato de imagem inválido.");
        }

        $pasta = __DIR__ . "/uploads/";

        if (!is_dir($pasta)) {
            if (!mkdir($pasta, 0755, true)) {
                die("Não foi possível criar a pasta uploads.");
            }
        }

        $nomeArquivo = bin2hex(random_bytes(16)) . "." . $formatos[$tipo];

        if (
            !move_uploaded_file(
                $_FILES["foto"]["tmp_name"],
                $pasta . $nomeArquivo
            )
        ) {
            die("Não foi possível salvar a foto.");
        }

        $novaFoto = "uploads/" . $nomeArquivo;
    }

    $sql = "UPDATE pet
            SET nome = ?,
                nascimento = ?,
                genero = ?,
                prontuario = ?,
                especie_id = ?,
                foto = ?
            WHERE id = ?";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        if ($novaFoto !== $fotoAtual && $novaFoto) {
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
        $especie_id,
        $novaFoto,
        $id
    );

    if (!$stmt->execute()) {
        if ($novaFoto !== $fotoAtual && $novaFoto) {
            @unlink(__DIR__ . "/" . $novaFoto);
        }

        die("Erro ao atualizar: " . $stmt->error);
    }

    $stmt->close();

    if ($novaFoto !== $fotoAtual && !empty($fotoAtual)) {
        $caminhoAntigo = __DIR__ . "/" . $fotoAtual;

        if (is_file($caminhoAntigo)) {
            unlink($caminhoAntigo);
        }
    }

   $conn->close();

echo "<script>window.location.href = 'listadepets.php';</script>";
exit;
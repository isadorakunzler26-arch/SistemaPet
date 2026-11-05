
<?php
require_once __DIR__ . "/conexao.php";

$sql = "SELECT id, nome FROM especie ORDER BY nome ASC";
$resultado = $conn->query($sql);

if (!$resultado) {
    die("Erro ao buscar espécies: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Pet - Sistema Pet</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            background-color: #F7F6E3;
            font-family: Arial, Helvetica, sans-serif;
            color: #4E351E;
        }

        .topo {
            background-color: #546745;
            color: #F7F6E3;
            padding: 22px 50px;
        }

        .topo h1 {
            margin: 0;
            font-size: 28px;
        }

        .topo p {
            margin: 5px 0 0;
            color: #AFA386;
        }

        .formulario {
            max-width: 750px;
            margin: 45px auto;
            padding: 35px;
            background-color: white;
            border: 1px solid #AFA386;
            border-radius: 15px;
            box-shadow: 0 5px 18px rgba(78, 53, 30, 0.10);
        }

        h2 {
            color: #4E351E;
            font-size: 30px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .descricao {
            color: #6C5234;
            margin-bottom: 30px;
        }

        .form-label {
            color: #4E351E;
            font-weight: bold;
        }

        .form-control,
        .form-select {
            border: 1px solid #AFA386;
            padding: 11px;
            border-radius: 8px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #546745;
            box-shadow: 0 0 0 0.2rem rgba(84, 103, 69, 0.15);
        }

        .genero-box {
            display: flex;
            gap: 20px;
        }

        .genero-box label {
            background-color: #F7F6E3;
            border: 1px solid #AFA386;
            border-radius: 8px;
            padding: 10px 18px;
        }

        .preview {
            display: none;
            width: 160px;
            height: 160px;
            object-fit: cover;
            border-radius: 12px;
            border: 2px solid #AFA386;
            margin-top: 15px;
        }

        .botoes {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #E5E1CC;
        }

        .btn-voltar {
            background-color: transparent;
            border: 1px solid #AFA386;
            color: #4E351E;
        }

        .btn-salvar {
            background-color: #546745;
            color: white;
        }

        .btn-salvar:hover {
            background-color: #4E351E;
            color: white;
        }

        .rodape {
            margin-top: 50px;
            background-color: #4E351E;
            color: #AFA386;
            text-align: center;
            padding: 18px;
        }

        @media (max-width: 768px) {
            .formulario {
                margin: 25px 15px;
                padding: 22px;
            }

            .topo {
                padding: 20px;
            }
        }
    </style>
</head>

<body>

<header class="topo">
    <h1>Sistema Pet</h1>
    <p>Gerenciamento de animais</p>
</header>

<main class="formulario">

    <h2>Cadastrar Pet</h2>
    <p class="descricao">Preencha os dados para cadastrar um novo animal.</p>

    <form action="salvar_pet.php" method="POST" enctype="multipart/form-data">

        <div class="mb-3">
            <label for="nome" class="form-label">Nome do Pet</label>
            <input
                type="text"
                id="nome"
                name="nome"
                class="form-control"
                placeholder="Digite o nome do pet"
                required
            >
        </div>

        <div class="mb-3">
            <label for="nascimento" class="form-label">Nascimento</label>
            <input
                type="date"
                id="nascimento"
                name="nascimento"
                class="form-control"
                required
            >
        </div>

        <div class="mb-3">
            <label for="especie" class="form-label">Espécie</label>
            <select
                id="especie"
                name="especie"
                class="form-select"
                required
            >
                <option value="">Selecione uma espécie</option>

                <?php while ($especie = $resultado->fetch_assoc()): ?>
                    <option value="<?= $especie["id"] ?>">
                        <?= htmlspecialchars($especie["nome"]) ?>
                    </option>
                <?php endwhile; ?>

            </select>
        </div>

        <div class="mb-3">
            <label for="prontuario" class="form-label">Prontuário</label>
            <textarea
                id="prontuario"
                name="prontuario"
                class="form-control"
                rows="5"
                placeholder="Informe observações sobre o pet"
            ></textarea>
        </div>

        <div class="mb-4">
            <label class="form-label d-block">Gênero</label>

            <div class="genero-box">
                <label>
                    <input
                        type="radio"
                        name="genero"
                        value="M"
                        required
                    >
                    Macho
                </label>

                <label>
                    <input
                        type="radio"
                        name="genero"
                        value="F"
                    >
                    Fêmea
                </label>
            </div>
        </div>

        <div class="mb-4">
            <label for="foto" class="form-label">Foto do Pet</label>

            <input
                type="file"
                id="foto"
                name="foto"
                class="form-control"
                accept="image/jpeg,image/png,image/webp"
            >

            <small class="text-muted">
                Formatos permitidos: JPG, PNG e WEBP. Máximo de 5 MB.
            </small>

            <img id="preview" class="preview" alt="Prévia da foto selecionada">
        </div>

        <div class="botoes">
            <a href="index.php" class="btn btn-voltar">
                Voltar
            </a>

            <button type="reset" class="btn btn-secondary">
                Limpar
            </button>

            <button type="submit" class="btn btn-salvar">
                Cadastrar Pet
            </button>
        </div>

    </form>

</main>

<footer class="rodape">
    Sistema Pet
</footer>

<script>
    const campoFoto = document.getElementById("foto");
    const preview = document.getElementById("preview");

    campoFoto.addEventListener("change", function () {
        const arquivo = this.files[0];

        if (arquivo) {
            if (preview.dataset.url) {
                URL.revokeObjectURL(preview.dataset.url);
            }

            const url = URL.createObjectURL(arquivo);
            preview.src = url;
            preview.dataset.url = url;
            preview.style.display = "block";
        } else {
            preview.style.display = "none";
            preview.removeAttribute("src");
        }
    });
</script>

</body>
</html>

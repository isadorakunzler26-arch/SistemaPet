<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Pet</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body{
            background:#f2f2f2;
            font-family:Arial, Helvetica, sans-serif;
        }

        .cabecalho{
            background:#2E7D32;
            color:white;
            padding:15px;
        }

        .cabecalho h2{
            margin:0;
        }

        .formulario{
            width:700px;
            margin:40px auto;
            background:white;
            padding:30px;
            border-radius:8px;
            border:1px solid #ccc;
        }

        .titulo{
            margin-bottom:25px;
            color:#2E7D32;
        }

        .botoes{
            margin-top:20px;
        }

    </style>

</head>
<body>

<div class="cabecalho">
    <h2>Sistema Pet</h2>
</div>

<div class="formulario">

    <h3 class="titulo">Cadastrar Pet</h3>

    <form action="salvar_pet.php" method="POST">

        <div class="mb-3">
            <label class="form-label">Nome do Pet</label>

            <input
                type="text"
                name="nome"
                class="form-control"
                placeholder="Digite o nome do pet"
                required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nascimento</label>

            <input
                type="date"
                name="nascimento"
                class="form-control"
                required>
        </div>

        <div class="mb-3">
            <label class="form-label">Espécie</label>

            <select name="especie" class="form-select" required>

                <option value="">Selecione</option>
                <option value="1">Cachorro</option>
                <option value="2">Gato</option>
                <option value="3">Coelho</option>
                <option value="4">Pássaro</option>

            </select>

        </div>

        <div class="mb-3">

            <label class="form-label">
                Prontuário
            </label>

            <textarea
                name="prontuario"
                class="form-control"
                rows="5"
                placeholder="Digite informações sobre o pet"></textarea>

        </div>

        <div class="mb-3">

            <label class="form-label d-block">
                Gênero
            </label>

            <div class="form-check form-check-inline">

                <input
                    class="form-check-input"
                    type="radio"
                    name="genero"
                    value="M"
                    required>

                <label class="form-check-label">
                    Macho
                </label>

            </div>

            <div class="form-check form-check-inline">

                <input
                    class="form-check-input"
                    type="radio"
                    name="genero"
                    value="F">

                <label class="form-check-label">
                    Fêmea
                </label>

            </div>

        </div>

        <div class="botoes">

            <button type="submit" class="btn btn-success">
                Salvar
            </button>

            <button type="reset" class="btn btn-secondary">
                Limpar
            </button>

            <a href="telainicial.php" class="btn btn-danger">
                Voltar
            </a>

        </div>

    </form>

</div>

</body>
</html>
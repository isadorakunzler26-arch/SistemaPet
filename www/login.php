<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Pet</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body{
            background: #f3f3f3;
            font-family: Arial, Helvetica, sans-serif;
        }

        .formulario{
            max-width: 700px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0,0,0,.15);
        }

        h2{
            text-align: center;
            color: #2E7D32;
            margin-bottom: 25px;
        }

        .btn-salvar{
            background: #2E7D32;
            color: white;
        }

        .btn-salvar:hover{
            background: #1B5E20;
            color: white;
        }

    </style>

</head>
<body>

<div class="formulario">

    <h2>Cadastro de Pet</h2>

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

                <option value="">Selecione...</option>

                <!-- Depois essas opções virão do banco -->

                <option value="1">Cachorro</option>
                <option value="2">Gato</option>
                <option value="3">Coelho</option>

            </select>

        </div>

        <div class="mb-3">
            <label class="form-label">Prontuário</label>

            <textarea
                name="prontuario"
                class="form-control"
                rows="5"
                placeholder="Informe observações sobre o pet"></textarea>

        </div>

        <div class="mb-4">

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

        <button type="submit" class="btn btn-salvar">
            Salvar Pet
        </button>

        <button type="reset" class="btn btn-secondary">
            Limpar
        </button>

    </form>

</div>

</body>
</html>
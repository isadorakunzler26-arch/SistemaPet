<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'conexao.php';

if (!isset($conn) && isset($conexao)) {
    $conn = $conexao;
}

$sqlEspecies = "SELECT id, nome FROM especie ORDER BY nome ASC";
$resultEspecies = mysqli_query($conn, $sqlEspecies);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Pet - Sistema Pet</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            background-color: #F7F6E3;
            font-family: Arial, Helvetica, sans-serif;
            color: #4E351E;
            display: flex;
            flex-direction: column;
        }

        .topo {
            background-color: #546745;
            color: #F7F6E3;
            padding: 22px 50px;
            box-shadow: 0 3px 12px rgba(78, 53, 30, 0.18);
        }

        .topo h1 {
            margin: 0;
            font-size: 30px;
            font-weight: 600;
        }

        .topo p {
            margin: 5px 0 0;
            color: #AFA386;
            font-size: 14px;
        }

        .principal {
            max-width: 850px;
            margin: 45px auto;
            padding: 0 25px;
            flex: 1;
            width: 100%;
        }

        .titulo {
            margin-bottom: 30px;
        }

        .titulo h2 {
            margin: 0 0 8px;
            color: #4E351E;
            font-size: 30px;
            font-weight: 600;
        }

        .titulo p {
            margin: 0;
            color: #6C5234;
            font-size: 15px;
        }

        .linha-titulo {
            width: 55px;
            height: 4px;
            background-color: #546745;
            border-radius: 5px;
            margin-top: 15px;
        }

        .formulario {
            background-color: #FFFFFF;
            border: 1px solid #AFA386;
            border-radius: 15px;
            padding: 35px;
            box-shadow: 0 7px 20px rgba(78, 53, 30, 0.12);
        }

        .campo {
            margin-bottom: 22px;
        }

        .campo label {
            display: block;
            margin-bottom: 8px;
            color: #4E351E;
            font-weight: bold;
            font-size: 14px;
        }

        .form-control,
        .form-select {
            border: 1px solid #AFA386;
            border-radius: 8px;
            padding: 11px 13px;
            color: #4E351E;
            background-color: #F7F6E3;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #546745;
            box-shadow: 0 0 0 3px rgba(84, 103, 69, 0.15);
            background-color: #FFFFFF;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 130px;
        }

        .genero {
            display: flex;
            gap: 15px;
            margin-top: 5px;
        }

        .opcao-genero {
            flex: 1;
            border: 1px solid #AFA386;
            border-radius: 8px;
            padding: 12px 15px;
            background-color: #F7F6E3;
            cursor: pointer;
        }

        .opcao-genero:hover {
            border-color: #546745;
        }

        .opcao-genero input {
            accent-color: #546745;
            margin-right: 7px;
        }

        .botoes {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 30px;
            padding-top: 25px;
            border-top: 1px solid #AFA386;
        }

        .btn-salvar {
            background-color: #546745;
            color: #F7F6E3;
            border: none;
            padding: 10px 22px;
            border-radius: 7px;
            font-weight: bold;
            transition: 0.2s ease;
        }

        .btn-salvar:hover {
            background-color: #4E351E;
            color: #F7F6E3;
        }

        .btn-limpar {
            background-color: #AFA386;
            color: #4E351E;
            border: none;
            padding: 10px 22px;
            border-radius: 7px;
            font-weight: bold;
            transition: 0.2s ease;
        }

        .btn-limpar:hover {
            background-color: #6C5234;
            color: #F7F6E3;
        }

        .btn-voltar {
            background-color: transparent;
            color: #4E351E;
            border: 1px solid #AFA386;
            padding: 10px 22px;
            border-radius: 7px;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
            transition: 0.2s ease;
        }

        .btn-voltar:hover {
            background-color: #4E351E;
            color: #F7F6E3;
        }

        .rodape {
            margin-top: 50px;
            background-color: #4E351E;
            color: #AFA386;
            text-align: center;
            padding: 18px;
            font-size: 14px;
        }

        @media (max-width: 600px) {
            .topo { padding: 20px 25px; }
            .topo h1 { font-size: 25px; }
            .principal { margin: 30px auto; padding: 0 15px; }
            .formulario { padding: 25px 20px; }
            .genero { flex-direction: column; gap: 8px; }
            .botoes { flex-direction: column; }
            .btn-salvar, .btn-limpar, .btn-voltar { width: 100%; text-align: center; }
        }
    </style>
</head>

<body>

    <header class="topo">
        <h1>Sistema Pet</h1>
        <p>Gerenciamento de animais</p>
    </header>

    <main class="principal">

        <section class="titulo">
            <h2>Cadastrar Pet</h2>
            <p>Preencha os dados abaixo para cadastrar um novo pet.</p>
            <div class="linha-titulo"></div>
        </section>

        <section class="formulario">

            <form action="salvar_pet.php" method="POST">

                <div class="campo">
                    <label for="nome">Nome do Pet</label>
                    <input
                        type="text"
                        id="nome"
                        name="nome"
                        class="form-control"
                        placeholder="Digite o nome do pet"
                        required>
                </div>

                <div class="campo">
                    <label for="nascimento">Nascimento</label>
                    <input
                        type="date"
                        id="nascimento"
                        name="nascimento"
                        class="form-control"
                        required>
                </div>

                <div class="campo">
                    <label for="especie">Espécie</label>
                    <select
                        id="especie"
                        name="especie"
                        class="form-select"
                        required>
                        <option value="">Selecione a espécie</option>
                        <?php
                        if ($resultEspecies && mysqli_num_rows($resultEspecies) > 0) {
                            while ($esp = mysqli_fetch_assoc($resultEspecies)) {
                                echo "<option value='{$esp['id']}'>{$esp['nome']}</option>";
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="campo">
                    <label for="prontuario">Prontuário</label>
                    <textarea
                        id="prontuario"
                        name="prontuario"
                        class="form-control"
                        placeholder="Digite informações sobre o pet"></textarea>
                </div>

                <div class="campo">
                    <label>Gênero</label>
                    <div class="genero">
                        <label class="opcao-genero">
                            <input
                                type="radio"
                                name="genero"
                                value="M"
                                required>
                            Macho
                        </label>

                        <label class="opcao-genero">
                            <input
                                type="radio"
                                name="genero"
                                value="F">
                            Fêmea
                        </label>
                    </div>
                </div>

                <div class="botoes">
                    <a href="index.php" class="btn-voltar">
                        Voltar
                    </a>

                    <button type="reset" class="btn-limpar">
                        Limpar
                    </button>

                    <button type="submit" class="btn-salvar">
                        Salvar Pet
                    </button>
                </div>

            </form>

        </section>

    </main>

    <footer class="rodape">
        Sistema Pet
    </footer>

</body>
</html>
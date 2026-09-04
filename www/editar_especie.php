<?php

require_once __DIR__ . "/conexao.php";

$id = $_GET["id"] ?? "";

if ($id === "" || !is_numeric($id)) {
    die("ID da espécie inválido.");
}

$sql = "SELECT id, nome FROM especie WHERE id = ?";

$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Erro ao preparar consulta: " . $conn->error);
}

$stmt->bind_param("i", $id);
$stmt->execute();

$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    die("Espécie não encontrada.");
}

$especie = $resultado->fetch_assoc();

$stmt->close();

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar Espécie - Sistema Pet</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        * {
            box-sizing: border-box;
        }

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
            font-size: 15px;
        }

        .conteudo {
            max-width: 650px;
            margin: 60px auto;
            padding: 0 20px;
            flex: 1;
            width: 100%;
        }

        .formulario {
            background-color: #FFFFFF;
            border: 1px solid #AFA386;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 7px 20px rgba(78, 53, 30, 0.12);
        }

        .titulo {
            margin-bottom: 8px;
            color: #4E351E;
            font-size: 28px;
            font-weight: 600;
        }

        .descricao {
            margin-bottom: 30px;
            color: #6C5234;
            font-size: 15px;
        }

        .linha-titulo {
            width: 55px;
            height: 4px;
            background-color: #546745;
            border-radius: 5px;
            margin-bottom: 30px;
        }

        .form-label {
            color: #4E351E;
            font-weight: bold;
        }

        .form-control {
            border: 1px solid #AFA386;
            border-radius: 8px;
            padding: 12px;
            background-color: #F7F6E3;
            color: #4E351E;
        }

        .form-control:focus {
            border-color: #546745;
            box-shadow: 0 0 0 0.2rem rgba(84, 103, 69, 0.15);
            background-color: #FFFFFF;
        }

        .botoes {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #AFA386;
            flex-wrap: wrap;
        }

        .btn-salvar {
            background-color: #546745;
            color: #F7F6E3;
            border: none;
            padding: 10px 22px;
            border-radius: 7px;
            font-weight: bold;
        }

        .btn-salvar:hover {
            background-color: #4E351E;
            color: #F7F6E3;
        }

        .btn-voltar {
            background-color: transparent;
            color: #4E351E;
            border: 1px solid #AFA386;
            padding: 10px 22px;
            border-radius: 7px;
            text-decoration: none;
            font-weight: bold;
        }

        .btn-voltar:hover {
            background-color: #4E351E;
            color: #F7F6E3;
        }

        .rodape {
            margin-top: 60px;
            background-color: #4E351E;
            color: #AFA386;
            text-align: center;
            padding: 18px;
            font-size: 14px;
        }

        @media (max-width: 768px) {

            .topo {
                padding: 20px 25px;
            }

            .conteudo {
                margin: 35px auto;
            }

            .formulario {
                padding: 25px;
            }

            .botoes {
                flex-direction: column;
            }

            .botoes button,
            .botoes a {
                width: 100%;
                text-align: center;
            }

        }

    </style>

</head>

<body>

<header class="topo">

    <h1>Sistema Pet</h1>

    <p>Gerenciamento de animais</p>

</header>


<main class="conteudo">

    <div class="formulario">

        <h2 class="titulo">
            Editar Espécie
        </h2>

        <p class="descricao">
            Altere o nome da espécie cadastrada.
        </p>

        <div class="linha-titulo"></div>


        <form action="atualizar_especie.php" method="POST">

            <input
                type="hidden"
                name="id"
                value="<?= $especie['id'] ?>"
            >


            <div class="mb-3">

                <label
                    for="nome"
                    class="form-label"
                >
                    Nome da Espécie
                </label>


                <input
                    type="text"
                    id="nome"
                    name="nome"
                    class="form-control"
                    value="<?= htmlspecialchars($especie['nome']) ?>"
                    required
                >

            </div>


            <div class="botoes">

                <a
                    href="listaespecies.php"
                    class="btn-voltar"
                >
                    Voltar
                </a>


                <button
                    type="submit"
                    class="btn-salvar"
                >
                    Salvar Alteração
                </button>

            </div>

        </form>

    </div>

</main>


<footer class="rodape">

    Sistema Pet

</footer>

</body>

</html>
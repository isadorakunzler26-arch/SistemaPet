<?php

require_once __DIR__ . "/conexao.php";

$sql = "SELECT
            pet.id,
            pet.nome,
            pet.nascimento,
            pet.genero,
            pet.prontuario,
            pet.foto,
            especie.nome AS especie
        FROM pet
        INNER JOIN especie
            ON pet.especie_id = especie.id
        ORDER BY pet.id ASC";

$resultado = $conn->query($sql);

if (!$resultado) {
    die("Erro ao buscar pets: " . $conn->error);
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Lista de Pets - Sistema Pet</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>

        body {
            margin: 0;
            background-color: #F7F6E3;
            font-family: Arial, Helvetica, sans-serif;
            color: #4E351E;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .topo {
            background-color: #546745;
            color: #F7F6E3;
            padding: 22px 50px;
            box-shadow: 0 4px 15px rgba(78, 53, 30, 0.18);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .topo h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 600;
        }

        .topo p {
            margin: 3px 0 0;
            color: #AFA386;
            font-size: 14px;
        }

        .conteudo {
            max-width: 1250px;
            margin: 40px auto;
            padding: 0 25px;
            flex: 1;
            width: 100%;
        }

        .cabecalho-pagina {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .cabecalho-pagina h2 {
            margin: 0;
            color: #4E351E;
            font-size: 30px;
            font-weight: 600;
        }

        .cabecalho-pagina p {
            color: #6C5234;
            margin: 5px 0 0;
        }

        .botao-principal {
            background-color: #546745;
            color: #F7F6E3;
            padding: 11px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.2s ease;
        }

        .botao-principal:hover {
            background-color: #4E351E;
            color: #F7F6E3;
        }

        .tabela-box {
            background-color: #FFFFFF;
            border: 1px solid #AFA386;
            border-radius: 15px;
            padding: 12px;
            box-shadow: 0 5px 18px rgba(78, 53, 30, 0.10);
            overflow-x: auto;
        }

        .table {
            margin: 0;
            vertical-align: middle;
        }

        .table thead th {
            background-color: #546745;
            color: #F7F6E3;
            border: none;
            padding: 16px;
            font-weight: 600;
            font-size: 15px;
        }

        .table thead th:first-child {
            border-radius: 10px 0 0 10px;
        }

        .table thead th:last-child {
            border-radius: 0 10px 10px 0;
        }

        .table tbody td {
            padding: 16px;
            color: #4E351E;
            border-color: #E5E1CC;
        }

        .table tbody tr:hover {
            background-color: #F7F6E3;
        }

        .foto-pet {
            width: 65px;
            height: 65px;
            object-fit: cover;
            border-radius: 10px;
            border: 2px solid #AFA386;
        }

        .sem-foto {
            width: 65px;
            height: 65px;
            border-radius: 10px;
            background-color: #E5E1CC;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6C5234;
            font-size: 11px;
            text-align: center;
        }

        .badge-genero {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            display: inline-block;
        }

        .badge-macho {
            background-color: #E5E1CC;
            color: #4E351E;
            border: 1px solid #AFA386;
        }

        .badge-femea {
            background-color: #546745;
            color: #F7F6E3;
        }

        .btn-acao {
            padding: 6px 14px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 13px;
            text-decoration: none;
            display: inline-block;
            transition: 0.2s ease;
            margin-right: 4px;
        }

        .editar {
            background-color: #AFA386;
            color: #4E351E;
        }

        .editar:hover {
            background-color: #6C5234;
            color: #FFFFFF;
        }

        .excluir {
            background-color: #4E351E;
            color: #FFFFFF;
        }

        .excluir:hover {
            background-color: #546745;
            color: #FFFFFF;
        }

        .voltar {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: 30px;
            color: #6C5234;
            text-decoration: none;
            font-weight: 600;
        }

        .voltar:hover {
            color: #546745;
        }

        .rodape {
            margin-top: 50px;
            background-color: #4E351E;
            color: #AFA386;
            text-align: center;
            padding: 18px;
            font-size: 14px;
        }

        @media (max-width: 700px) {

            .topo {
                padding: 20px;
                flex-direction: column;
                align-items: flex-start;
            }

            .cabecalho-pagina {
                flex-direction: column;
                align-items: flex-start;
            }

            .botao-principal {
                width: 100%;
                text-align: center;
            }

        }

    </style>

</head>

<body>

<header class="topo">

    <div>

        <h1>Sistema Pet</h1>

        <p>Gerenciamento de animais</p>

    </div>

</header>

<main class="conteudo">

    <div class="cabecalho-pagina">

        <div>

            <h2>Lista de Pets</h2>

            <p>
                Consulte e gerencie os pets cadastrados no sistema.
            </p>

        </div>

        <a
            href="cadastro_pet.php"
            class="botao-principal"
        >
            + Novo Pet
        </a>

    </div>

    <div class="tabela-box">

        <table class="table">

            <thead>

                <tr>

                    <th>Foto</th>

                    <th>ID</th>

                    <th>Nome</th>

                    <th>Nascimento</th>

                    <th>Espécie</th>

                    <th>Gênero</th>

                    <th style="text-align: center;">
                        Ações
                    </th>

                </tr>

            </thead>

            <tbody>

            <?php if ($resultado->num_rows > 0): ?>

                <?php while ($pet = $resultado->fetch_assoc()): ?>

                    <tr>

                        <td>

                            <?php if (!empty($pet["foto"])): ?>

                                <img
                                    src="<?= htmlspecialchars($pet["foto"]) ?>"
                                    alt="Foto de <?= htmlspecialchars($pet["nome"]) ?>"
                                    class="foto-pet"
                                >

                            <?php else: ?>

                                <div class="sem-foto">
                                    Sem foto
                                </div>

                            <?php endif; ?>

                        </td>

                        <td>

                            <strong>
                                #<?= $pet["id"] ?>
                            </strong>

                        </td>

                        <td style="font-weight: 600;">

                            <?= htmlspecialchars($pet["nome"]) ?>

                        </td>

                        <td>

                            <?= date(
                                "d/m/Y",
                                strtotime($pet["nascimento"])
                            ) ?>

                        </td>

                        <td>

                            <?= htmlspecialchars($pet["especie"]) ?>

                        </td>

                        <td>

                            <?php if ($pet["genero"] === "M"): ?>

                                <span class="badge-genero badge-macho">
                                    Macho
                                </span>

                            <?php else: ?>

                                <span class="badge-genero badge-femea">
                                    Fêmea
                                </span>

                            <?php endif; ?>

                        </td>

                        <td style="text-align: center;">

                            <a
                                href="editar_pet.php?id=<?= $pet["id"] ?>"
                                class="btn-acao editar"
                            >
                                Editar
                            </a>

                            <a
                                href="deletar_pet.php?id=<?= $pet["id"] ?>"
                                class="btn-acao excluir"
                                onclick="return confirm('Deseja realmente excluir este pet?')"
                            >
                                Excluir
                            </a>

                        </td>

                    </tr>

                <?php endwhile; ?>

            <?php else: ?>

                <tr>

                    <td
                        colspan="7"
                        style="text-align: center; padding: 30px;"
                    >

                        Nenhum pet cadastrado.

                    </td>

                </tr>

            <?php endif; ?>

            </tbody>

        </table>

    </div>

    <a
        href="index.php"
        class="voltar"
    >
        ← Voltar para o início
    </a>

</main>

<footer class="rodape">

    Sistema Pet

</footer>

</body>

</html>
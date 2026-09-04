<?php

require_once __DIR__ . "/conexao.php";

$id = $_GET["id"] ?? "";

if ($id === "" || !is_numeric($id)) {
    die("ID do pet inválido.");
}

$id = (int) $id;


/* BUSCAR O PET */

$sql = "SELECT 
            id,
            nome,
            nascimento,
            genero,
            prontuario,
            especie_id
        FROM pet
        WHERE id = ?";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Erro ao preparar consulta do pet: " . $conn->error);
}

$stmt->bind_param("i", $id);

if (!$stmt->execute()) {
    die("Erro ao buscar pet: " . $stmt->error);
}

$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    die("Pet não encontrado.");
}

$pet = $resultado->fetch_assoc();

$stmt->close();


/* BUSCAR AS ESPÉCIES */

$sqlEspecies = "SELECT id, nome
                FROM especie
                ORDER BY nome ASC";

$resultadoEspecies = $conn->query($sqlEspecies);

if (!$resultadoEspecies) {
    die("Erro ao buscar espécies: " . $conn->error);
}

?>

<!DOCTYPE html>

<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar Pet - Sistema Pet</title>

    <style>

        * {
            box-sizing: border-box;
        }

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

        .conteudo {
            max-width: 750px;
            margin: 45px auto;
            padding: 0 20px;
        }

        .titulo {
            margin-bottom: 25px;
        }

        .titulo h2 {
            margin: 0;
            font-size: 30px;
        }

        .titulo p {
            color: #6C5234;
        }

        .formulario {
            background-color: white;
            padding: 35px;
            border-radius: 15px;
            border: 1px solid #AFA386;
            box-shadow: 0 5px 18px rgba(78, 53, 30, 0.10);
        }

        .campo {
            margin-bottom: 20px;
        }

        .campo label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 11px;
            border: 1px solid #AFA386;
            border-radius: 8px;
            background-color: #F7F6E3;
            color: #4E351E;
            font-size: 15px;
        }

        textarea {
            min-height: 130px;
            resize: vertical;
        }

        .generos {
            display: flex;
            gap: 15px;
        }

        .genero {
            width: auto;
        }

        .generos label {
            border: 1px solid #AFA386;
            padding: 12px 20px;
            border-radius: 8px;
            background-color: #F7F6E3;
            cursor: pointer;
        }

        .generos input {
            width: auto;
            margin-right: 7px;
        }

        .botoes {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #AFA386;
        }

        .botao {
            padding: 11px 22px;
            border-radius: 8px;
            text-decoration: none;
            border: none;
            font-weight: bold;
            cursor: pointer;
            font-size: 14px;
        }

        .voltar {
            background-color: transparent;
            border: 1px solid #AFA386;
            color: #4E351E;
        }

        .salvar {
            background-color: #546745;
            color: #F7F6E3;
        }

        .salvar:hover {
            background-color: #4E351E;
        }

        .rodape {
            margin-top: 60px;
            background-color: #4E351E;
            color: #AFA386;
            text-align: center;
            padding: 18px;
        }

    </style>

</head>


<body>


<header class="topo">

    <h1>Sistema Pet</h1>

    <p>Gerenciamento de animais</p>

</header>


<main class="conteudo">


    <div class="titulo">

        <h2>Editar Pet</h2>

        <p>Altere os dados do pet cadastrado.</p>

    </div>


    <div class="formulario">


        <form
            action="atualizar_pet.php"
            method="POST"
        >


            <!-- ID DO PET -->

            <input
                type="hidden"
                name="id"
                value="<?= $pet["id"] ?>"
            >


            <!-- NOME -->

            <div class="campo">

                <label for="nome">
                    Nome do Pet
                </label>

                <input
                    type="text"
                    id="nome"
                    name="nome"
                    value="<?= htmlspecialchars($pet["nome"]) ?>"
                    required
                >

            </div>


            <!-- NASCIMENTO -->

            <div class="campo">

                <label for="nascimento">
                    Nascimento
                </label>

                <input
                    type="date"
                    id="nascimento"
                    name="nascimento"
                    value="<?= htmlspecialchars($pet["nascimento"]) ?>"
                    required
                >

            </div>


            <!-- ESPÉCIE -->

            <div class="campo">

                <label for="especie">
                    Espécie
                </label>

                <select
                    id="especie"
                    name="especie"
                    required
                >

                    <option value="">
                        Selecione uma espécie
                    </option>


                    <?php while ($especie = $resultadoEspecies->fetch_assoc()): ?>

                        <option
                            value="<?= $especie["id"] ?>"
                            <?php
                            if ($pet["especie_id"] == $especie["id"]) {
                                echo "selected";
                            }
                            ?>
                        >

                            <?= htmlspecialchars($especie["nome"]) ?>

                        </option>

                    <?php endwhile; ?>


                </select>

            </div>


            <!-- PRONTUÁRIO -->

            <div class="campo">

                <label for="prontuario">
                    Prontuário
                </label>

                <textarea
                    id="prontuario"
                    name="prontuario"
                ><?= htmlspecialchars($pet["prontuario"] ?? "") ?></textarea>

            </div>


            <!-- GÊNERO -->

            <div class="campo">

                <label>
                    Gênero
                </label>


                <div class="generos">


                    <label>

                        <input
                            type="radio"
                            name="genero"
                            value="M"
                            <?= $pet["genero"] === "M" ? "checked" : "" ?>
                            required
                        >

                        Macho

                    </label>


                    <label>

                        <input
                            type="radio"
                            name="genero"
                            value="F"
                            <?= $pet["genero"] === "F" ? "checked" : "" ?>
                        >

                        Fêmea

                    </label>


                </div>

            </div>


            <!-- BOTÕES -->

            <div class="botoes">


                <a
                    href="listadepets.php"
                    class="botao voltar"
                >
                    Voltar
                </a>


                <button
                    type="submit"
                    class="botao salvar"
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
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Pets - Sistema Pet</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

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
            max-width: 1150px;
            margin: 40px auto;
            padding: 0 25px;
            flex: 1;
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
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .botao-principal:hover {
            background-color: #4E351E;
            color: #F7F6E3;
        }

        /* Barra de pesquisa/filtro */
        .card-filtro {
            background-color: #FFFFFF;
            border: 1px solid #AFA386;
            border-radius: 12px;
            padding: 15px 20px;
            margin-bottom: 25px;
            box-shadow: 0 3px 10px rgba(78, 53, 30, 0.06);
        }

        .form-control-busca {
            border: 1px solid #AFA386;
            border-radius: 7px;
            padding: 9px 12px;
            background-color: #F7F6E3;
            color: #4E351E;
        }

        .form-control-busca:focus {
            border-color: #546745;
            box-shadow: 0 0 0 3px rgba(84, 103, 69, 0.15);
            background-color: #FFFFFF;
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

        /* Badges estilizadas para Gênero */
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

        /* Botões de Ação */
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
            transition: 0.2s ease;
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
                justify-content: center;
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
            <p>Consulte e gerencie os pets cadastrados no sistema.</p>
        </div>

        <a href="cadastro_pet.php" class="botao-principal">
            + Novo Pet
        </a>
    </div>

    <!-- Barra de busca rápida -->
    <div class="card-filtro">
        <div class="row g-2">
            <div class="col-md-9">
                <input type="text" class="form-control form-control-busca" placeholder="Pesquisar pet por nome ou espécie...">
            </div>
            <div class="col-md-3">
                <button class="btn btn-salvar w-100" style="background-color: #546745; color: #F7F6E3; font-weight: bold; border-radius: 7px; padding: 9px;">
                    Buscar
                </button>
            </div>
        </div>
    </div>

    <div class="tabela-box">

        <table class="table">

            <thead>
                <tr>
                    <th style="width: 80px;">ID</th>
                    <th>Nome</th>
                    <th>Nascimento</th>
                    <th>Espécie</th>
                    <th>Gênero</th>
                    <th style="width: 180px; text-align: center;">Ações</th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <td><strong>#1</strong></td>
                    <td style="font-weight: 600;">Rex</td>
                    <td>15/02/2021</td>
                    <td>Cachorro</td>
                    <td><span class="badge-genero badge-macho">Macho</span></td>
                    <td style="text-align: center;">
                        <a href="editar_pet.php?id=1" class="btn-acao editar">Editar</a>
                        <a href="deletar_pet.php?id=1"
                           class="btn-acao excluir"
                           onclick="return confirm('Deseja realmente excluir este pet?')">
                            Excluir
                        </a>
                    </td>
                </tr>

                <tr>
                    <td><strong>#2</strong></td>
                    <td style="font-weight: 600;">Mimi</td>
                    <td>08/07/2022</td>
                    <td>Gato</td>
                    <td><span class="badge-genero badge-femea">Fêmea</span></td>
                    <td style="text-align: center;">
                        <a href="editar_pet.php?id=2" class="btn-acao editar">Editar</a>
                        <a href="deletar_pet.php?id=2"
                           class="btn-acao excluir"
                           onclick="return confirm('Deseja realmente excluir este pet?')">
                            Excluir
                        </a>
                    </td>
                </tr>

                <tr>
                    <td><strong>#3</strong></td>
                    <td style="font-weight: 600;">Pingo</td>
                    <td>12/09/2023</td>
                    <td>Coelho</td>
                    <td><span class="badge-genero badge-macho">Macho</span></td>
                    <td style="text-align: center;">
                        <a href="editar_pet.php?id=3" class="btn-acao editar">Editar</a>
                        <a href="deletar_pet.php?id=3"
                           class="btn-acao excluir"
                           onclick="return confirm('Deseja realmente excluir este pet?')">
                            Excluir
                        </a>
                    </td>
                </tr>

            </tbody>

        </table>

    </div>

    <a href="index.php" class="voltar">
        ← Voltar para o início
    </a>

</main>

<footer class="rodape">
    Sistema Pet
</footer>

</body>
</html>
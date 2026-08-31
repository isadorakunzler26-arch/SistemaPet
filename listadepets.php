<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Pets</title>

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

        .conteudo{
            width:900px;
            margin:40px auto;
            background:white;
            padding:30px;
            border-radius:8px;
            border:1px solid #ccc;
        }

        h3{
            color:#2E7D32;
            margin-bottom:20px;
        }

        table{
            margin-top:20px;
        }

    </style>

</head>
<body>

<div class="cabecalho">
    <h2>Sistema Pet</h2>
</div>

<div class="conteudo">

    <h3>Lista de Pets</h3>

    <a href="cadastro_pet.php" class="btn btn-success mb-3">
        Novo Pet
    </a>

    <table class="table table-bordered table-striped">

        <thead class="table-success">

            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Nascimento</th>
                <th>Espécie</th>
                <th>Gênero</th>
                <th>Ações</th>
            </tr>

        </thead>

        <tbody>

            <tr>
                <td>1</td>
                <td>Rex</td>
                <td>15/02/2021</td>
                <td>Cachorro</td>
                <td>Macho</td>

                <td>
                    <a href="editar_pet.php?id=1" class="btn btn-primary btn-sm">
                        Editar
                    </a>

                    <a href="deletar_pet.php?id=1"
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Deseja realmente excluir este pet?')">
                        Excluir
                    </a>
                </td>
            </tr>

            <tr>
                <td>2</td>
                <td>Mimi</td>
                <td>08/07/2022</td>
                <td>Gato</td>
                <td>Fêmea</td>

                <td>
                    <a href="editar_pet.php?id=2" class="btn btn-primary btn-sm">
                        Editar
                    </a>

                    <a href="deletar_pet.php?id=2"
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Deseja realmente excluir este pet?')">
                        Excluir
                    </a>
                </td>
            </tr>

            <tr>
                <td>3</td>
                <td>Pingo</td>
                <td>12/09/2023</td>
                <td>Coelho</td>
                <td>Macho</td>

                <td>
                    <a href="editar_pet.php?id=3" class="btn btn-primary btn-sm">
                        Editar
                    </a>

                    <a href="deletar_pet.php?id=3"
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Deseja realmente excluir este pet?')">
                        Excluir
                    </a>
                </td>
            </tr>

        </tbody>

    </table>

    <a href="telainicial.php" class="btn btn-secondary">
        Voltar
    </a>

</div>

</body>
</html>
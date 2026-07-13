<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Espécies</title>

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
            width:700px;
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

    </style>

</head>
<body>

<div class="cabecalho">
    <h2>Sistema Pet</h2>
</div>

<div class="conteudo">

    <h3>Lista de Espécies</h3>

    <a href="cadastro_especie.php" class="btn btn-success mb-3">
        Nova Espécie
    </a>

    <table class="table table-bordered table-striped">

        <thead class="table-success">

            <tr>
                <th>ID</th>
                <th>Espécie</th>
                <th>Ações</th>
            </tr>

        </thead>

        <tbody>

            <tr>
                <td>1</td>
                <td>Cachorro</td>
                <td>
                    <a href="editar_especie.php?id=1" class="btn btn-primary btn-sm">
                        Editar
                    </a>

                    <a href="deletar_especie.php?id=1"
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Deseja excluir esta espécie?')">
                        Excluir
                    </a>
                </td>
            </tr>

            <tr>
                <td>2</td>
                <td>Gato</td>
                <td>
                    <a href="editar_especie.php?id=2" class="btn btn-primary btn-sm">
                        Editar
                    </a>

                    <a href="deletar_especie.php?id=2"
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Deseja excluir esta espécie?')">
                        Excluir
                    </a>
                </td>
            </tr>

            <tr>
                <td>3</td>
                <td>Coelho</td>
                <td>
                    <a href="editar_especie.php?id=3" class="btn btn-primary btn-sm">
                        Editar
                    </a>

                    <a href="deletar_especie.php?id=3"
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Deseja excluir esta espécie?')">
                        Excluir
                    </a>
                </td>
            </tr>

            <tr>
                <td>4</td>
                <td>Pássaro</td>
                <td>
                    <a href="editar_especie.php?id=4" class="btn btn-primary btn-sm">
                        Editar
                    </a>

                    <a href="deletar_especie.php?id=4"
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Deseja excluir esta espécie?')">
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
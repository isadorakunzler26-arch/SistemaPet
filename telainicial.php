<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Página Inicial</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background-color:#ececec;
    font-family:Arial;
}

.topo{
    background-color:#ffec72ff;
    color:white;
    padding:15px;
}

.topo h2{
    margin:0;
}

.menu{
    width:800px;
    margin:40px auto;
}

.caixa{
    background:white;
    border:1px solid #fff6bcff;
    border-radius:8px;
    padding:20px;
    margin-bottom:20px;
}

.caixa h4{
    color:#ffec72ff;
}

.botao{
    background:#ffec72ff;
    color:white;
}

.botao:hover{
    background:#ffec72ff;
    color:white;
}

</style>

</head>
<body>

<div class="topo">

    <h2>Sistema Pet</h2>

</div>

<div class="menu">

    <h3>Bem-vindo!</h3>

    <p>Escolha uma das opções abaixo.</p>

    <div class="caixa">

        <h4>Cadastrar Pet</h4>

        <p>Cadastre um novo pet.</p>

        <a href="cadastro_pet.php" class="btn botao">
            Abrir
        </a>

    </div>

    <div class="caixa">

        <h4>Lista de Pets</h4>

        <p>Veja todos os pets cadastrados.</p>

        <a href="listar_pet.php" class="btn botao">
            Abrir
        </a>

    </div>

    <div class="caixa">

        <h4>Cadastrar Espécie</h4>

        <p>Cadastre uma nova espécie.</p>

        <a href="cadastro_especie.php" class="btn botao">
            Abrir
        </a>

    </div>

    <div class="caixa">

        <h4>Lista de Espécies</h4>

        <p>Veja as espécies cadastradas.</p>

        <a href="listar_especie.php" class="btn botao">
            Abrir
        </a>

    </div>

</div>

</body>
</html>
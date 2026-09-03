<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Pet</title>

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
        }

        .topo {
            background-color: #546745;
            color: #F7F6E3;
            padding: 22px 50px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 3px 12px rgba(78, 53, 30, 0.18);
        }

        .topo h1 {
            margin: 0;
            font-size: 30px;
            font-weight: 600;
        }

        .topo span {
            color: #AFA386;
            font-size: 15px;
        }

        .principal {
            max-width: 1050px;
            margin: 55px auto;
            padding: 0 25px;
        }

        .apresentacao {
            margin-bottom: 35px;
        }

        .apresentacao h2 {
            margin: 0 0 8px;
            color: #4E351E;
            font-size: 32px;
            font-weight: 600;
        }

        .apresentacao p {
            margin: 0;
            color: #6C5234;
            font-size: 16px;
        }

        .linha-titulo {
            width: 55px;
            height: 4px;
            background-color: #546745;
            border-radius: 5px;
            margin-top: 15px;
        }

        .opcoes {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 25px;
        }

        .card-opcao {
            background-color: #FFFFFF;
            border: 1px solid #AFA386;
            border-radius: 14px;
            padding: 30px;
            min-height: 220px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 0 5px 15px rgba(78, 53, 30, 0.10);
            transition: 0.25s ease;
        }

        .card-opcao:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 22px rgba(78, 53, 30, 0.18);
        }

        .icone {
            width: 48px;
            height: 48px;
            background-color: #546745;
            color: #F7F6E3;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            margin-bottom: 18px;
        }

        .card-opcao h3 {
            margin: 0 0 10px;
            color: #4E351E;
            font-size: 22px;
            font-weight: 600;
        }

        .card-opcao p {
            margin: 0;
            color: #6C5234;
            line-height: 1.6;
            font-size: 15px;
        }

        .botao {
            display: inline-block;
            margin-top: 25px;
            background-color: #546745;
            color: #F7F6E3;
            text-decoration: none;
            text-align: center;
            padding: 10px 20px;
            border-radius: 7px;
            font-size: 14px;
            font-weight: bold;
            transition: 0.2s ease;
            width: fit-content;
        }

        .botao:hover {
            background-color: #4E351E;
            color: #F7F6E3;
        }

        .rodape {
            margin-top: 55px;
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

            .topo h1 {
                font-size: 25px;
            }

            .topo span {
                display: none;
            }

            .principal {
                margin: 35px auto;
            }

            .apresentacao h2 {
                font-size: 27px;
            }

            .opcoes {
                grid-template-columns: 1fr;
            }

            .card-opcao {
                min-height: 200px;
            }
        }
    </style>
</head>

<body>

    <header class="topo">
        <h1>Sistema Pet</h1>
        <span>Gerenciamento de animais</span>
    </header>

    <main class="principal">

        <section class="apresentacao">
            <h2>Bem-vindo!</h2>
            <p>Gerencie os pets e as espécies cadastradas no sistema.</p>
            <div class="linha-titulo"></div>
        </section>

        <section class="opcoes">

            <div class="card-opcao">

                <div>
                    <div class="icone">+</div>

                    <h3>Cadastrar Pet</h3>

                    <p>
                        Cadastre um novo pet informando nome,
                        nascimento, espécie, gênero e prontuário.
                    </p>
                </div>

                <a href="cadastro_pet.php" class="botao">
                    Cadastrar Pet
                </a>

            </div>

            <div class="card-opcao">

                <div>
                    <div class="icone">🐾</div>

                    <h3>Lista de Pets</h3>

                    <p>
                        Consulte todos os pets cadastrados
                        e gerencie suas informações.
                    </p>
                </div>

                <a href="listadepets.php" class="botao">
                    Ver Pets
                </a>

            </div>

            <div class="card-opcao">

                <div>
                    <div class="icone">+</div>

                    <h3>Cadastrar Espécie</h3>

                    <p>
                        Adicione novas espécies para utilizar
                        no cadastro dos pets.
                    </p>
                </div>

                <a href="cadastro_especie.php" class="botao">
                    Cadastrar Espécie
                </a>

            </div>

            <div class="card-opcao">

                <div>
                    <div class="icone">●</div>

                    <h3>Lista de Espécies</h3>

                    <p>
                        Consulte e gerencie todas as espécies
                        disponíveis no sistema.
                    </p>
                </div>

                <a href="listaespecies.php" class="botao">
                    Ver Espécies
                </a>

            </div>

        </section>

    </main>

    <footer class="rodape">
        Sistema Pet
    </footer>

</body>
</html>
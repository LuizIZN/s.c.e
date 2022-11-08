<?php
//session_start();
include("../../php/conexao.php");
include("../../php/verifica_login.php");

$query = "SELECT nome FROM produtos";
$dados = mysqli_query($conn, $query);
$linha = mysqli_fetch_assoc($dados);
$total = mysqli_num_rows($dados);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/home_user.css" type="text/css">
    <title>Página do funcionário</title>
</head>
<body>

    <header class="head">
        <p id="titulo">Controle de Estoque</p>
        <nav class="menu">
            <a class="menu-item" href="cad_prod_user.php">
                Cadastrar Produto
            </a>
            <a class="menu-item" href="produtos_user.php">
                Produtos
            </a>
            <a class="menu-item" href="vendas_user.php">
                Vendas
            </a>
            <a class="menu-item" href="../../php/logout.php">
                Sair
            </a>
        </nav>
    </header>

    <main class="corpo">
    <button type='submit' class='butao' id='butaoalt'><strong>CADASTRAR VENDA</strong></button>
            <style>
            
            .butao {
                margin: 20px;
                border-radius: 30px;
                padding: 2px;
                width: 300px;
                height: 80px;
                font-size: 27px;
                background: limegreen;
                color: #fff;
                border: none;
                box-shadow: 4px 4px 4px darkslategray;
            }

            .butao:hover {
                cursor: pointer;
                background-color: lime;
                transition: background 0.5s;
            }

            .modal-container {
                width: 100vw;
                height: 100vh;
                position: fixed;
                top: 0px;
                left: 0px;
                background: rgba(0, 0, 0, .5);
                z-index: 2000;
                display: none;
                justify-content: center;
                align-items: center;
                font-family: Verdana, Geneva, Tahoma, sans-serif;
            }
    
            .modal-container.mostrar {
                display: flex;
            }
    
            @keyframes modal {
                from {
                    opacity: 0;
                    transform: translate3d(0, -60px, 0);
                } 
                to {
                    opacity: 1;
                    transform: translate3d(0, 0, 0);
                }
            }
    
            .mostrar .modal {
                animation: modal .3s;
            }
    
            .modal {
                background: #fff;
                width: 20%;
                min-width: 300px;
                padding: 15px;
                border: 5px solid darkslategrey;
                box-shadow: 0 0 0 5px white;
            }
    
            .fechar {
                position: relative;
                top: -34px;
                right: -120px;
                width: 30px;
                height: 30px;
                border-radius: 50%;
                border: 4px solid white;
                background: darkslategrey;
                box-shadow: none;
            }
    
            .fechar:hover {
                background-color: darkslategrey;
                transition: background 1s;
            }
    
            .botaoalt {
                font-size: 15px;
                width: 100px;
                height: 30px;
                margin: 0 auto;
                margin-top: 10px;
                margin-left: 75px;
                background: darkslategrey;
                border: none;
                color: white;
            }
    
            .botaoalt:hover {
                background-color: black;
                transition: background 1s;
            }
    
            h3 {
                color: darkslategrey;
                text-shadow: 2px 2px 2px 2px black;
                font-size: 15px;
                margin-bottom: 3px;
            }
    
            input, select {
                margin: 5px;
                font-size: 15px;
                width: 250px;
                border: 1px solid darkslategrey;
                border-radius: 5px;
                padding: 5px;
            }
    
            .modal input:focus {
                box-shadow: none;
                outline: 0;
            }
        </style>
        
        <div id='modal-alt' class='modal-container'>
                <div class='modal'>
                    <h3 class='modaltit'>Informe o(s) novo(s) dado(s):</h3>
                    <form action='../../php/vender.php' method='post'>
                        <select name="produto" class="produto" id="produto">
                            <option selected disabled>Selecione o produto</option>
                            <?php
                             do {
                            ?>
                                <option required value="<?=$linha['nome']?>"><?=$linha['nome']?></option>
                              <?php  }while($linha = mysqli_fetch_assoc($dados)) ?>
                        </select>
                        <input type="number" name="qtde_vend" placeholder="Informe a quantidade vendida...">
                        <button type='submit' class='botaoalt'><strong>Confirmar</strong></button>
                    </form>
                </div>
        </div>
    
        <script>
            function iniciaModal(modalID) {
                const modal = document.getElementById(modalID);
                if(modal) {
                modal.classList.add('mostrar');
                modal.addEventListener('click', (e) => {
                    if(e.target.id == modalID || e.target.className == 'fechar') {
                        modal.classList.remove('mostrar');
                    }
                });
                }
            }
    
            const but = document.querySelector('.butao')
            but.addEventListener('click', function() {
                iniciaModal('modal-alt');
            });
            
        </script>

        <style>
            .butao2 {
                margin: 20px;
                border-radius: 30px;
                padding: 2px;
                width: 300px;
                height: 80px;
                font-size: 27px;
                background: lightslategray;
                color: #fff;
                border: none;
                box-shadow: 4px 4px 4px darkslategray; 
            }

            .butao2:hover {
                cursor: pointer;
                background-color: #919194;
                transition: background 0.5s;
            }
        </style>

        <form action="../../php/relatorio_user.php" target="_blank">
            <button type='submit' class='butao2' id='butaoalt'><strong>GERAR RELATÓRIO</strong></button>
        </form>

        <form action="../../php/relatorio_excel_user.php">
            <button type='submit' class='butao2' id='butaoalt'><strong>GERAR PLANILHA</strong></button>
        </form>

    </main>
    
</body>
</html>
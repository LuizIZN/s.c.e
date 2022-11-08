<?php
//session_start();
include("../../php/conexao.php");
include("../../php/verifica_login.php");

$query = "SELECT nome FROM produtos";
$dados = mysqli_query($conn, $query);
$linha = mysqli_fetch_assoc($dados);
$total = mysqli_num_rows($dados);

$query_fil = "SELECT nome FROM produtos";
$dados_fil = mysqli_query($conn, $query);
$linha_fil = mysqli_fetch_assoc($dados_fil);
$total_fil = mysqli_num_rows($dados_fil);

$query_filtro = "SELECT nome FROM usuarios";
$dados_filtro = mysqli_query($conn, $query_filtro);
$linha_filtro = mysqli_fetch_assoc($dados_filtro);
$total_filtro = mysqli_num_rows($dados_filtro);
$time = date("Y-m-d");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/home_admin.css" type="text/css">
    <title>Página do administrador</title>
</head>
<body>

    <header class="head">
        <p id="titulo">Controle de Estoque</p>
        <nav class="menu">
            <a class="menu-item" href="cad_prod.php">
                Cadastrar Produto
            </a>
            <a class="menu-item" href="cad_usuario.php">
                Cadastrar usuário
            </a>
            <a class="menu-item" href="produtos.php">
                Produtos
            </a>
            <a class="menu-item" href="cad_admin.php">
                Cadastrar administrador
            </a>
            <a class="menu-item" href="gerenciar_user.php">
                Gerenciar usuários
            </a>
            <a class="menu-item" href="vendas.php">
                Vendas
            </a>
            <a class="menu-item" href="../../php/logout.php">
                Sair
            </a>
        </nav>
    </header>

    <main class="corpo">
        
      
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
                        <button type='submit' class='botaoalt'><strong>CONFIRMAR</strong></button>
                    </form>
                </div>
        </div>
    

    <div id="modal-filtro" class="modal-container2">
        <div class="modal2">
            <h3 style="color: darkslategrey;
                text-shadow: 2px 2px 2px 2px black;
                font-size: 20px;
                margin-bottom: 3px;">Filtre o resultado:</h3>
            <form action="../../php/relatorio_filtro.php" target="_blank" method="post">
                <select name="produto-filtro" id="produto-filtro">
                    <option disabled selected>Filtrar por produto</option>
                    <?php
                         do {
                    ?>
                        <option required value="<?=$linha_fil['nome']?>"><?=$linha_fil['nome']?></option>
                    <?php  }while($linha_fil = mysqli_fetch_assoc($dados_fil)) ?>
                </select><br>
                <select name="vendedor-filtro" id="vendedor-filtro">
                    <option disabled selected>Filtrar por funcionário</option>
                    <?php
                         do {
                    ?>
                        <option required value="<?=$linha_filtro['nome']?>"><?=$linha_filtro['nome']?></option>
                    <?php  }while($linha_filtro = mysqli_fetch_assoc($dados_filtro)) ?>
                </select><br>
                <!-- <input placeholder="Filtrar por data" name="data" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="date"  min="2022-04-01" max="ks><br> -->
                <button type="submit" class="botaoalt" value="gerar">GERAR</button>
            </form>
            <a href="../../php/relatorio.php" target="_blank"><button class="botaoalt">GERAL</button></a>
            <a href="../../php/relatorio_excel.php" target="_blank"><button class="botaoalt">PLANILHA</button></a>
        </div>
    </div>

   


    <button type='submit' class='butao' id='butaoalt'><strong>CADASTRAR VENDA</strong></button> <br>
    <button type='submit' class='butao2' id='butaoalt'><strong>GERAR RELATÓRIO</strong></button>

    <script>
        function iniciaModal2(modalID) {
            const modal = document.getElementById(modalID);
                if(modal) {
                modal.classList.add('mostrar2');
                modal.addEventListener('click', (e) => {
                    if(e.target.id == modalID || e.target.className == 'fechar') {
                        modal.classList.remove('mostrar2');
                    }
                });
                }
        }
        const but2 = document.querySelector('.butao2')
            but2.addEventListener('click', function() {
                iniciaModal2('modal-filtro');
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
                background: darkslateblue;
                color: #fff;
                border: none;
                box-shadow: 4px 4px 4px darkslategray;
            }

            .butao2:hover {
                cursor: pointer;
                background-color: cornflowerblue;
                transition: background 0.5s;
            }

            .modal-container2 {
                width: 100vw;
                height: 100vh;
                position: fixed;
                background: rgba(0, 0, 0, .5);
                display: none;
                top: 0px;
                left: 0px;
                z-index: 2000;
                justify-content: center;
                align-items: center;
            }

            .modal2 {
                background: #fff;
                width: 20%;
                min-width: 300px;
                padding: 15px;
                border: 5px solid darkslategrey;
                box-shadow: 0 0 0 5px white;
            }

            .modal-container2.mostrar2 {
                display: flex;
            }

            @keyframes modal2 {
                from {
                    opacity: 0;
                    transform: translate3d(0, -60px, 0);
                }
                to {
                    opacity: 1;
                    transform: translate3d(0, 0, 0);
                }
            }

            .mostrar2 .modal2 {
                animation: modal2 .5s;
            }
            
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
                animation: modal .5s;
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
                border-radius: 5px;
            }
    
            .botaoalt:hover {
                background-color: black;
                transition: background 1s;
                cursor: pointer;
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
    
            input:focus, select:focus {
                box-shadow: none;
                outline: 0;
            }
        </style>
       

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

        </main>
    
</body>
</html>
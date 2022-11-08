<?php
include("../../php/verifica_login.php");
include("../../php/conexao.php");

$query = "SELECT nome, cpf, celular, email FROM usuarios";
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
    <link rel="stylesheet" href="../../style/gerenciar_user.css" type="text/css">
    <script src="../../js/popup.js" defer></script>
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
        <?php
            if($total > 0) {
		    // inicia o loop que vai mostrar todos os dados
		        do {
        ?>
        
                <div class="content" style="height: 150px; font-size: 16px;">
			        <p><strong>Nome: </strong> <?=$linha['nome']?> <br><strong>CPF: </strong><?=$linha['cpf']?> <br> <strong>N° de celular: </strong> <?=$linha['celular']?> <br> <strong>Email: </strong> <?=$linha['email']?></p>

        <?php
		    // finaliza o loop que vai mostrar os dados
            echo"<button type='submit' class='butao' id='butaoalt' style='background: green; height: 25px'><strong>ALTERAR DADOS</strong></button>
            <style> 
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
    
            input {
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
                    <form action='../../php/alt_dados?cpf=".$linha['cpf']."' method='post'>
                        <input type='email' name='email' placeholder='Email:'><br>
                        <input type='text' name='celular' maxlength=11 placeholder='N° de celular:'>
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
            
        </script>";
            echo"<a id='butao' href='../../php/delete_user.php?cpf=".$linha['cpf']."'><button type='submit' class='butao'><strong>DELETAR USUÁRIO</strong></button></a></div>";
		        }while($linha = mysqli_fetch_assoc($dados));
	        // fim do if
	        }
        ?>
    </main>

    
</body>
</html>
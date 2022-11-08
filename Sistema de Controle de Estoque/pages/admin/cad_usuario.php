<?php
//session_start();
include("../../php/verifica_login.php")
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/cad_user.css" type="text/css">
    <script src="../../js/validar.js" defer></script>
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
        <p>Insira o CPF do novo funcionário:</p>
        <form method="post" action="../../php/cad_user.php">
            <label for="cpfU">CPF:</label>
            <input type="text" name="cpfU" id="cpfU" maxlength="11"> 
            <button type="submit">Cadastrar</button>
            
        </form>
    </main>
    
</body>
</html>
<?php
//session_start();
include("../../php/verifica_login.php");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/cad_admin.css" type="text/css">
    <script src="../../js/validar.js" defer></script>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <meta http-equiv="content-Type" content="text/html; charset=iso-8859-1">
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
    <div class="msg">
        <p>Preencha o formulário abaixo:</p>
    </div>

    <main class="form">
        <form method="post" action="../../php/cadastrar_admin.php" >
            <fieldset>
                <label for="nome">Nome: </label>
                <input type="text" name="nome" id="nome" required>
                <label for="cpf">CPF: </label>
                <input type="text" name="cpf" id="cpf" required>
                <label for="celular">N° de celular:</label>
                <input type="text" name="celular" id="celular" maxlength="11" required>
                <label for="email">Email: </label>
                <input type="email" name="email" id="email" required>
                <label for="senha">Senha:</label>
                <input type="password" name="senha" id="senha" maxlength="8" required>
                <label for="csenha">Confirmar senha: </label>
                <input type="password" name="csenha" id="csenha" maxlength="8" required><br>
                <div class="botoes">
                    <button type="reset" class="botaor">Limpar</button>
                    <button type="submit" class="botao" onsubmit="">Confirmar</button>
                </div>
            </fieldset>
        </form>
    </main>
    </main>
    
</body>
</html>
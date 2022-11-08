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
    <link rel="stylesheet" href="../../style/cad_prod_user.css" type="text/css">
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
    <div class="msg">
            <p>Preencha o formulário abaixo:</p>
        </div>
        <form action="../../php/cad_produto2.php" method="post">
        <fieldset>
                <label for="nome">Nome e marca: </label>
                <input type="text" name="nome" id="nome" placeholder="Digite aqui..." required>
                <label for="preco">Preço: </label>
                <input type="text" name="preco" id="preco" placeholder="XXX.XX" required>
                <label for="qtde">Quantidade em estoque:</label>
                <input type="number" name="qtde" id="qtde" placeholder="Digite aqui..." required>
                <label for="tipo">Tipo: </label>
                <select name="tipo" id="tipo" required>
                    <option value="" disabled selected>Selecione</option>
                    <option value="Limpeza">Limpeza</option>
                    <option value="Alimento">Alimento</option>
                    <option value="Variados">Variados</option>
                    <option value="Eletrodomésticos">Eletrodomésticos</option>
                    <option value="Eletrônicos">Eletrônicos</option>
                    <option value="Beleza e higiene">Beleza e higiene</option>
                </select>
                <label for="descricao">Descrição (opcional):</label>
                <textarea name="descricao" id="descricao" placeholder="Digite aqui..." resize="none" maxlength="100"></textarea> <br>
                <div class="botoes">
                    <button type="reset" class="botaor">Limpar</button>
                    <button type="submit" class="botao" onsubmit="">Confirmar</button>
                </div>
            </fieldset>
        </form>
    </main>
    
</body>
</html>
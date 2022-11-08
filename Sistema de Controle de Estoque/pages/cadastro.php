<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/cadastro.css" type="text/css">
    <script src="../js/validar.js" defer></script>
    <title>Cadastro de usuarios.</title>
</head>
<body>
    <main class="corpo">
    <div class="msg">
        <h1>Cadastre-se.</h1>
        <p>Preencha o formulário abaixo:</p>
    </div>

    <main class="form">
        <form method="post" action="../php/cad.php" >
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
    <a href="index.php" style="text-align: center;">Clique para voltar <br> à tela de login.</a>
    </main>
</body>
</html>
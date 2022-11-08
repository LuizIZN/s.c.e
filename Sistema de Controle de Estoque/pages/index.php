<?php
//include("../php/verifica_login.php");
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../style/index.css">
    <title>Login</title>
</head>
<body>
    <main class="corpo">
        <div class="paragrafo">
            <h1>Login</h1>
            <p>Entre no sistema.</p>
        </div>
        <form action="../php/login.php" method="post">
            <fieldset class="cpf">
                <label for="cpf">CPF:</label>
                <input type="text" name="cpf" id="cpf" required maxlength="11>
            </fieldset>
            <fieldset class="senha">
                <label for="senha">Senha:</label>
                <input type="password" name="senha" id="senha" required maxlength="8">
            </fieldset>
            <button type="submit">Entrar</button>
        </form>
            <a href="cadastro.php" class="red">Não tem cadastro?<br>Clique aqui.</a>
    </main>
</body>
</html>
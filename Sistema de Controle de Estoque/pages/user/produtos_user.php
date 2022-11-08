<?php
//session_start();
include("../../php/verifica_login.php");
include("../../php/conexao.php");

$cpf = $_SESSION['cpf'];
$user_q = "SELECT nome FROM usuarios WHERE cpf = '{$cpf}'";
$result = mysqli_query($conn, $user_q); 
    while($row = $result->fetch_array()) {
     $user = $row['nome'];
    }

$query = "SELECT cod, nome, preco, qtde, total, descricao, usuario, created FROM produtos WHERE usuario='$user'";
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
    <link rel="stylesheet" href="../../style/produtos_user.css" type="text/css">
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
    <?php
            if($total > 0) {
		    // inicia o loop que vai mostrar todos os dados
		        do {
        ?>

                <div class="content">
			        <p><strong>Código: </strong> <?=$linha['cod']?> <br><strong>Nome: </strong><?=$linha['nome']?> <br> <strong>Preço: </strong> R$<?=number_format($linha['preco'], 2, ',', '.')?> <br> <strong>Qtde em estoque: </strong> <?=$linha['qtde'] ?> <a href="../../php/aumentar_user.php?cod=<?=$linha['cod']?>&?qtde=<?=$linha['qtde']?>" style="font-size: 17px; color: black;">+</a>  &nbsp &nbsp &nbsp &nbsp &nbsp <strong>Total: </strong> R$<?=number_format($linha['total'], 2, ',', '.')?> <br> <strong>Descrição: </strong> <?=$linha['descricao']?> <br> <strong>Cadastrado em: </strong> <?=$linha['created']?></p>
                  
        <?php
		    // finaliza o loop que vai mostrar os dados
            echo"<a id='butao' href='../../php/deletar_produto.php?cod=".$linha['cod']."'><button type='submit'><strong>DELETAR PRODUTO</strong></button></a></div>";
		        }while($linha = mysqli_fetch_assoc($dados));
	        // fim do if
	        }
        ?>
    </main>
    
</body>
</html>
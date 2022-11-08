<?php
include("../../php/verifica_login.php");
include("../../php/conexao.php");

$query = "SELECT cod, nome, preco, qtde, total, descricao, usuario, created FROM produtos";
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
    <link rel="stylesheet" href="../../style/produtos.css" type="text/css">
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

                <div class="content" style="width: 330px;">
			        <p><strong>Código: </strong> <?=$linha['cod']?> <br><strong>Nome: </strong><?=$linha['nome']?> <br> <strong>Preço: </strong> R$<?=number_format($linha['preco'], 2, ',', '.')?> <br> <strong>Qtde em estoque: </strong> <?=$linha['qtde'] ?> <a href="../../php/aumentar.php?cod=<?=$linha['cod']?>&?qtde=<?=$linha['qtde']?>" style="font-size: 17px; color: black;">+</a> &nbsp &nbsp &nbsp &nbsp &nbsp <strong>Total: </strong> R$<?=number_format($linha['total'], 2, ',', '.')?> <br> <strong>Cadastrado por: </strong> <?=$linha['usuario']?> <br> <strong>Cadastrado em: </strong> <?=$linha['created']?></p>
                  
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
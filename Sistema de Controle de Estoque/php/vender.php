<?php
session_start();
include("conexao.php");

$cpf_user = $_SESSION['cpf'];
$prod = filter_input(INPUT_POST, 'produto', FILTER_SANITIZE_STRING);
$qtde = filter_input(INPUT_POST, 'qtde_vend', FILTER_SANITIZE_NUMBER_INT);

$query_nome = "SELECT nome FROM admin WHERE cpf='$cpf_user'";
$query_nomeUser = "SELECT nome FROM usuarios WHERE cpf='$cpf_user'";

$result_nome = mysqli_query($conn, $query_nome);
$result_nomeUser = mysqli_query($conn, $query_nomeUser);

$row_admin = mysqli_num_rows($result_nome);
$row_user = mysqli_num_rows($result_nomeUser);

$query_preco = "SELECT preco FROM produtos WHERE nome='$prod'";
$result_preco = mysqli_query($conn, $query_preco);
    while($row = $result_preco->fetch_array()) {
     $getPreco = $row['preco'];
    }

$total_vend = $getPreco * $qtde;

$query_del = "SELECT qtde, total, cod FROM produtos WHERE nome='$prod'";
$result_del = mysqli_query($conn, $query_del);
while($row = $result_del->fetch_array()) {
        $qtde_del = $row['qtde'];
        $total_del = $row['total'];
        $cod_del = $row['cod'];
}

$qtde_final = $qtde_del-$qtde;
$total_final = $total_del-$total_vend;

if ($qtde_final > 0) {

$update = "UPDATE produtos SET qtde='$qtde_final', total='$total_final' WHERE cod='$cod_del'";
$update_result = mysqli_query($conn, $update);

if ($row_admin == 1) {
    while($row = $result_nome->fetch_array()) {
        $user = $row['nome'];
    }
    $query = "INSERT INTO vendas (nome_produto,	preco_produto, qtde_vendida, valor_total, vendedor_adm, created) VALUES ('$prod', '$getPreco', '$qtde', '$total_vend', '$user', NOW())";
    $result = mysqli_query($conn, $query);
    echo"<script language='javascript' type='text/javascript'>
          alert('Venda cadastrada com sucesso!');window.location
          .href='../pages/admin/vendas.php'</script>";

} elseif ($row_user == 1) {
    while($row = $result_nomeUser->fetch_array()) {
        $user = $row['nome'];
    }
    $query = "INSERT INTO vendas (nome_produto,	preco_produto, qtde_vendida, valor_total, vendedor, created) VALUES ('$prod', '$getPreco', '$qtde', '$total_vend', '$user', NOW())";
    $result = mysqli_query($conn, $query);
    echo"<script language='javascript' type='text/javascript'>
          alert('Venda cadastrada com sucesso!');window.location
          .href='../pages/user/vendas_user.php'</script>";
}

} elseif ($qtde_final == 0) {
    $del = "DELETE FROM produtos WHERE cod='$cod_del'";
    $result = mysqli_query($conn, $del);

    if ($row_admin == 1) {
    while($row = $result_nome->fetch_array()) {
        $user = $row['nome'];
    }
    $query = "INSERT INTO vendas (nome_produto,	preco_produto, qtde_vendida, valor_total, vendedor_adm, created) VALUES ('$prod', '$getPreco', '$qtde', '$total_vend', '$user', NOW())";
    $result = mysqli_query($conn, $query);
    echo"<script language='javascript' type='text/javascript'>
          alert('Venda cadastrada com sucesso!');window.location
          .href='../pages/admin/vendas.php'</script>";

    } elseif ($row_user == 1) {
    while($row = $result_nomeUser->fetch_array()) {
        $user = $row['nome'];
    }
    $query = "INSERT INTO vendas (nome_produto,	preco_produto, qtde_vendida, valor_total, vendedor, created) VALUES ('$prod', '$getPreco', '$qtde', '$total_vend', '$user', NOW())";
    $result = mysqli_query($conn, $query);
    echo"<script language='javascript' type='text/javascript'>
          alert('Venda registrada com sucesso!');window.location
          .href='../pages/admin/vendas_user.php'</script>";
}

} elseif ($qtde_final < 0) {
    if ($row_user == 1) {
        echo"<script language='javascript' type='text/javascript'>
        alert('Quantidade utrapassou a do estoque!');window.location
        .href='../pages/admin/vendas_user.php'</script>";
        
    } elseif ($row_admin == 1) {

        echo"<script language='javascript' type='text/javascript'>
          alert('Quantidade utrapassou a do estoque!');window.location
          .href='../pages/admin/vendas.php'</script>";
    }
}
    

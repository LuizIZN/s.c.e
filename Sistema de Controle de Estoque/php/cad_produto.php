<?php

session_start();
include("conexao.php");


$nome = filter_input(INPUT_POST, 'nome', 513);
$preco = filter_input(INPUT_POST, 'preco', FILTER_SANITIZE_STRING);
$qtde = filter_input(INPUT_POST, 'qtde', FILTER_SANITIZE_NUMBER_INT);
$tipo = filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_STRING);
$descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);
$cpf = $_SESSION['cpf'];
$user_q = "SELECT nome FROM admin WHERE cpf = '{$cpf}'";
$result = mysqli_query($conn, $user_q); 
    while($row = $result->fetch_array()) {
     $user = $row['nome'];
    }

$valor = floatval($preco);
$total = $valor * $qtde;

$query = "INSERT INTO produtos (nome, preco, qtde, total, tipo, descricao, usuario, created) VALUES ('$nome', '$valor', '$qtde', '$total', '$tipo', '$descricao', '$user', NOW())";
$result = mysqli_query($conn, $query);

if (mysqli_insert_id($conn)) {
    # code...
    echo"<script language='javascript' type='text/javascript'>
    alert('Produto cadastrado com sucesso!');window.location.
    href='../pages/admin/cad_prod.php'</script>";
} else {
    echo"<script language='javascript' type='text/javascript'>
    alert('Produto não cadastrado!');window.location.
    href='../pages/admin/cad_prod.php'</script>";
}

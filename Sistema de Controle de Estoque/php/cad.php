<?php

include_once("conexao.php");
include("valida_cpf.php");

$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
$cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_STRING);
$celular = filter_input(INPUT_POST, 'celular', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

$query = "SELECT cpf FROM usuarios WHERE cpf = '$cpf'";
$result3 = mysqli_query($conn, $query);

$row = mysqli_num_rows($result3);

if ($row == 1) {
    echo"<script language='javascript' type='text/javascript'>
          alert('Usuário já cadastrado!');window.location
          .href='../pages/cadastro.php'</script>";
} else {

if (validaCPF($cpf) == true) {
    # code...


$result = "SELECT cpfU from cpf_user where cpfU = '$cpf'";
$resultado = mysqli_query($conn, $result);

$row = mysqli_num_rows($resultado);

if ($row == 1) {
    # code...

$result2 = "INSERT INTO usuarios (nome, cpf, celular, email, senha, created) VALUES ('$nome', '$cpf', '$celular', '$email', '$senha', NOW())";
$resultado2 = mysqli_query($conn, $result2);

if (mysqli_insert_id($conn)) {
    # code...
    echo"<script language='javascript' type='text/javascript'>
    alert('Usuário cadastrado com sucesso!');window.location.
    href='../pages/index.php'</script>";
} else {
    echo"<script language='javascript' type='text/javascript'>
          alert('Não foi possível cadastrar esse usuário!');window.location
          .href='../pages/cadastro.php'</script>";
}
} else {
    echo"<script language='javascript' type='text/javascript'>
          alert('Funcionário não encontrado!');window.location
          .href='../pages/cadastro.php'</script>";
}

} else {
    echo"<script language='javascript' type='text/javascript'>
          alert('CPF inválido!');window.location
          .href='../pages/cadastro.php'</script>";
}
}
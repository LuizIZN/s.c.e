<?php

include_once("conexao.php");
include("valida_cpf.php");

$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
$cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_STRING);
$celular = filter_input(INPUT_POST, 'celular', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

if (validaCPF($cpf) == true) {
    # code...

$result2 = "INSERT INTO admin (nome, cpf, celular, email, senha, created) VALUES ('$nome', '$cpf', '$celular', '$email', '$senha', NOW())";
$resultado2 = mysqli_query($conn, $result2);

if (mysqli_insert_id($conn)) {
    # code...
    echo"<script language='javascript' type='text/javascript'>
    alert('Administrador cadastrado com sucesso!');window.location.
    href='../pages/admin/cad_admin.php'</script>";
} else {
    echo"<script language='javascript' type='text/javascript'>
          alert('Não foi possível cadastrar!');window.location
          .href='../pages/admin/cad_admin.php'</script>";
}
} else {
    echo"<script language='javascript' type='text/javascript'>
          alert('CPF inválido!');window.location
          .href='../pages/admin/cad_admin.php'</script>";
}
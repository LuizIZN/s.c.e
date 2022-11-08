<?php

session_start();
include("conexao.php");
include("valida_cpf.php");

$cpfU = filter_input(INPUT_POST, 'cpfU', FILTER_SANITIZE_STRING);

if (validaCPF($cpfU) == true) {
    # code...
    $query = "INSERT INTO cpf_user (cpfU) VALUES ('$cpfU')";
    $result = mysqli_query($conn, $query);

    
    echo"<script language='javascript' type='text/javascript'>
    alert('Funcionário cadastrado com sucesso!');window.location.
    href='../pages/admin/cad_usuario'</script>";
} else {
    echo"<script language='javascript' type='text/javascript'>
          alert('CPF inválido!');window.location
          .href='../pages/admin/cad_usuario.php'</script>";
}



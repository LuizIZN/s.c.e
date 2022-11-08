<?php 
session_start();
include("conexao.php");
include("valida_cpf.php");

if((empty($_POST['cpf'])) || empty($_POST['senha'])) {
    header('Location: ../pages/index.php');
    exit();
}
$cpf = $_POST['cpf'];
$senha = $_POST['senha'];

if (validaCPF($cpf) == true) {
    # code...
    $query = "SELECT cpf, senha FROM admin WHERE cpf = '$cpf' and senha = '$senha'";
    $result = mysqli_query($conn, $query);

    $query2 = "SELECT cpf, senha FROM usuarios WHERE cpf = '$cpf' and senha = '$senha'";
    $result2 = mysqli_query($conn, $query2);

    $row = mysqli_num_rows($result);
    $row2 = mysqli_num_rows($result2);

    if ($row == 1) {
        $_SESSION['cpf'] = $cpf; 
        echo"<script language='javascript' type='text/javascript'>
          alert('Entrando no sistema...');window.location
          .href='../pages/admin/home_admin.php'</script>";
    } else if ($row2 == 1){
        $_SESSION['cpf'] = $cpf;
        echo"<script language='javascript' type='text/javascript'>
          alert('Entrando no sistema...');window.location
          .href='../pages/user/home_user.php'</script>";
    } else {
        echo"<script language='javascript' type='text/javascript'>
          alert('Usuário não encontrado!');window.location
          .href='../pages/index.php'</script>";
    }
} else {
    echo"<script language='javascript' type='text/javascript'>
          alert('CPF inválido e/ou senha incorreta!');window.location
          .href='../pages/index.php'</script>";
}


?>
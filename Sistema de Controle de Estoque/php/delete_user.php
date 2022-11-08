<?php

session_start();
include("conexao.php");

$cpf = filter_input(INPUT_GET, 'cpf', FILTER_SANITIZE_NUMBER_INT);

$del = "DELETE FROM usuarios WHERE cpf='$cpf'";
$result = mysqli_query($conn, $del);
$del2 = "DELETE FROM cpf_user WHERE cpfU='$cpf'";
$result2 = mysqli_query($conn, $del2);

header("Location: ../pages/admin/gerenciar_user.php");

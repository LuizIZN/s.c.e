<?php

session_start();
include("conexao.php");

$cpf = filter_input(INPUT_GET, 'cpf', FILTER_SANITIZE_NUMBER_INT);

$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$cel = filter_input(INPUT_POST, 'celular', FILTER_SANITIZE_NUMBER_INT);

if (($email!='') and ($cel!='')) {
    $alt = "UPDATE usuarios SET email='$email', celular='$cel', modified=NOW() WHERE cpf='$cpf'";
    $result = mysqli_query($conn, $alt);
    $row = mysqli_fetch_assoc($result);
} elseif (($email=='') and ($cel!='')) {
    $alt = "UPDATE usuarios SET celular='$cel', modified=NOW() WHERE cpf='$cpf'";
    $result = mysqli_query($conn, $alt);
    $row = mysqli_fetch_assoc($result);
} elseif (($email!='') and ($cel=='')) {
    $alt = "UPDATE usuarios SET email='$email', modified=NOW() WHERE cpf='$cpf'";
    $result = mysqli_query($conn, $alt);
    $row = mysqli_fetch_assoc($result);
}


header("Location: ../pages/admin/gerenciar_user.php");
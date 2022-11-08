<?php

session_start();
include("conexao.php");

$cod = filter_input(INPUT_GET, 'cod', FILTER_SANITIZE_NUMBER_INT);
$qtde = filter_input(INPUT_GET, 'qtde', FILTER_SANITIZE_NUMBER_INT);

$alt = "UPDATE produtos SET qtde=qtde+1, modified=NOW() WHERE cod='$cod'";
$alt2 = "UPDATE produtos SET total=total+preco WHERE cod='$cod'";
$result = mysqli_query($conn, $alt);
$row = mysqli_fetch_assoc($result);
$result2 = mysqli_query($conn, $alt2);
$row2 = mysqli_fetch_assoc($result2);

header("Location: ../pages/user/produtos_user.php");
<?php

session_start();
include("conexao.php");

$cod = filter_input(INPUT_GET, 'cod', FILTER_SANITIZE_NUMBER_INT);

$del = "DELETE FROM produtos WHERE cod='$cod'";
$result = mysqli_query($conn, $del);

header("Location: ../pages/admin/produtos.php");

<?php

$servername = "localhost";
$userdb = "root";
$senha = "";
$dbname = "controle_de_estoque";

$conn = mysqli_connect($servername, $userdb, $senha, $dbname);

mysqli_set_charset($conn, 'utf8');


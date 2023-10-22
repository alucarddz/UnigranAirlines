<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "passagens_aereas";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifique a conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}
?>
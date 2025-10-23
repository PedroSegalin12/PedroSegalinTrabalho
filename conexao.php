<?php
$servername = "sql102.byetcluster.com"; // Servidor MySQL
$username = "if0_40232507";              // Seu nome de usuário do banco
$password = "PedroSega2002";   // A senha que você criou no InfinityFree
$database = "if0_40232507_landing_page";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
  die("Falha na conexão: " . $conn->connect_error);
}

// echo "Conectado com sucesso!"; // pode ativar pra testar
?>

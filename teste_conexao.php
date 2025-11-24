<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
$host = 'sql102.byetcluster.com';
$dbname = 'if0_40232507_landing_page';
$user = 'if0_40232507';
$pass = 'PedroSega2002';

echo "Tentando conectar ao banco de dados...<br>";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    echo "<h1>✅ Conexão Bem-Sucedida!</h1>";

} catch (PDOException $e) {
    die("<h1>❌ ERRO CRÍTICO NA CONEXÃO:</h1><p>" . $e->getMessage() . "</p><p>Verifique o Host, Usuário, Senha e se o banco 'if0_40232507_landing_page' existe.</p>");
}
?>
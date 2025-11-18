<?php
// ATIVA EXIBIÇÃO MÁXIMA DE ERROS PARA FORÇAR A MENSAGEM
ini_set('display_errors', 1);
error_reporting(E_ALL);

// SUAS CREDENCIAIS DO CONFIG.PHP
$host = 'sql102.byetcluster.com';
$dbname = 'if0_40232507_landing_page';
$user = 'if0_40232507';
$pass = 'PedroSega2002'; // MUITA ATENÇÃO A ESSA SENHA!

echo "Tentando conectar ao banco de dados...<br>";

try {
    // ESTA É A LINHA QUE PROVAVELMENTE ESTÁ FALHANDO
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    echo "<h1>✅ Conexão Bem-Sucedida!</h1>";

} catch (PDOException $e) {
    // SE FALHAR, ESTE BLOCO VAI MOSTRAR A MENSAGEM REAL DO PDO
    die("<h1>❌ ERRO CRÍTICO NA CONEXÃO:</h1><p>" . $e->getMessage() . "</p><p>Verifique o Host, Usuário, Senha e se o banco 'if0_40232507_landing_page' existe.</p>");
}
?>
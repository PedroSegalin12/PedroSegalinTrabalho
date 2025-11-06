<?php
require_once 'config.php';

$sql_insert = "INSERT INTO mensagens (nome, email, mensagem, data_envio) VALUES (:nome, :email, :mensagem, NOW())";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $mensagem = $_POST['mensagem'] ?? '';

    if ($nome && $email && $mensagem) {
        
        try {
            $conexaoObj = new Conexao(); 
            $conn = $conexaoObj->conectar(); 

            $stmt = $conn->prepare($sql_insert);
            
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':mensagem', $mensagem);
            
            if ($stmt->execute()) {
                echo "<h2>Mensagem enviada com sucesso!</h2>";
                echo "<p>Os dados foram salvos no banco de dados.</p>";
                echo "<p><strong>Nome:</strong> " . htmlspecialchars($nome) . "</p>";
                echo "<p><strong>E-mail:</strong> " . htmlspecialchars($email) . "</p>";
                echo "<p><strong>Mensagem:</strong> " . nl2br(htmlspecialchars($mensagem)) . "</p>";
            } else {
                echo "<h2>Erro ao salvar no Banco de Dados!</h2>";
                echo "<p>Detalhes do Erro: " . $stmt->errorInfo()[2] . "</p>"; 
            }
            
            $stmt->closeCursor(); 

        } catch (\PDOException $e) {
            die("Falha Crítica na Conexão/PDO (Verifique o config.php): " . $e->getMessage());
        }

    } else {
        echo "<h2>Preencha todos os campos!</h2>";
    }
} else {
    echo "Método inválido!";
}
?>
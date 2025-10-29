<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $mensagem = $_POST['mensagem'] ?? '';

    if ($nome && $email && $mensagem) {
        echo "<h2>Mensagem enviada com sucesso!</h2>";
        echo "<p><strong>Nome:</strong> " . htmlspecialchars($nome) . "</p>";
        echo "<p><strong>E-mail:</strong> " . htmlspecialchars($email) . "</p>";
        echo "<p><strong>Mensagem:</strong> " . nl2br(htmlspecialchars($mensagem)) . "</p>";
    } else {
        echo "Preencha todos os campos!";
    }
} else {
    echo "Método inválido!"; // importante para testar no navegador
}
?>

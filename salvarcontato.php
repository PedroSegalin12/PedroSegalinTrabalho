<?php

require_once 'config.php';


header('Content-Type: application/json');


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método não permitido.']);
    exit;
}


try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8",
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC 
        ]
    );
} catch (PDOException $e) {

    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Erro de conexão com o banco de dados.']);
    exit;
}


$nome = trim($_POST['nome'] ?? '');
$email = trim($_POST['email'] ?? '');
$mensagem = trim($_POST['mensagem'] ?? '');


$assunto = 'Contato via Landing Page - Advogado'; 

if (empty($nome) || empty($email) || empty($mensagem)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Nome, E-mail e Mensagem são obrigatórios.']);
    exit;
}

$sql = "INSERT INTO mensagens (nome, email, assunto, mensagem) VALUES (:nome, :email, :assunto, :mensagem)";

try {
    $stmt = $pdo->prepare($sql);
    

    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':assunto', $assunto);
    $stmt->bindParam(':mensagem', $mensagem);

    if ($stmt->execute()) {

        http_response_code(200);
        echo json_encode(['success' => true, 'message' => 'Mensagem enviada com sucesso e salva no banco!']);
    } else {

        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Erro ao salvar o contato no banco de dados.']);
    }
} catch (PDOException $e) {

    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Erro no SQL: ' . $e->getMessage()]);
}

$pdo = null;
?>
<?php
require_once 'config.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: admin.php");
    exit;
}

$id_contato = (int)$_GET['id'];

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8",
        DB_USER,
        DB_PASS,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    die("Erro de Conexão: " . $e->getMessage());
}

$sql = "DELETE FROM mensagens WHERE id = :id";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id_contato, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        header("Location: admin.php?status=deleted");
    } else {
        header("Location: admin.php?status=error_delete");
    }
} catch (PDOException $e) {
    header("Location: admin.php?status=error_sql");
}

$pdo = null;
exit;
?>
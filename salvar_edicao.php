<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once "funcoes_admin.php";
protegerPagina();

require_once "config.php";
require_once "usuarioModel.php";

$id = $_POST['id'] ?? null;
$nome = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';
$mensagem = $_POST['mensagem'] ?? '';

if (empty($id) || empty($nome) || empty($email) || empty($mensagem)) {
    header("Location: admin_painel.php?status=error_empty");
    exit();
}

try {
    $conexao = new Conexao();
    $usuarioModel = new UsuarioModel($conexao);
    if ($usuarioModel->atualizar($id, $nome, $email, $mensagem)) {
        header("Location: admin_painel.php?status=success_update");
    } else {
        header("Location: admin_painel.php?status=error_update");
    }
} catch (Exception $e) {
    die("Erro ao salvar edição: " . $e->getMessage());
}
exit();
?>
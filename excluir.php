<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once "funcoes_admin.php";
protegerPagina();

require_once "config.php";
require_once "usuarioModel.php";

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: admin_painel.php?status=error_id");
    exit();
}

try {
    $conexao = new Conexao();
    $usuarioModel = new UsuarioModel($conexao);
    if ($usuarioModel->deletar($id)) {
        header("Location: admin_painel.php?status=success_delete");
    } else {
        header("Location: admin_painel.php?status=error_delete");
    }
} catch (Exception $e) {
    die("Erro ao excluir registro: " . $e->getMessage());
}
exit();
?>
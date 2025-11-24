<?php
session_start();

require_once "config.php";
require_once "usuarioModel.php";

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

if (empty($email) || empty($senha)) {
    header("Location: admin_login.php?erro=1");
    exit();
}

$conexao = new Conexao();
$usuarioModel = new UsuarioModel($conexao);

$usuario = $usuarioModel->verificarAdmin($email, $senha);

if ($usuario) {
    $_SESSION['admin_logado'] = $usuario['id'];
    header("Location: admin_painel.php");
} else {

    header("Location: admin_login.php?erro=1");
}
exit();
?>
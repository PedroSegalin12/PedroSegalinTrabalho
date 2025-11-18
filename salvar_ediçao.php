<?php
require_once "config.php";
require_once "usuarioModel.php";

$id = $_POST['id'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$mensagem = $_POST['mensagem']; // Assumindo que você está atualizando a mensagem também

$conexao = new Conexao();
$usuarioModel = new UsuarioModel($conexao);

// OBS: Certifique-se de que o método 'atualizar' em usuarioModel.php aceita $mensagem
if ($usuarioModel->atualizar($id, $nome, $email, $mensagem)) {
    header("Location: listar.php?status=success_update");
} else {
    header("Location: listar.php?status=error_update");
}
exit();
?>
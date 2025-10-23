<?php
include('conexao.php');

$id = $_GET['id'];
$sql = "DELETE FROM mensagens WHERE id=$id";

if ($conn->query($sql) === TRUE) {
  echo "<script>alert('Mensagem excluída com sucesso!'); window.location.href='listar.php';</script>";
} else {
  echo "Erro ao excluir: " . $conn->error;
}
?>

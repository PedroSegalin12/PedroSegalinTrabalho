<?php
include('conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $assunto = $_POST['assunto'];
  $mensagem = $_POST['mensagem'];

  $sql = "INSERT INTO mensagens (nome, email, assunto, mensagem, data_envio)
          VALUES ('$nome', '$email', '$assunto', '$mensagem', NOW())";

  if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Mensagem enviada com sucesso!'); window.location.href='index.php';</script>";
  } else {
    echo "Erro ao enviar: " . $conn->error;
  }

  $conn->close();
}
?>

<?php
include('conexao.php');

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM mensagens WHERE id=$id");
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $assunto = $_POST['assunto'];
  $mensagem = $_POST['mensagem'];

  $sql = "UPDATE mensagens SET nome='$nome', email='$email', assunto='$assunto', mensagem='$mensagem' WHERE id=$id";

  if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Mensagem atualizada!'); window.location.href='listar.php';</script>";
  } else {
    echo "Erro ao atualizar: " . $conn->error;
  }
}
?>

<form method="POST">
  <input type="text" name="nome" value="<?= $row['nome'] ?>" required>
  <input type="email" name="email" value="<?= $row['email'] ?>" required>
  <input type="text" name="assunto" value="<?= $row['assunto'] ?>">
  <textarea name="mensagem" required><?= $row['mensagem'] ?></textarea>
  <button type="submit">Salvar</button>
</form>

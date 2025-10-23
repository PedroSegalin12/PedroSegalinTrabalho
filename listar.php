<?php
include('conexao.php');
$result = $conn->query("SELECT * FROM mensagens ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Mensagens Recebidas</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <h2>Mensagens Recebidas</h2>
  <table border="1" cellspacing="0" cellpadding="8">
    <tr>
      <th>ID</th>
      <th>Nome</th>
      <th>Email</th>
      <th>Assunto</th>
      <th>Mensagem</th>
      <th>Data</th>
      <th>Ações</th>
    </tr>

    <?php while ($row = $result->fetch_assoc()) { ?>
      <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['nome'] ?></td>
        <td><?= $row['email'] ?></td>
        <td><?= $row['assunto'] ?></td>
        <td><?= $row['mensagem'] ?></td>
        <td><?= $row['data_envio'] ?></td>
        <td>
          <a href="editar.php?id=<?= $row['id'] ?>">Editar</a> |
          <a href="excluir.php?id=<?= $row['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
        </td>
      </tr>
    <?php } ?>
  </table>
</body>
</html>

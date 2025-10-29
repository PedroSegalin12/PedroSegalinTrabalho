<?php
require_once 'config.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: admin.php?status=no_id");
    exit;
}

$id_contato = (int)$_GET['id'];
$mensagem = []; 


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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $assunto = trim($_POST['assunto'] ?? '');
    $texto_mensagem = trim($_POST['mensagem'] ?? '');

    if (empty($nome) || empty($email) || empty($assunto) || empty($texto_mensagem)) {
        $erro = "Todos os campos são obrigatórios.";
    } else {
        $sql_update = "UPDATE mensagens SET nome = :nome, email = :email, assunto = :assunto, mensagem = :mensagem WHERE id = :id";
        
        try {
            $stmt_update = $pdo->prepare($sql_update);
            $stmt_update->bindParam(':nome', $nome);
            $stmt_update->bindParam(':email', $email);
            $stmt_update->bindParam(':assunto', $assunto);
            $stmt_update->bindParam(':mensagem', $texto_mensagem);
            $stmt_update->bindParam(':id', $id_contato, PDO::PARAM_INT);

            if ($stmt_update->execute()) {
                header("Location: admin.php?status=updated");
                exit;
            } else {
                $erro = "Erro ao atualizar o contato no banco.";
            }
        } catch (PDOException $e) {
            $erro = "Erro SQL: " . $e->getMessage();
        }
    }
}


$sql_select = "SELECT id, nome, email, assunto, mensagem, data_envio FROM mensagens WHERE id = :id";
$stmt_select = $pdo->prepare($sql_select);
$stmt_select->bindParam(':id', $id_contato, PDO::PARAM_INT);
$stmt_select->execute();
$mensagem = $stmt_select->fetch();

if (!$mensagem) {
    header("Location: admin.php?status=not_found");
    exit;
}

$pdo = null;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Mensagem #<?php echo $mensagem['id']; ?></title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1 { color: #333; }
        form { background: #f9f9f9; padding: 20px; border-radius: 5px; max-width: 600px; margin-top: 20px; }
        label { display: block; margin-top: 10px; font-weight: bold; }
        input[type="text"], input[type="email"], textarea { width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { background-color: #4CAF50; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; margin-top: 15px; }
        .erro { color: red; margin-bottom: 10px; }
        .voltar { margin-top: 20px; display: inline-block; color: #007bff; text-decoration: none; }
    </style>
</head>
<body>

<h1>Editar Mensagem #<?php echo htmlspecialchars($mensagem['id']); ?></h1>

<?php if (isset($erro)): ?>
    <p class="erro"><?php echo htmlspecialchars($erro); ?></p>
<?php endif; ?>

<form method="POST" action="editar_contato.php?id=<?php echo $mensagem['id']; ?>">
    
    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($mensagem['nome']); ?>" required>

    <label for="email">E-mail:</label>
    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($mensagem['email']); ?>" required>

    <label for="assunto">Assunto:</label>
    <input type="text" id="assunto" name="assunto" value="<?php echo htmlspecialchars($mensagem['assunto']); ?>" required>

    <label for="mensagem">Mensagem:</label>
    <textarea id="mensagem" name="mensagem" rows="6" required><?php echo htmlspecialchars($mensagem['mensagem']); ?></textarea>
    
    <p>Data de Envio Original: <?php echo date('d/m/Y H:i', strtotime($mensagem['data_envio'])); ?></p>

    <button type="submit">Salvar Alterações</button>
</form>

<a href="admin.php" class="voltar">← Voltar para o Painel</a>

</body>
</html>
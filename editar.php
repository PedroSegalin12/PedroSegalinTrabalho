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
    $registro = $usuarioModel->buscarPorId($id); 

    if (!$registro) {
        header("Location: admin_painel.php?status=error_not_found");
        exit();
    }
} catch (Exception $e) {
    die("Erro ao carregar registro: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Registro</title>
    <link rel="stylesheet" href="styleeditar.css">
    </head>
<body>
    <div class="container-principal">
        <div class="titulo-e-link">
            <h2 class="titulo-editar">Editar Registro</h2>

        </div> 

        <form method="POST" action="salvar_edicao.php">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($registro['id']); ?>">
            
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($registro['nome']); ?>" required>

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($registro['email']); ?>" required>
            
            <label for="mensagem">Mensagem:</label>
            <textarea id="mensagem" name="mensagem" rows="4" required><?php echo htmlspecialchars($registro['mensagem']); ?></textarea>

            <button type="submit">Salvar Alterações</button>
                        <a href="admin_painel.php" class="link-voltar">Voltar</a>
        </form>
    </div>
</body>
</html>
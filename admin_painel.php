<?php
require_once "funcoes_admin.php";
protegerPagina();

require_once "config.php";
require_once "usuarioModel.php";

$conexao = new Conexao();
$usuarioModel = new UsuarioModel($conexao);
$registros = $usuarioModel->listar(); 
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel Administrativo | Registros</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="admin-container"> 
        
        <h2>Lista de Clientes</h2>
        
        <div class="admin-actions">
            <a href="index.php" class="btn">Cadastrar Novo Cliente</a> 
            
            <p>
                <a href="logout.php">Sair (Logout)</a>
            </p>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Mensagem</th> 
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($registros as $registro): ?>
                <tr>
                    <td><?php echo htmlspecialchars($registro['id']); ?></td>
                    <td><?php echo htmlspecialchars($registro['nome']); ?></td>
                    <td><?php echo htmlspecialchars($registro['email']); ?></td>
                    <td><?php echo nl2br(htmlspecialchars(substr($registro['mensagem'], 0, 80))); ?>...</td> 
                    <td>
                        <a href="editar.php?id=<?php echo $registro['id']; ?>">Editar</a> 
                        <a href="excluir.php?id=<?php echo $registro['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir este registro?');">Excluir</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <p style="margin-top: 15px;">
            <?php echo count($registros); ?> clientes encontrados!
        </p>

    </div> 
</body>
</html>
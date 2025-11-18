<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Acesso Administrativo</title>
    <link rel="stylesheet" href="styleadmin.css">
</head>
<body>

    <div class="login-container">

        <h2>Acesso ao Painel Admin</h2>

        <?php if (isset($_GET['erro'])): ?>
            <p class="erro-login">E-mail ou senha incorretos.</p>
        <?php endif; ?>

        <form method="POST" action="processa_login.php">

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>

            <button type="submit">Entrar</button>
        </form>

    </div>

</body>
</html>

<body>

<h1>Painel de Gerenciamento de Mensagens</h1>

<?php
if (isset($_GET['status'])) {
    $status = htmlspecialchars($_GET['status']);
    $message = '';
    $class = 'sucesso';
    
    switch ($status) {
        case 'deleted':
            $message = '✅ Mensagem excluída com sucesso!';
            break;
        case 'updated':
            $message = '✅ Mensagem atualizada com sucesso!';
            break;
        case 'not_found':
        case 'error_delete':
        case 'error_sql':
            $message = '❌ Ocorreu um erro na operação. Tente novamente.';
            $class = 'erro';
            break;
        default:
            $message = '';
    }
    
    if ($message) {
        echo "<div class='alerta {$class}'>{$message}</div>";
    }
}
?>

<p>Total de Mensagens: <?php echo count($mensagens); ?></p>
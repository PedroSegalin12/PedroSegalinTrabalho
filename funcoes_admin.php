<?php
// Coloque esta função em um novo arquivo funcoes_admin.php
function protegerPagina() {
    session_start();
    if (!isset($_SESSION['admin_logado'])) {
        header("Location: admin_login.php");
        exit();
    }
}
?>
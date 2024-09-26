<?php
session_start();  // Iniciar a sessão uma única vez para todas as páginas que incluem o header

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    // Se não estiver logado, redireciona para a página de login
    header("Location: ../login/login.html");
    exit();
}
?>

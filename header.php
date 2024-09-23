<?php
// Iniciar sessão apenas uma vez
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    // Se não estiver logado, redireciona para a página de login
    header("Location: ../login/login.html");
    exit();
}
?>

<?php
date_default_timezone_set('America/Sao_Paulo');
session_start();  // Iniciar a sessão

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    // Se não estiver logado, redireciona para a página de login
    header("Location: login/login.html");
    exit();
}

// Verifica se a variável $acesso foi definida na página que incluiu este header
if (isset($acesso)) {
    // Pega o nível de acesso do usuário logado
    $nivel_usuario = $_SESSION['usuario']['acesso_nivel'];

    // Compara o nível de acesso requerido com o do usuário logado
    if ($nivel_usuario < $acesso) {
        // Se o nível de acesso do usuário for insuficiente, redireciona para a página 404
        header("Location: ../404.html");
        exit();
    }
}
?>

<?php
function criarSessao($usuario) {
    session_start();                     // Inicia a sessão
    $_SESSION['usuario'] = $usuario;    // Armazena os dados do usuário na sessão
}

function encerrarSessao() {
    session_start(); // Certifica  que a sessão esteja ativa
    // Limpar os dados da sessão
    $_SESSION = array();
    
    // Destruir os cookies de sessão
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    // Destruir a sessão
    session_destroy();
    // Redirecionar para a página de login
    header('Location:../index.php');
    exit();
}

// Verifica se o botão sair do teste teste_sessao foi apertado
if (isset($_POST['acao']) && $_POST['acao'] === 'sair') {
    encerrarSessao();
}
?>

<?php
include 'funcoes_banco.php';
session_start();

// Verifica se o usuário está logado
//if (!isset($_SESSION['usuario'])) {
    // Se não estiver logado, redireciona para a página de login
   // header("Location: ..//html/login.html");
    //exit();}
?>

<h1>Bem-vindo, <?php echo $_SESSION['usuario']; ?>!</h1>

<form action="../php/session.php" method="POST">
    <button type="submit" name="acao" value="sair">Sair</button>
</form>

<?php 
    $sql = "SELECT * FROM pessoa WHERE email = '{$_SESSION['usuario']}'";
    echo $sql;
?>

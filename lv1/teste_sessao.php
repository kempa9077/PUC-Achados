<?php
include '../funcoes_banco.php';
session_start();
print_r($_SESSION);

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    // Se não estiver logado, redireciona para a página de login
    header("Location: login.html");
    exit();}
?>

<h1>Bem-vindo, <?php echo $_SESSION['usuario']['email']; ?>!</h1>

<form action=" ../login/session.php" method="POST">
    <button type="submit" name="acao" value="sair">Sair</button>
</form>

<?php 
    $sql = "SELECT * FROM pessoa WHERE email LIKE '".$_SESSION['usuario']['email']."%'";
    $resultado = consultar_dado($sql);
    
    foreach($resultado as $valor){
        $html = "
        <ul>
            <li>".$valor['cpf']."</li>
            <li>".$valor['email']."</li>
            <li>".$valor['senha']."</li>
            <li>".$valor['nome']."</li>
            <li>".$valor['matricula']."</li>
            <li>".$valor['registro_puc']."</li>
            <li>".$valor['acesso_nivel']."</li>
        </ul>
        ";
        echo $html;
    }
    
    
    
?>

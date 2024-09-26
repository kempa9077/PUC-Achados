<?php
require_once('..//funcoes_banco.php');
include 'session.php'; 

$email = $_POST['email_id'];
$senha = $_POST['senha_id'];

$sql = "SELECT * FROM pessoa WHERE email = '$email'";
$result = consultar_dado($sql);

// Verifica se o usuário existe e se a senha corresponde ao hash armazenado
if (!empty($result)) {
    $hash = $result[0]['senha'];
    
    // Verifica a senha usando hash
    if (password_verify($senha, $hash)) {
        // Cria uma sessão para o usuário logado
        criarSessao($result[0]);
        echo 'success'; 
    } else {
        echo 'fail';  // Senha incorreta
    }
} else {
    echo 'fail';  // Usuário não encontrado
}
?>

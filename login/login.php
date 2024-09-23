<?php
require_once('..//funcoes_banco.php');
include 'session.php'; // Inclui o arquivo de sessões

// Obtém os dados do formulário de login usando as chaves 'email_id' e 'senha_id'
$email = $_POST['email_id'];
$senha = $_POST['senha_id'];

// Consulta SQL para buscar o e-mail
$sql = "SELECT * FROM pessoa WHERE email = '$email'";

// Usa a função consultar_dado para executar a consulta
$result = consultar_dado($sql);

// Verifica se o usuário existe e se a senha corresponde ao hash armazenado
if (!empty($result)) {
    $hash = $result[0]['senha'];
    
    // Verifica a senha usando password_verify
    if (password_verify($senha, $hash)) {
        // Cria uma sessão para o usuário logado
        criarSessao($result[0]); // Armazena o e-mail ou outro dado relevante
        echo 'success';  // Retorna 'success' para indicar que o login foi bem-sucedido
    } else {
        echo 'fail';  // Senha incorreta
    }
} else {
    echo 'fail';  // Usuário não encontrado
}
?>

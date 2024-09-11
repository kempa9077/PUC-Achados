<?php
include 'funcoes_banco.php';
include 'session.php'; // Inclui o arquivo de sessões

// Obtém os dados do formulário de login usando as chaves 'email_id' e 'senha_id'
$email = $_POST['email_id'];
$senha = $_POST['senha_id'];

// Consulta SQL para verificar se o usuário com o e-mail e senha fornecidos existe
$sql = "SELECT * FROM pessoa WHERE email = '$email' AND senha = '$senha'";

// Usa a função consultar_dado para executar a consulta
$result = consultar_dado($sql);

// Verifica se algum resultado foi retornado
if (!empty($result)) {
    // Cria uma sessão para o usuário logado
    criarSessao($result[0]['email']); // Armazena o e-mail ou outro dado relevante

    echo 'success';  // Retorna 'success' para indicar que o login foi bem-sucedido
} else {
    echo 'fail';     // Retorna 'fail' para indicar falha no login
}

?>

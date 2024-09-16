<?php
require_once("funcoes_banco.php"); // Inclui o arquivo que contém a função consultar_dado

// Obtém os dados do formulário de login
$email = $_POST['email'];
$senha = $_POST['senha'];

// Cria uma consulta SQL para verificar se o usuário com o e-mail e senha fornecidos existe
$sql = "SELECT * FROM pessoa WHERE email = '$email' AND senha = '$senha'";

// Usa a função consultar_dado para executar a consulta
$result = consultar_dado($sql);

// Verifica se algum resultado foi retornado
if (!empty($result)) {
    echo 'success';  // Retorna 'success' para indicar que o login foi bem-sucedido
} else {
    echo 'fail';     // Retorna 'fail' para indicar falha no login
}
?>

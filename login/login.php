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

        // Verifica o nível de acesso e redireciona para a página correta
        $acesso_nivel = $result[0]['acesso_nivel'];

        if ($acesso_nivel == 0) {
            echo 'nivel_0'; // Redirecionar para a página de acesso nível 0
        } elseif ($acesso_nivel == 1) {
            echo 'nivel_1'; // Redirecionar para a página de acesso nível 1
        } elseif ($acesso_nivel == 2) {
            echo 'nivel_2'; // Redirecionar para a página de acesso nível 2
        } else {
            echo 'fail'; // Caso o nível de acesso não seja válido
        }
    } else {
        echo 'fail';  // Senha incorreta
    }
} else {
    echo 'fail';  // Credenciais inválidas
}
?>

<?php
include("../funcoes_banco.php");
include("../login/session.php");

if (isset($_GET['senha_excluir'])) {
    session_start();
    
    // Obtém a senha do parâmetro GET
    $senha = $_GET['senha_excluir'];

    // Consulta a tabela 'pessoa' para verificar o usuário
    $sql = "SELECT * FROM pessoa WHERE cpf = '{$_SESSION['usuario']['cpf']}'";
    $result = consultar_dado($sql);

    // Verifica se o usuário existe e se a senha corresponde ao hash armazenado
    if (!empty($result)) {
        $hash = $result[0]['senha'];
        
        // Verifica a senha usando hash
        if (password_verify($senha, $hash)) {
        
            if ($_SESSION['usuario']['acesso_nivel'] > 1) {
                $ERROR = 'Não é possível deletar contas administradoras';
                echo $ERROR;
                header("Location: ../deletar_admin/deletar_admin.html");
            } else {
                $tabela = "pessoa";
                $condicao = "cpf = '{$_SESSION['usuario']['cpf']}'";

                deletar_dado($tabela, $condicao);
                encerrarSessao();
                header("Location: ../index.php");
                exit();
            }
        } else {
            $ERROR = 'Senha Incorreta';
            echo $ERROR;
            header("Location: ../senha_incorreta/senha_incorreta.html");
        }
    } else {
        echo 'Usuário não encontrado';
    }
} else {
    echo 'Credenciais inválidas';
}
?>

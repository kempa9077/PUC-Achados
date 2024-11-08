<?php
include("../funcoes_banco.php");

// Inicia a sessão
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $json = file_get_contents('php://input');
    $post = json_decode($json, true);

    
    if (isset($post['solicitacao']) && $post['solicitacao'] === "adicionar") {
        $email = $post['email'];
        $nome = $post['nome'];
        $cpf = $_SESSION['usuario']['cpf'] ?? null;

        
        if (isset($_SESSION) AND $_SESSION AND $_SESSION['usuario']['acesso_nivel'] > 0){
            $registro = $post['registro'];

            $atributos = "email = '$email', nome = '$nome', registro_puc = '$registro'";

            $tabela = "pessoa";
        
            $condicao = "cpf = '$cpf'";

            atualizar_dado($tabela, $atributos, $condicao);

            $_SESSION['usuario']['email'] = $email;
            $_SESSION['usuario']['nome'] = $nome;
            $_SESSION['usuario']['registro_puc'] = $registro;

        } else{
            $matricula = $post['matricula'];

            $atributos = ($_SESSION['usuario']['matricula'] === "")
            ? "email = '$email', nome = '$nome'" 
            : "email = '$email', nome = '$nome', matricula = '$matricula'";

            $tabela = "pessoa";
        
            $condicao = "cpf = '$cpf'";

            atualizar_dado($tabela, $atributos, $condicao);

            $_SESSION['usuario']['email'] = $email;
            $_SESSION['usuario']['nome'] = $nome;
            $_SESSION['usuario']['matricula'] = $matricula;
        }

            json_return(["sucesso" => "Perfil atualizado com sucesso."]);
    } else {
        json_return(["erro" => "Ação desconhecida."]);
    }
} else {
    json_return(["erro" => "Método HTTP inválido."]);
}

/**
 * Função para retornar resposta JSON e encerrar o script.
 * 
 * @param array $data - Dados para retornar em JSON
 */
function json_return($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}
?>

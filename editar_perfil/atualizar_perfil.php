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
        $matricula = $post['matricula'];
        $cpf = $_SESSION['usuario']['cpf'] ?? null;

        
        if (!$cpf || empty($email) || empty($nome)) {
            json_return(["erro" => "Dados insuficientes para atualizar."]);
            exit;
        }

        
        $tabela = "pessoa";
        if (isset($_SESSION['usuario']['acesso_nivel']) && $_SESSION['usuario']['acesso_nivel'] > 0) {
            $atributos = ($_SESSION['usuario']['registro_puc'] === "") 
                ? "email = '$email', nome = '$nome', registro_puc = null" 
                : "email = '$email', nome = '$nome', registro_puc = '$matricula'";
        } else {
            $atributos = ($_SESSION['usuario']['registro_puc'] === "")
                ? "email = '$email', nome = '$nome', matricula = null" 
                : "email = '$email', nome = '$nome', matricula = '$matricula'";
        }

        
        $condicao = "cpf = '$cpf'";

        
        atualizar_dado($tabela, $atributos, $condicao);

        $_SESSION['usuario']['email'] = $email;
        $_SESSION['usuario']['nome'] = $nome;
        $_SESSION['usuario']['matricula'] = $matricula;

       

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

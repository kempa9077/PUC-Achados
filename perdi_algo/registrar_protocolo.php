<?php
require_once("../funcoes_banco.php");

function inserirObjeto(){
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
        // Recebe o que está vindo por INPUT
        $json = file_get_contents('php://input');
        // Decodifica o JSON em um array associativo
        $post = json_decode($json, true);
    
        // Adição de novo usuário
        if ($post['solicitacao'] == "enviar_objeto") {
            $tabela = "objeto";
            $colunas = "categoria_objeto,encontrado,nome";
            $valores = "'".$_POST['categoria']."','0','".$_POST['nome_item']."'";
            $result = inserir_dado($tabela,$colunas,$valores);
        
            if ($result === "Registro inserido com sucesso") {
                echo "Objeto registrado com sucesso!";
            } else {
                echo "Erro ao registrar Objeto: $result";
            }
        return $result;
    }
}
    
// precisa puxar pelo js ou fazer o $status = $_POST['status'];
// ta inspirado no inset do cadastro, mas sla
function inserirProcotocolo(){
    $objeto = inserirObjeto();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
        // Recebe o que está vindo por INPUT
        $json = file_get_contents('php://input');
        // Decodifica o JSON em um array associativo
        $post = json_decode($json, true);
    
        // Adição de novo usuário
        if ($post['solicitacao'] == "enviar_objeto") {
            $status = '0';
            $data_abertura = date('Y-m-d H:i:s');
            $tabela = "protocolo";
            $colunas = "status,data_abertura,data_perda,pessoa_abertura,local_perda,objeto,descricao";
            
            // Hash da senha usando password_hash()
            $senha_hash = password_hash($post['senha'], PASSWORD_DEFAULT);
            
            $valores = "'.$status.','".$data_abertura."','".$post['data_perda']."
            ','".$post['usuario']['cpf'].",'".$post['local_perda']."','".$objeto."','".$post['descricao']."'";
            $id = inserir_dado($tabela, $colunas, $valores);
            $result = inserir_dado($tabela,$colunas,$valores);
            json_return(["id" => $result]);
        } else {
            json_return(["erro" => "Ação desconhecida"]);
        }
    }
    /*
    $status = $_POST['0'];
    $data_abertura = $_POST['NOW()'];
    $tabela = "protocolo";
    $colunas = "status,data_abertura,data_perda,pessoa_abertura,local_perda,objeto,descricao";
    $valores = "'.$status.','".$data_abertura."','".$post['data_perda']."
                ','".$post['usuario']['cpf'].",'".$post['local_perda']."','".$objeto."','".$post['descricao']."'";

    $result = inserir_dado($tabela,$colunas,$valores);
    
    if ($result === "Registro inserido com sucesso") {
        echo "Protocolo registrado com sucesso!";
    } else {
        echo "Erro ao registrar protocolo: $result";
    }*/
}
// pode ta errado como sempre
if (isset($_GET['acao'])) {
    $acao = $_GET['acao'];

    switch ($acao) {
        case 'buscar':
            inserirProcotocolo();
            break;
        default:
            echo "Ação inválida.";
    }
} else {
    echo "Nenhuma ação especificada.";
}
}
?>
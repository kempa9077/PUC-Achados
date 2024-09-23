<?php
require_once("../funcoes_banco.php");

function inserirObjeto(){
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

// $objeto = LAST_INSERT_ID;

// precisa puxar pelo js ou fazer o $status = $_POST['status'];
// ta inspirado no inset do cadastro, mas sla
function inserirProcotocolo(inserirObjeto()){
    $objeto = LAST_INSERT_ID;
    $status = $_POST['0'];
    $data_abertura = $_POST['NOW()'];
    $tabela = "proto    colo";
    $colunas = "status,data_abertura,data_perda,pessoa_abertura,local_perda,objeto,descricao";
    $valores = "'.$status.','".$data_abertura."','".$post['data_perda']."
                ','".$post['usuario']['cpf'].",'".$post['local_perda']."','".$objeto."','".$post['descricao']."'";

    $result = inserir_dado($tabela,$colunas,$valores);
    
    if ($result === "Registro inserido com sucesso") {
        echo "Protocolo registrado com sucesso!";
    } else {
        echo "Erro ao registrar protocolo: $result";
    }
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
?>
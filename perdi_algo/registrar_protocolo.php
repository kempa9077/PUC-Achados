<?php
require_once("../funcoes_banco.php");


// precisa puxar pelo js ou fazer o $status = $_POST['status'];
// ta inspirado no inset do cadastro, mas sla
function inserirProcotocolo(){
    $tabela = "protocolo";
    $colunas = "status,data_abertura,data_perda,pessoa_abertura,local_perda,objeto,descricao";
    $valores = "'".$post['status']."','".$post['data_abertura']."',
                '".$post['data_perda']."','".$post['usuario']['cpf'].",
                '".$post['local_perda']."','".$post['objeto']."','".$post['descricao']."'";

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
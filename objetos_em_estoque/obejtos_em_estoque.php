<?php
require_once("../funcoes_banco.php"); // Inclui o arquivo de funções de banco de dados

// Função para buscar todos os objetos no estoque
function buscarObjetos() {
    $sql = "SELECT id_objeto, local_bloco, categoria, nome, encontrado FROM objeto";
    $result = consultar_dado($sql);
    echo json_encode($result); // Retorna os dados em formato JSON
}

// Identificar a ação solicitada
if (isset($_GET['acao'])) {
    $acao = $_GET['acao'];

    switch ($acao) {
        case 'buscar':
            buscarObjetos();
            break;
        default:
            echo "Ação inválida.";
    }
} else {
    echo "Nenhuma ação especificada.";
}
?>

<?php
// pagFun_protocolo.php

require_once("../funcoes_banco.php");  // Função de conexão com o banco de dados

function buscar_protocolos_abertos() {
    $sql = "SELECT protocolo.id_protocolo, objeto.nome, objeto.nome AS categoria, protocolo.status, 
                     DATE_FORMAT(protocolo.data_perda, '%d/%m/%Y') AS data_perda, 
                     DATE_FORMAT(protocolo.data_abertura, '%d/%m/%Y') AS data_abertura, 
                     IFNULL(DATE_FORMAT(protocolo.data_fechamento, '%d/%m/%Y'), '-') AS data_fechamento 
              FROM protocolo p
              JOIN objeto o ON protocolo.id_objeto = objeto.id_objeto
              JOIN categoria_objeto c ON categoria_objeto.id_categoria = categoria_objeto.id_categoria";

    $result = consultar_dado($sql);
    echo json_encode($result);

}
// provavelmente ta errado
if (isset($_GET['acao'])) {
    $acao = $_GET['acao'];

    switch ($acao) {
        case 'buscar':
            buscar_protocolos_abertos();
            break;
        default:
            echo "Ação inválida.";
    }
} else {
    echo "Nenhuma ação especificada.";
}
?>

<?php 
require_once("../funcoes_banco.php");  

function buscar_protocolos() {
    $sql = "SELECT 
    protocolo.idprotocolo,
    objeto.nome AS nome_objeto,
    categoria_objeto.categoria AS nome_categoria,
    protocolo.situacao,
    DATE_FORMAT(protocolo.data_abertura, '%d/%m/%Y %H:%i') AS data_abertura, -- Incluindo hora e minutos
    DATE_FORMAT(protocolo.data_perda, '%d/%m/%Y') AS data_perda, -- Incluindo hora e minutos
    IFNULL(DATE_FORMAT(protocolo.data_fechamento, '%d/%m/%Y %H:%i'), '-') AS data_fechamento, -- Incluindo hora e minutos
    protocolo.descricao,
    pessoa_abertura.nome AS nome_pessoa_abertura,
    pessoa_fechado.nome AS nome_pessoa_fechado,
    local.bloco,
    local.sala
    FROM protocolo
    JOIN pessoa AS pessoa_abertura ON protocolo.pessoa_abertura = pessoa_abertura.cpf
    LEFT JOIN pessoa AS pessoa_fechado ON protocolo.pessoa_fechado = pessoa_fechado.cpf
    JOIN local ON protocolo.local_perda = local.id_local
    JOIN objeto ON protocolo.objeto = objeto.id_objeto
    JOIN categoria_objeto ON objeto.categoria_objeto = categoria_objeto.id_tipo";

    $result = consultar_dado($sql);
    echo json_encode($result);
}

if (isset($_GET['acao']) && $_GET['acao'] == 'buscar') {
    buscar_protocolos();
} else {
    echo json_encode(["erro" => "Ação inválida."]);
}
?>

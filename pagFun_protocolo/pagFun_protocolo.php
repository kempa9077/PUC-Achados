<?php
require_once("../funcoes_banco.php");  // Função de conexão com o banco de dados

function buscar_protocolos() {
    $sql = "SELECT 
    -- Informações do protocolo
    protocolo.idprotocolo,
    protocolo.situacao,
    DATE_FORMAT(protocolo.data_abertura, '%d/%m/%Y') AS data_abertura,
    IFNULL(DATE_FORMAT(protocolo.data_fechamento, '%d/%m/%Y'), '-') AS data_fechamento,
    DATE_FORMAT(protocolo.data_perda, '%d/%m/%Y') AS data_perda,
    protocolo.descricao,

    -- Nome da pessoa que abriu o protocolo
    pessoa_abertura.nome AS nome_pessoa_abertura,

    -- Nome da pessoa que fechou o protocolo (se houver)
    pessoa_fechado.nome AS nome_pessoa_fechado,

    -- Bloco e sala do local_perda do protocolo
    local.bloco,
    local.sala,

    -- Nome do objeto relacionado ao protocolo
    objeto.nome AS nome_objeto

FROM protocolo

-- Join para obter o nome da pessoa que abriu o protocolo
JOIN pessoa AS pessoa_abertura ON protocolo.pessoa_abertura = pessoa_abertura.cpf

-- Join para obter o nome da pessoa que fechou o protocolo (se houver)
LEFT JOIN pessoa AS pessoa_fechado ON protocolo.pessoa_fechado = pessoa_fechado.cpf

-- Join para obter as informações do local (bloco e sala)
JOIN local ON protocolo.local_perda = local.id_local

-- Join para obter o nome do objeto relacionado ao protocolo
JOIN objeto ON protocolo.objeto = objeto.id_objeto
";

    $result = consultar_dado($sql);
    echo json_encode($result);

}
// provavelmente ta errado
if (isset($_GET['acao'])) {
    $acao = $_GET['acao'];

    switch ($acao) {
        case 'buscar':
            buscar_protocolos();
            break;
        default:
            echo "Ação inválida.";
    }
} else {
    echo "Nenhuma ação especificada.";
}
?>

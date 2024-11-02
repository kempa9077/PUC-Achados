<?php 
require_once("../funcoes_banco.php");  

function buscar_objeto() {
    // Obtém o idobjeto enviado via POST e sanitiza para evitar injeção de SQL
    $idobjeto = isset($_POST['idobjeto']) ? intval($_POST['idobjeto']) : null;

    if ($idobjeto === null) {
        echo json_encode(["erro" => "ID do objeto não fornecido."]);
        exit;
    }

    $sql = "SELECT 
                p.idprotocolo as id_protocolo,
                o.id_objeto,
                p.descricao AS descricao_objeto,
                o.nome, 
                l.sala AS secretaria, 
                o.encontrado, 
                c.categoria, 
                o.data_registro, 
                CASE 
                    WHEN l.sala LIKE '%Secretaria%' THEN 1 
                    ELSE 0 
                END AS is_secretaria
            FROM objeto o 
            LEFT JOIN local l ON o.id_local = l.id_local 
            LEFT JOIN categoria_objeto c ON o.categoria_objeto = c.id_tipo 
            LEFT JOIN protocolo p ON o.id_objeto = p.objeto
            WHERE o.id_objeto = $idobjeto";

    // Executa a consulta
    $result = consultar_dado($sql);

    if ($result) {
        // Retorna o resultado em JSON para que o JavaScript possa utilizá-lo
        echo json_encode($result);
    } else {
        echo json_encode(["erro" => "Objeto não encontrado."]);
    }
}

function atualizar_objeto() {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    $idobjeto = isset($_POST['idobjeto']) ? intval($_POST['idobjeto']) : null;
    $idobjetosobrescrito = isset($_POST['idobjetosobrescritos']) ? intval($_POST['idobjetosobrescritos']) : null;

    if ($idobjeto === null || $idobjetosobrescrito === null) {
        echo json_encode(["erro" => "ID do objeto não fornecido."]);
        return;
    }
    
    $verificarprotocolos1 = "SELECT p.idprotocolo as id_protocolo
                            FROM objeto o
                            LEFT JOIN protocolo p ON o.id_objeto = p.objeto
                            WHERE o.id_objeto = '$idobjeto'";
    $verificarprotocolos1 = consultar_dado($verificarprotocolos1);

    $verificarprotocolos2 = "SELECT p.idprotocolo as id_protocolo
                            FROM objeto o
                            LEFT JOIN protocolo p ON o.id_objeto = p.objeto
                            WHERE o.id_objeto = '$idobjetosobrescrito'";
    $verificarprotocolos2 = consultar_dado($verificarprotocolos2);


    if ($verificarprotocolos2 === null){
        echo json_encode(["erro" => "O Objeto informado não possui protocolo atribuído"]);
    return;
    }


    // Obtém o objeto mais recente
    $sqlMaisRecente = "SELECT o.id_local, o.id_objeto, p.descricao as descricao_objeto, o.data_registro, o.encontrado
                       FROM objeto o 
                       LEFT JOIN protocolo p ON o.id_objeto = p.objeto 
                       WHERE o.id_objeto = $idobjeto";
    $objetoMaisRecente = consultar_dado($sqlMaisRecente);

    if (!$objetoMaisRecente) {
        echo json_encode(["erro" => "Objeto não encontrado para sobrescrever."]);
        return;
    }

    $sqlObjetoSobrescrito = " SELECT o.id_local, o.id_objeto, p.descricao as descricao_objeto, o.data_registro, o.encontrado
                              FROM objeto o 
                              LEFT JOIN protocolo p ON o.id_objeto = p.objeto 
                              WHERE o.id_objeto = $idobjetosobrescrito";
    $objetoSobrescrito = consultar_dado($sqlObjetoSobrescrito);

    if (!$objetoSobrescrito) {
        echo json_encode(["erro" => "Objeto a ser sobrescrito não encontrado."]);
        return;
    }

    // Obtém a data de registro mais recente
    $dataRegistroMaisAntigo = min($objetoMaisRecente[0]['data_registro'], $objetoSobrescrito[0]['data_registro']);

    $situacao = max($objetoMaisRecente[0]['encontrado'], $objetoSobrescrito[0]['encontrado']);

    $local = $objetoMaisRecente[0]['id_local'];


    $sqlupdate1 = 'objeto';
    $sqlset1 = "data_registro = '$dataRegistroMaisAntigo', encontrado = '$situacao', id_local = '$local'";
    $sqlwhere1 = "id_objeto = '$idobjetosobrescrito'";

    atualizar_dado($sqlupdate1, $sqlset1, $sqlwhere1);
    
    // Verifica se o objeto a ser excluído existe
    $sqlVerificaExcluir = "SELECT id_objeto FROM objeto WHERE id_objeto = $idobjeto";
    $objetoParaExcluir = consultar_dado($sqlVerificaExcluir);

    if (!$objetoParaExcluir) {
        echo json_encode(["erro" => "Objeto a ser excluído não encontrado."]);
        return;
    }

    $sqltabela = 'objeto';
    $sqlcondicao = "id_objeto = '$idobjeto'";

    $resultadoExclusao = deletar_dado($sqltabela, $sqlcondicao);

    if (strpos($resultadoExclusao, "Erro:") !== false) {
        error_log("Erro ao tentar excluir o objeto: " . $resultadoExclusao); // Log do erro
        echo json_encode(["erro" => $resultadoExclusao]);
        return;
    }

    echo json_encode(["sucesso" => "Objeto sobrescrito com sucesso e objeto original excluído."]);
}



// Verifica se a requisição é POST e se há dados para processar
if (isset($_POST['acao'])) {
    switch ($_POST['acao']) {
        case 'buscar':
            buscar_objeto();
            break;
        case 'excluir':
            atualizar_objeto();
            break;
        default:
            echo json_encode(["erro" => "Ação inválida."]);
    }
}
?>

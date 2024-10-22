<?php
include '../funcoes_banco.php';
include '../header.php';

header('Content-Type: application/json');

$cpf_funcionario = $_SESSION['usuario']['cpf'];
$cpf_retirante = $_POST['pessoa_retirante'];
$id_objeto = $_POST['id_objeto']; 

// Verifica se o retirante está cadastrado
$sql = "SELECT * FROM pessoa WHERE cpf = '$cpf_retirante'";
$result = consultar_dado($sql);

if (empty($result)) {
    echo json_encode(['error' => 'usuario_nao_encontrado']);
    exit;
}

// Verifica se há um protocolo aberto (situacao = 0) com o mesmo id_objeto
$sql_protocolo_aberto = "SELECT * FROM protocolo WHERE objeto = $id_objeto AND situacao = 0";
$protocolo_aberto = consultar_dado($sql_protocolo_aberto);

if (!empty($protocolo_aberto)) {
    // Protocolo aberto encontrado, atualiza com os dados de fechamento
    $data_fechamento = date('Y-m-d H:i:s');
    $id_protocolo = $protocolo_aberto[0]['idprotocolo']; // Obtém o ID do protocolo aberto
    
    $atributos_protocolo = "data_fechamento = '$data_fechamento', pessoa_fechado = '$cpf_funcionario', situacao = 1";
    $condicao_protocolo = "idprotocolo = $id_protocolo"; // campo no banco é idprotocolo sem o _
    $atualizar_protocolo = atualizar_dado('protocolo', $atributos_protocolo, $condicao_protocolo);
}

// Atualiza o campo encontrado de 1 pra 2
$atributo = "encontrado = 2";
$condicao = "id_objeto = $id_objeto";
$atualizacao = atualizar_dado('objeto', $atributo, $condicao);

// Registra a retirada
$data_hora = date('Y-m-d H:i:s');
$colunas = 'id_objeto, pessoa_retirante, funcionario, data';
$valores = "$id_objeto, '$cpf_retirante', '$cpf_funcionario', '$data_hora'";
$registrar_retirada = inserir_dado('retirada', $colunas, $valores);

// Faz a log do objeto
$colunas_log = 'id_objeto, funcionario, data, valor_antigo, valor_novo';
$valores_log = "$id_objeto, '$cpf_funcionario', '$data_hora', 1, 2";
$resultado_log = inserir_dado('log_encontro', $colunas_log, $valores_log);

echo json_encode(['success' => true]);
exit;

?>

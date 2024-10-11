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

// Atualiza o campo encontrado de 1 pra 2
$atributo = "encontrado = 2";
$condicao = "id_objeto = $id_objeto";
$atualizacao = atualizar_dado('objeto', $atributo, $condicao);

// Registra a retirada
$data_hora = date('Y-m-d H:i:s');
$colunas = 'id_objeto, pessoa_retirante, funcionario, data';
$valores = "$id_objeto, '$cpf_retirante', '$cpf_funcionario', '$data_hora'";
$registrar_retirada = inserir_dado('retirada', $colunas, $valores);

// faz a log do objeto
$colunas = 'id_objeto, funcionario, data,valor_antigo,valor_novo';
$valores = "$id_objeto, '$cpf_funcionario', '$data_hora',1,2";
$resultado_log = inserir_dado('log_encontro', $colunas, $valores);

echo json_encode(['success' => true]); // pra ver se recarrega a pag assim

?>

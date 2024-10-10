<?php
include '../funcoes_banco.php';
include '../header.php';


$cpf_funcionario = $_SESSION['usuario']['cpf']; // Obtém o ID do objeto da requisição POST  
//$id_objeto = 3;
$id_objeto = $_POST['id_objeto']; // Obtém o ID do objeto da requisição POST 
$condicao = "objeto.id_objeto =".$id_objeto;
// Atualiza o campo encontrado de 0 para 1
$atributo = "encontrado = 1";
$atualizacao = atualizar_dado('objeto', $atributo, $condicao);

// registra a log 
$data_hora = date('Y-m-d H:i:s');
// Prepare os valores para a inserção no log_encontro
$colunas = 'id_objeto, funcionario, data';
$valores = "$id_objeto, '$cpf_funcionario', '$data_hora'";
$resultado_log = inserir_dado('log_encontro', $colunas, $valores);

var_dump($resultado_log)
?>

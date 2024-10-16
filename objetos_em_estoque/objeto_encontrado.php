<?php
include '../funcoes_banco.php';
include '../header.php';


$cpf_funcionario = $_SESSION['usuario']['cpf'];
$id_objeto = $_POST['id_objeto']; 

$condicao = "objeto.id_objeto =".$id_objeto;
$novo_local =$_POST['novo_local'];

// Atualiza o campo encontrado de 0 para 1 e o novo local
$atributo = "encontrado = 1,id_local ='$novo_local'";
$atualizacao = atualizar_dado('objeto', $atributo, $condicao);

// registra a log 
$data_hora = date('Y-m-d H:i:s');
// valores para a inserção no log_encontro
$colunas = 'id_objeto, funcionario, data,valor_antigo,valor_novo';
$valores = "$id_objeto, '$cpf_funcionario', '$data_hora',0,1";
$resultado_log = inserir_dado('log_encontro', $colunas, $valores);

var_dump($resultado_log) // teste
?>

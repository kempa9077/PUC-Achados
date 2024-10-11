<?php
include '../funcoes_banco.php';
include '../header.php';


$cpf_funcionario = $_SESSION['usuario']['cpf'];
$cpf_retirante = $_POST['pessoa_retirante'];
$id_objeto = $_POST['id_objeto']; 

// Atualiza o campo encontrado de 1 pra 2
$atributo = "encontrado = 2";
$condicao = "objeto.id_objeto =".$id_objeto;
$atualizacao = atualizar_dado('objeto', $atributo, $condicao);

// registra a retirada
$data_hora = date('Y-m-d H:i:s');
// valores para a inserção no log_encontro
$colunas = 'id_objeto ,pessoa_retirante ,funcionario , data';
$valores = "$id_objeto,'$cpf_retirante','$cpf_funcionario','$data_hora'";
$registrar_retirada = inserir_dado('retirada', $colunas, $valores);

var_dump($registrar_retirada) // teste
?>

<?php 
require_once("../funcoes_banco.php");  
function buscar_logs_encontro() {
    $sql = "SELECT * FROM retirada";  

    $result = consultar_dado($sql);
    echo json_encode($result);
}

if (isset($_GET['acao']) && $_GET['acao'] == 'buscar') {
    buscar_logs_encontro();
} else {
    echo json_encode(["erro" => "Ação inválida."]);
}

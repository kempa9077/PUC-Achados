<?php
require_once("../funcoes_banco.php");

// Verifica se o id_bloco foi passado via GET
if (isset($_GET['id_bloco'])) {
    $id_bloco = $_GET['id_bloco'];
    
    // Filtra secretaria aqui tambem
    $sql = "SELECT * FROM local WHERE bloco = '$id_bloco' AND sala NOT LIKE '%secretaria%'";
    $result = consultar_dado($sql);
    
    // Retorna o  JSON
    echo json_encode($result);
} else {
    // Se n tiver json retorna isso, talvez
    echo json_encode(["erro" => "Bloco não foi selecionado."]);
}
?>

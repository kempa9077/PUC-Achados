<?php
require_once("../funcoes_banco.php");

// Verifica se o id_bloco foi passado via GET
if (isset($_GET['id_bloco'])) {
    $id_bloco = $_GET['id_bloco'];
    
    // Consulta SQL para obter as salas relacionadas ao bloco selecionado, excluindo secretarias
    $sql = "SELECT * FROM local WHERE bloco = '$id_bloco' AND sala NOT LIKE '%secretaria%'";
    $result = consultar_dado($sql);
    
    // Retorna os dados como JSON
    echo json_encode($result);
} else {
    // Caso o id_bloco não seja passado, retorna uma mensagem de erro
    echo json_encode(["erro" => "Bloco não foi selecionado."]);
}
?>

<?php
include '../funcoes_banco.php';

$sql = "SELECT o.id_objeto, o.nome, l.sala as secretaria, o.encontrado, c.categoria 
        FROM objeto o 
        JOIN local l ON o.secretaria = l.id_local 
        JOIN categoria_objeto c ON o.categoria_objeto = c.id_tipo";

$objetos = consultar_dado($sql);

header('Content-Type: application/json');
echo json_encode($objetos);
?>

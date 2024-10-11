<?php
include '../funcoes_banco.php';

$sql = "SELECT o.id_objeto, o.nome, l.sala as secretaria, o.encontrado, c.categoria, 
        CASE 
            WHEN l.sala LIKE '%Secretaria%' THEN 1 
            ELSE 0 
        END as is_secretaria
        FROM objeto o 
        JOIN local l ON o.secretaria = l.id_local 
        JOIN categoria_objeto c ON o.categoria_objeto = c.id_tipo";


$objetos = consultar_dado($sql);

header('Content-Type: application/json');
echo json_encode($objetos);
// var_dump($objetos); // pra ver isso tem que ir no proprio imprimir_estoque.php
?>

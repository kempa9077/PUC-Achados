<?php
include '../funcoes_banco.php';

$sql = "SELECT p.idprotocolo as id_protocolo, o.id_objeto, o.nome, l.sala as secretaria, o.encontrado, c.categoria, o.data_registro, p.descricao as descricao,
        CASE 
            WHEN l.sala LIKE '%Secretaria%' THEN 1 
            ELSE 0 
        END as is_secretaria
        FROM objeto o 
        LEFT JOIN protocolo p ON o.id_objeto = p.objeto
        JOIN local l ON o.id_local = l.id_local 
        JOIN categoria_objeto c ON o.categoria_objeto = c.id_tipo";


$objetos = consultar_dado($sql);

header('Content-Type: application/json');
echo json_encode($objetos);

?>

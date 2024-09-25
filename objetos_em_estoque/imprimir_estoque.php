<?php
// Inclui o arquivo com a função consultar_dado
include '../funcoes_banco.php';

// Consulta SQL para buscar os dados dos objetos
$sql = "SELECT o.id_objeto, o.nome, l.sala as secretaria, o.encontrado, c.categoria 
        FROM objeto o 
        JOIN local l ON o.secretaria = l.id_local 
        JOIN categoria_objeto c ON o.categoria_objeto = c.id_tipo";

// Utiliza a função consultar_dado para executar a consulta e obter os resultados
$objetos = consultar_dado($sql);

// Retorna os dados como JSON
header('Content-Type: application/json');
echo json_encode($objetos);
?>

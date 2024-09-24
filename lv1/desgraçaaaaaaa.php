<?php
include '../funcoes_banco.php';

$sql = "SELECT id_local, sala FROM salas WHERE bloco_id = $id_bloco"; // Ajuste conforme sua tabela
$resultado = consultar_dado($sql);
echo $resultado;



?>
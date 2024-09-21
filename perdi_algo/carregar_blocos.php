<?php
require_once("../funcoes_banco.php");

$sql = "SELECT * FROM bloco"; // Ajuste se necessário
$result = consultar_dado($sql);
echo json_encode($result);
?>

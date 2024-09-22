<?php
require_once("../funcoes_banco.php");

$sql = "SELECT * FROM bloco"; // Ajuste se necessário
$result = consultar_dado($sql);
echo json_encode($result);


// quando o bloco for informado deve haver a consultoria das salas relacionadas ao bloco
// porem tem que fazer o js e arrumar o banco antes :)
function carregar_salas() {
    $bloco = $_POST['id_bloco'];
    $sql = "SELECT * FROM sala WHERE $bloco"; // Ajuste se necessário
    $result = consultar_dado($sql);
    echo json_encode($result);
}

if (isset($_GET['acao'])) {
    $acao = $_GET['acao'];

    switch ($acao) {
        case 'buscar':
            carregar_salas();
            break;
        default:
            echo "Ação inválida.";
    }
} else {
    echo "Nenhuma ação especificada.";
}
?>

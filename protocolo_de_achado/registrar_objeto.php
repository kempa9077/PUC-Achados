<?php
require_once("../funcoes_banco.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura os dados do formulário
    $nome_item = $_POST['nome_item'];
    $categoria_item = $_POST['tipo_item'];
    $id_local = $_POST['sala_encontro']; // Assume que este é o ID da secretaria
    $encontrado = 0; // Valor fixo como 0

    // Prepare os dados para inserção
    $tabela = "objeto"; // Nome da tabela
    $colunas = "nome, categoria_objeto, secretaria, encontrado"; // Colunas
    $valores = "'$nome_item', '$categoria_item', '$id_local', $encontrado"; // Valores

    // Chama a função para inserir dados
    $resultado = inserir_dado($tabela, $colunas, $valores);

    // Retorna um resultado (opcional)
    echo json_encode(['resultado' => $resultado]);
} else {
    echo json_encode(['erro' => 'Método não permitido']);
}
?>

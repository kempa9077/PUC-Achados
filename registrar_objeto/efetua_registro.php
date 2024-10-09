<?php
require_once("../funcoes_banco.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura os dados do formulário
    $nome_item = $_POST['nome_item'];
    $categoria_item = $_POST['tipo_item'];
    $id_local = $_POST['sala_encontro']; // No banco diz secretaria, mas mudar agora da medo de quebrar algo
    $encontrado = 1; // 0 = perdido 1 = Em estoque 2 = Devolvido

    $tabela = "objeto"; 
    $colunas = "nome, categoria_objeto, secretaria, encontrado"; 
    $valores = "'$nome_item', '$categoria_item', '$id_local', $encontrado"; 

    $resultado = inserir_dado($tabela, $colunas, $valores);

} else {
    echo json_encode(['erro' => 'Método não permitido']);
}
?>

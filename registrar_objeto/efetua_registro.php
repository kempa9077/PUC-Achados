<?php
require_once("../funcoes_banco.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura os dados do formulário
    $nome_item = $_POST['nome_item'];
    $categoria_item = $_POST['tipo_item'];
    $id_local = $_POST['bloco_encontro']; // antes era secretaria, agota ta como id_local
    $encontrado = 1; // 0 = perdido 1 = Em estoque 2 = Devolvido

    $tabela = "objeto"; 
    $colunas = "nome, categoria_objeto, id_local, encontrado"; // campo data ta sendo preenchido quando há insert de forma automatica
    $valores = "'$nome_item', '$categoria_item', '$id_local', '$encontrado'"; 

    $resultado = inserir_dado($tabela, $colunas, $valores);

} 
if ($resultado) {
    echo json_encode(['resultado' => $resultado]); // Retorna o ID do objeto registrado
} else {
    echo json_encode(['erro' => 'Falha ao registrar o objeto']);}
?>
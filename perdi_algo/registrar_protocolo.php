<?php
require_once("../funcoes_banco.php");

// Supondo que você armazena o CPF do usuário na sessão
$cpf_usuario = $_SESSION['usuario']['cpf']; // Ajuste conforme o armazenamento na sessão

$nome_item = $_POST['nome_item'];
$tipo_item = $_POST['tipo_item'];
$bloco_encontro = $_POST['bloco_encontro'];
$sala_encontro = $_POST['sala_encontro'];
$data_perda = $_POST['data_perda'];
$descricao = $_POST['descricao'];

// Preparar SQL para inserir o protocolo
$sql = "INSERT INTO protocolo (cpf_usuario, nome_item, tipo_item, bloco_encontro, sala_encontro, data_perda, descricao) VALUES ('$cpf_usuario', '$nome_item', '$tipo_item', '$bloco_encontro', '$sala_encontro', '$data_perda', '$descricao')";
$result = atualizar_dado($sql);

if ($result === "Registro inserido com sucesso") {
    echo "Protocolo registrado com sucesso!";
} else {
    echo "Erro ao registrar protocolo: $result";
}
?>

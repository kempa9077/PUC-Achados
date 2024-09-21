<?php
// pagFun_protocolo.php

require_once("../funcoes_banco.php");  // Função de conexão com o banco de dados

function buscar_protocolos_abertos() {
    global $conn;

    // tem que melorar esse sql ou tentar usar o do professor, mas sla tudo da errado
    $query = "SELECT protocolo.id_protocolo, objeto.nome, objeto.nome AS categoria, protocolo.status, 
                     DATE_FORMAT(protocolo.data_perda, '%d/%m/%Y') AS data_perda, 
                     DATE_FORMAT(protocolo.data_abertura, '%d/%m/%Y') AS data_abertura, 
                     IFNULL(DATE_FORMAT(protocolo.data_fechamento, '%d/%m/%Y'), '-') AS data_fechamento 
              FROM protocolo p
              JOIN objeto o ON protocolo.id_objeto = objeto.id_objeto
              JOIN categoria_objeto c ON categoria_objeto.id_categoria = categoria_objeto.id_categoria
"; // Aqui buscamos apenas os protocolos com situação 'Aberto'

    $result = $conn->query($query);
    
    $protocolos = array();
    
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $protocolos[] = $row;
        }
    }
    
    // Retornar os dados em formato JSON
    echo json_encode($protocolos);
}

// Verifica se a função foi chamada via AJAX
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    buscar_protocolos_abertos();
}
?>

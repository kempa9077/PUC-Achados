<?php
include '../header.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Pessoas</title>
    <link rel="stylesheet" href="gerenciar_fun.css"> 
</head>
<body>
    <h1>Gerenciar Funcionarios</h1>
    
    <!-- Tabela para exibir os dados -->
    <table border="1" id="tabelaFuncinario">
        <thead>
            <tr>
            <th>Nome</th>
            <th>Nível de Acesso</th>
            <th>Registro PUC</th>
            <th>Email</th>
            <th>Ação</th>
            </tr>
        </thead>
        <tbody id="corpoTabela">
            <!-- Linhas da tabela serão inseridas aqui dinamicamente -->
        </tbody>
    </table>
</body>
<script src="gerenciar_fun.js"></script>
</html>

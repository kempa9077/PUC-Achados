<?php
// Conexão com o banco de dados
$host = '127.0.0.1';
$user = 'root';
$password = '';
$dbname = 'puc_achados';

$conn = new mysqli($host, $user, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Consulta para buscar os dados
$sql = "SELECT o.id_objeto, o.nome, l.sala as secretaria, o.encontrado, c.categoria 
        FROM objeto o 
        JOIN local l ON o.secretaria = l.id_local 
        JOIN categoria_objeto c ON o.categoria_objeto = c.id_tipo";

$result = $conn->query($sql);

// Array para armazenar os dados
$objetos = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $objetos[] = $row;
    }
}

// Retorna os dados como JSON
header('Content-Type: application/json');
echo json_encode($objetos);

$conn->close();
?>

<?php
require_once("..//funcoes_banco.php");

// Função para retornar dados como JSON
function json_return($var) {
    header('Content-Type: application/json');
    echo json_encode($var);
}

// Verifica se foi requisitado um método via GET
if (isset($_GET['metodo'])) {
    if ($_GET['metodo'] == "listar") {
        // Listagem de usuários da tabela 'pessoa'
        json_return(consultar_dado("SELECT * FROM pessoa"));
    } elseif ($_GET['metodo'] == "excluir") {
        $id = $_GET['id'];
        // Lógica para excluir um usuário seria implementada aqui
        json_return($id);
    } else {
        json_return(["erro" => "requisição desconhecida"]);
    }
}

// Verifica se a requisição é POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe o que está vindo por INPUT
    $json = file_get_contents('php://input');
    // Decodifica o JSON em um array associativo
    $post = json_decode($json, true);

    // Adição de novo usuário
    if ($post['solicitacao'] == "adicionar") {
        $tabela = "pessoa";
        $colunas = "cpf,email,senha,nome,matricula";
        $valores = "'".$post['cpf']."', '".$post['email']."', '".$post['senha']."', '".$post['nome']."', '".$post['matricula']."'";
        $id = inserir_dado($tabela, $colunas, $valores);
        json_return(["id" => $id]);
    } else {
        json_return(["erro" => "Ação desconhecida"]);
    }
	
}

?>

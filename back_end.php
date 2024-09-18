<?php
require_once("funcoes_banco.php");

// Função para retornar dados como JSON
function json_return($var) {
    header('Content-Type: application/json');
    echo json_encode($var);
}

// Verifica se foi requisitado um método via GET
if (isset($_GET['metodo'])) {
    if ($_GET['metodo'] == "listar") {
        // Listagem de usuários da tabela 'pessoa'
        json_return(consultar_dado("SELECT cpf, nome, email FROM pessoa"));
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

    // Validação de login
    if ($post['solicitacao'] == "consultar") {
        $sql = "SELECT * FROM pessoa WHERE email = '".$post['email']."' AND senha = '".$post['senha']."'";
        $resultado = consultar_dado($sql);

        if (count($resultado) > 0) {
            // Redireciona para outra pagina na teoriaaaaa
            json_return(["redirect" => "tela_adm.html"]);
        } else {
            json_return(["erro" => "Usuário ou senha inválidos"]);
        }
    }

    // Adição de novo usuário
    elseif ($post['solicitacao'] == "adicionar") {
        $tabela = "pessoa";
        $colunas = "email, senha";
        $valores = "'".$post['email']."', '".$post['senha']."'";
        $id = inserir_dado($tabela, $colunas, $valores);
        json_return(["id" => $id]);
    } else {
        json_return(["erro" => "Ação desconhecida"]);
    }
	
}

?>

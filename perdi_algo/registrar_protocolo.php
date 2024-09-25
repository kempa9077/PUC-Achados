<?php
require_once("../funcoes_banco.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function inserirObjeto() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Captura os dados do formulário
        $nome_item = $_POST['nome_item'];
        $categoria_item = $_POST['tipo_item'];
        $encontrado = 0; // Valor fixo como 0
    
        // Prepare os dados para inserção
        $tabela = "objeto"; // Nome da tabela
        $colunas = "nome, categoria_objeto, encontrado"; // Colunas
        $valores = "'$nome_item', '$categoria_item', '$encontrado'"; // Valores
    
        // Chama a função para inserir dados
        $resultado = inserir_dado($tabela, $colunas, $valores);

        if (is_numeric($resultado)) {
            // Retorna o ID do objeto inserido como JSON
            echo json_encode(['resultado' => $resultado]);
            return $resultado;
        } else {
            // Retorna uma mensagem de erro como JSON
            echo json_encode(["erro" => "Erro ao registrar Objeto: $resultado"]);
        }
    } else {
        // Retorna uma mensagem de erro se o método não for POST
        echo json_encode(['erro' => 'Método não permitido']);
    }
}


//$post['usuario']['123']
    

function inserirProcotocolo() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Verifique se todos os campos necessários estão presentes
        if (!isset($_POST['nome_item'], $_POST['tipo_item'], $_POST['bloco_encontro'], $_POST['sala_perda'], $_POST['data_perda'], $_POST['descricao'])) {
            echo json_encode(["erro" => "Todos os campos são obrigatórios."]);
            return;
        }

        $objeto_id = inserirObjeto(); // Primeiro, insere o objeto e obtém o ID


            // Pegando dados do protocolo
            $status = 0;
            //$cpf_usuario = '123';
            $cpf_usuario = $_SESSION['usuario']['cpf'];// Substitua por ['usuario']['cpf'] quando tiver em sessão.
            $data_abertura = date('Y-m-d H:i:s');
            $data_perda = $_POST['data_perda'];
            $descricao = $_POST['descricao'];
            $local_perda = $_POST['sala_perda'];

            // Monta a query para inserir o protocolo
            $tabela = "protocolo";
            $colunas = "situacao, data_abertura, data_perda, pessoa_abertura, local_perda, objeto, descricao";
            $valores = "'$status', '$data_abertura','$data_perda', '$cpf_usuario', '$local_perda', '$objeto_id', '$descricao'";
            
            $result = inserir_dado($tabela, $colunas, $valores);

            if (is_numeric($result)) {
                echo json_encode(["sucesso" => "Protocolo registrado com sucesso!", "protocolo_id" => $result]);
            } else {
                echo json_encode(["erro" => "Erro ao registrar o protocolo: $result"]);
            }
        } else {
            echo json_encode(["erro" => "Erro ao registrar o objeto"]);
        }
    } 


// pode ta errado como sempre
if (isset($_POST['acao'])) {
    $acao = $_POST['acao'];

    switch ($acao) {
        case 'buscar':
            inserirProcotocolo();
            break;
        default:
            echo json_encode(["erro" => "Ação inválida."]);
    }
} else {
    echo json_encode(["erro" => "Nenhuma ação especificada."]);
}

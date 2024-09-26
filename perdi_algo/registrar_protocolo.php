<?php
require_once("../funcoes_banco.php");
date_default_timezone_set('America/Sao_Paulo');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function inserirObjeto() {
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

    }



//$post['usuario']['123']
    

function inserirProcotocolo() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Verifica que ta tudo certo e avisa se n tiver no console, oque não acontece enquantão talvez esteja passando
        if (!isset($_POST['nome_item'], $_POST['tipo_item'], $_POST['bloco_encontro'], $_POST['sala_perda'], $_POST['data_perda'], $_POST['descricao'])) {
            echo json_encode(["erro" => "Todos os campos são obrigatórios."]);
            return;
        }

        $objeto_id = inserirObjeto(); // insere o objeto no banco e retorna pega o ID do mesmo

        // dados pro protocolo
        $status = 0; // 0 quer dizer fechado
        $data_abertura = date('Y-m-d H:i:s'); // ta certo?
        $data_perda = $_POST['data_perda']; // n sei se ta certo
        $cpf_usuario = $_SESSION['usuario']['cpf'];// ta teoria maxima do universo ta certo
        $local_perda = $_POST['sala_perda']; // de acordo com console.log ta certo
        $descricao = $_POST['descricao']; // so deus sabe

        //  sera que há algum erro aqui?
        $tabela = "protocolo";
        $colunas = "situacao, data_abertura, data_perda, pessoa_abertura, local_perda, objeto, descricao";
        $valores = "'$status', '$data_abertura','$data_perda', '$cpf_usuario', '$local_perda', '$objeto_id', '$descricao'";
            
        $result = inserir_dado($tabela, $colunas, $valores);

        // tentativas de descobrir o pq n esta registando nada
        if (is_numeric($result)) {
            echo json_encode(["sucesso" => "Protocolo registrado com sucesso!", "protocolo_id" => $result]);
        } else {
            echo json_encode(["erro" => "Erro ao registrar o protocolo: $result"]);
        }
        } else {
            echo json_encode(["erro" => "Erro ao registrar o objeto"]);
        }
    } 


// pode ta errado como sempre, mas isso deve fazer tudo funcionar
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

<?php
require_once("../funcoes_banco.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function obterIdTipo($categoria) {
    // Sanitize the input to prevent SQL injection
    $categoria = mysqli_real_escape_string(conectar(), $categoria);
    
    // Cria a consulta SQL
    $sql = "SELECT id_tipo FROM tipos WHERE categoria = '$categoria' LIMIT 1"; // Ajuste 'tipos' para o nome correto da sua tabela

    // Chama a função de consultar dados
    $resultado = consultar_dado($sql);

    // Verifica se encontrou algum resultado
    if (count($resultado) > 0) {
        return $resultado[0]['id_tipo']; // Retorna o id_tipo encontrado
    } else {
        return false; // Retorna falso se não encontrar
    }
}

function inserirObjeto() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $categoria = $_POST['tipo_item'];
        $nome_item = $_POST['nome_item'];

        // Obter o id_tipo com base na categoria
        $id_tipo = obterIdTipo($categoria);
        if (!$id_tipo) {
            echo json_encode(["erro" => "Tipo de item não encontrado."]);
            return false;
        }

        // Inserir o objeto no banco de dados
        $tabela = "objeto";
        $colunas = "categoria_objeto, encontrado, nome";
        $valores = "'$id_tipo', '0', '$nome_item'";
        $result = inserir_dado($tabela, $colunas, $valores);

        if (is_numeric($result)) {
            return $result;
        } else {
            echo json_encode(["erro" => "Erro ao registrar Objeto: $result"]);
            return false;
        }
    }
}


//$post['usuario']['123']
    
// precisa puxar pelo js ou fazer o $status = $_POST['status'];
// ta inspirado no inset do cadastro, mas sla
function inserirProcotocolo() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Verifique se todos os campos necessários estão presentes
        if (!isset($_POST['nome_item'], $_POST['tipo_item'], $_POST['bloco_encontro'], $_POST['sala_encontro'], $_POST['data_perda'], $_POST['descricao'])) {
            echo json_encode(["erro" => "Todos os campos são obrigatórios."]);
            return;
        }

        $objeto_id = inserirObjeto(); // Primeiro, insere o objeto e obtém o ID

        if ($objeto_id) {
            // Pegando dados do protocolo
            $status = '0';
            $data_abertura = date('Y-m-d H:i:s');
            $data_perda = isset($_POST['data_perda']) ? $_POST['data_perda'] : NULL;
            $descricao = $_POST['descricao'];
            $cpf_usuario = '123'; // Substitua por ['usuario']['123'] quando tiver em sessão.
            $local_perda = $_POST['bloco_encontro'] . "_" . $_POST['sala_encontro']; // Exemplo de combinação de bloco e sala

            // Monta a query para inserir o protocolo
            $tabela = "protocolo";
            $colunas = "status, data_abertura, data_perda, pessoa_abertura, local_perda, objeto, descricao";
            $valores = "'$status', '$data_abertura', " . ($data_perda ? "'$data_perda'" : "NULL") . ", '$cpf_usuario', '$local_perda', '$objeto_id', '$descricao'";
            
            $result = inserir_dado($tabela, $colunas, $valores);

            if (is_numeric($result)) {
                echo json_encode(["sucesso" => "Protocolo registrado com sucesso!", "protocolo_id" => $result]);
            } else {
                echo json_encode(["erro" => "Erro ao registrar o protocolo: $result"]);
            }
        } else {
            echo json_encode(["erro" => "Erro ao registrar o objeto"]);
        }
    } else {
        echo json_encode(["erro" => "Método de requisição inválido."]);
    }
}


// pode ta errado como sempre
if (isset($_GET['acao'])) {
    $acao = $_GET['acao'];

    switch ($acao) {
        case 'buscar':
            inserirProcotocolo();
            break;
        default:
            echo "Ação inválida.";
    }
} else {
    echo "Nenhuma ação especificada.";
}

?>
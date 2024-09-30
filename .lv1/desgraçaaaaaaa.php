<?php
include '../funcoes_banco.php';
include '../header.php';

function teste() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Verifique se todos os campos necessários estão presentes
        if (!isset($_POST['nome_item'], $_POST['tipo_item'], $_POST['bloco_encontro'], $_POST['sala_perda'], $_POST['data_perda'], $_POST['descricao'])) {
            echo json_encode(["erro" => "Todos os campos são obrigatórios."]);
            return;
        }

        $objeto_id = 1; // Primeiro, insere o objeto e obtém o ID


        // Pegando dados do protocolo
        $status = 0;
        $data_abertura = date('Y-m-d H:i:s');
        $data_perda = $_POST['09-11-2024 00:00:00'];
        $cpf_usuario = $_SESSION['usuario']['cpf'];// Substitua por ['usuario']['cpf'] quando tiver em sessão.
        $local_perda = 1;
        $descricao = "adilson";

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

    if (isset($_POST['acao'])) {
        $acao = $_POST['acao'];
    
        switch ($acao) {
            case 'buscar':
                teste();
                break;
            default:
                echo json_encode(["erro" => "Ação inválida."]);
        }
    } else {
        echo json_encode(["erro" => "Nenhuma ação especificada."]);
    }

?>

<button id="enviar_objeto" class="enviar-btn">Enviar</button>
<script src="perdi_algo.js"></script>
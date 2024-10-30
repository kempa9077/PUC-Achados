<?php
include '../header.php';
require_once("../funcoes_banco.php");

// ------------------------------------------------------------------------------------------------------------------------------

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

function inserirObjeto() {
    // Captura os dados do formulário
    $nome_item      = $_POST['nome_item'];
    $categoria_item = $_POST['tipo_item'];
    $encontrado = 0; // Valor fixo como 0
    $local_perda = $_POST['sala_perda'];
    // Prepare os dados para inserção
    $tabela = "objeto"; // Nome da tabela
    $colunas = "id_local,nome, categoria_objeto, encontrado"; // Colunas
    $valores = "'$local_perda','$nome_item', '$categoria_item', '$encontrado'"; // Valores

    // Chama a função para inserir dados
    $resultado = inserir_dado($tabela, $colunas, $valores);
    return $resultado;
}


function inserirProcotocolo() {
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

    if ($result) {
        // Se a inserção foi bem-sucedida
        echo json_encode(['sucesso' => 'Protocolo registrado com sucesso!']);
    } else {
        // Se houve falha
        echo json_encode(['erro' => 'Falha ao registrar o protocolo.']);
    }
    
}


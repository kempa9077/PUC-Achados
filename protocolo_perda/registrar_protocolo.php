<?php
include '../header.php';
require_once("../funcoes_banco.php");
date_default_timezone_set('America/Sao_Paulo');


if(isset($_GET['teste'])){
    inserirFakeProcotocolo();
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

// http://localhost/PUC-Achados/protocolo_perda/registrar_protocolo.php?teste=1
function inserirFakeObjeto() {
    // Captura os dados do formulário
    $nome_item = 'TESTE';
    $categoria_item = '1';
    $encontrado = 0; // Valor fixo como 0

    // Prepare os dados para inserção
    $tabela = "objeto"; // Nome da tabela
    $colunas = "nome, categoria_objeto, encontrado"; // Colunas
    $valores = "'$nome_item', '$categoria_item', '$encontrado'"; // Valores

    // Chama a função para inserir dados
    $resultado = inserir_dado($tabela, $colunas, $valores);
    
    var_dump($resultado) ;
    exit;
}
function inserirFakeProcotocolo() {
    $objeto_id = 1; // insere o objeto no banco e retorna pega o ID do mesmo

        // dados pro protocolo
    $status = 0; // 0 quer dizer fechado
    $data_abertura = '2024-10-25 10:10:56.000000';
    $data_perda = '2024-10-20 10:10:56.000000';// n sei se ta certo
    $cpf_usuario = 12345678910;// ta teoria maxima do universo ta certo
    $local_perda = 10; // de acordo com console.log ta certo
    $descricao = "Deus e bom e o davi é burro"; // so deus sabe

        //  sera que há algum erro aqui?
    $tabela = "protocolo";
    $colunas = "situacao, data_abertura, data_perda, pessoa_abertura, local_perda, objeto, descricao";
    $valores = "'$status', '$data_abertura','$data_perda', '$cpf_usuario', '$local_perda', '$objeto_id', '$descricao'";
    // var_dump($tabela);
    // var_dump($colunas);
    // var_dump($valores);     
    $result = inserir_dado($tabela, $colunas, $valores);

        // tentativas de descobrir o pq n esta registando nada
    var_dump($result);
    return $result;

}

// ------------------------------------------------------------------------------------------------------------------------------


function inserirObjeto() {
    // Captura os dados do formulário
    $nome_item      = $_POST['nome_item'];
    $categoria_item = $_POST['tipo_item'];
    $encontrado = 0; // Valor fixo como 0

    // Prepare os dados para inserção
    $tabela = "objeto"; // Nome da tabela
    $colunas = "nome, categoria_objeto, encontrado"; // Colunas
    $valores = "'$nome_item', '$categoria_item', '$encontrado'"; // Valores

    // Chama a função para inserir dados
    $resultado = inserir_dado($tabela, $colunas, $valores);
    return $resultado;
}

    
// algum destes dados estão errados
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

        // tentativas de descobrir o pq n esta registando nada
        return $result;

}


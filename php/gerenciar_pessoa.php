<?php
include 'funcoes_banco.php'; // Inclui o arquivo de funções de banco de dados

// Função para buscar todas as pessoas
function buscarPessoas() {
    $sql = "SELECT * FROM pessoa";
    $result = consultar_dado($sql);
    echo json_encode($result); // Retorna os dados em formato JSON
}

// Função para atualizar todos os dados de uma pessoa
function atualizarPessoa() {
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $nome = $_POST['nome'];
    $matricula = $_POST['matricula'];
    $registro_puc = $_POST['registro_puc'];
    $acesso_nivel = $_POST['acesso_nivel'];

    $atributos = "email='$email', nome='$nome', matricula='$matricula', registro_puc='$registro_puc', acesso_nivel='$acesso_nivel'";
    $condicao = "cpf='$cpf'";
    $resultado = atualizar_dado('pessoa', $atributos, $condicao);

    if ($resultado === "Registro atualizado com sucesso") {
        echo "Dados atualizados com sucesso!";
    } else {
        echo "Erro ao atualizar dados: $resultado";
    }
}

// Função para deletar uma pessoa
function deletarPessoa() {
    $cpf = $_POST['cpf'];
    $condicao = "cpf='$cpf'";
    $resultado = deletar_dado('pessoa', $condicao);

    if ($resultado === "Registro deletado com sucesso") {
        echo "Pessoa deletada com sucesso!";
    } else {
        echo "Erro ao deletar pessoa: $resultado";
    }
}

// Identificar a ação solicitada
if (isset($_GET['acao'])) {
    $acao = $_GET['acao'];

    switch ($acao) {
        case 'buscar':
            buscarPessoas();
            break;
        case 'atualizar':
            atualizarPessoa();
            break;
        case 'deletar':
            deletarPessoa();
            break;
        default:
            echo "Ação inválida.";
    }
} else {
    echo "Nenhuma ação especificada.";
}
?>

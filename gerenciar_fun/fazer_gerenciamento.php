<?php
include("../funcoes_banco.php"); // Inclui o arquivo de funções de banco de dados
include '../header.php';

// Função para buscar todos os funcionários
function buscarPessoas() {
    $sql = "SELECT * FROM pessoa WHERE acesso_nivel >= 1"; // Filtrar apenas funcionários
    $result = consultar_dado($sql);
    echo json_encode($result); // Retorna os dados em formato JSON
}

// Função para registrar no log_pessoa
function registrarLog($cpf_modificador, $cpf_alterado, $dados_antigos, $dados_novos) {
    $data = date('Y-m-d H:i:s');
    
    // Transformar arrays em variáveis pq tava quebrando minha mente
    $email_velho = $dados_antigos['email'];
    $email_novo = $dados_novos['email'];
    $nome_velho = $dados_antigos['nome'];
    $nome_novo = $dados_novos['nome'];
    $acesso_nivel_velho = $dados_antigos['acesso_nivel'];
    $acesso_nivel_novo = $dados_novos['acesso_nivel'];
    
    // Inserindo corretamente aspas nas strings
    $tabela = "log_pessoa";
    $coluna = "cpf_modificador, cpf_alterado, data, email_velho, email_novo, nome_velho, nome_novo, acesso_nivel_velho, acesso_nivel_novo";
    $valores = "'$cpf_modificador', '$cpf_alterado', '$data', '$email_velho', '$email_novo','$nome_velho', '$nome_novo', '$acesso_nivel_velho', '$acesso_nivel_novo'";
    
    // Chamando a função de inserção
    $sql = inserir_dado($tabela, $coluna, $valores);
    //var_dump($sql) // USAR APENAS EM TESTE ANIMAL VELHO
}

// Função para atualizar os dados de um funcionário
function atualizarPessoa() {
    $cpf_modificador = $_SESSION['usuario']['cpf'];
    $cpf_alterado = $_POST['cpf'];
    $email = $_POST['email'];
    $nome = $_POST['nome'];
    $registro_puc = $_POST['registro_puc'];
    $acesso_nivel = $_POST['acesso_nivel'];
    
    // Buscar os dados antigos
    $sql = "SELECT * FROM pessoa WHERE cpf='$cpf_alterado'";
    $dados_antigos = consultar_dado($sql)[0];
    
    // Atualizar os dados
    $atributos = "email='$email', nome='$nome', registro_puc='$registro_puc', acesso_nivel='$acesso_nivel'";
    $condicao = "cpf='$cpf_alterado'";
    $resultado = atualizar_dado('pessoa', $atributos, $condicao);

    // Registrar log apenas se os dados foram atualizados com sucesso
    if ($resultado === "Registro atualizado com sucesso") {
        $dados_novos = ['email' => $email, 'nome' => $nome, 'acesso_nivel' => $acesso_nivel];
        registrarLog($cpf_modificador, $cpf_alterado, $dados_antigos, $dados_novos); // Registrar log da mudança
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

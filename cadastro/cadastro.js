// Evento de clique do botão [enviar]

document.getElementById('adicionar').addEventListener('click', function() {
    var nome = document.getElementById("nome_id").value;
    var email = document.getElementById("email_id").value;
    var cpf = document.getElementById("cpf_id").value;
    var matricula = document.getElementById("matricula_id").value;
    var senha = document.getElementById("senha_id").value;
    var confirmsenha = document.getElementById("confirm").value;
    
    // Validação básica do lado do cliente
    if (!email || !senha) {
        alert('Por favor, preencha todos os campos.');
        return;
    }

    if (senha != confirmsenha) {
        alert('As Senhas não são iguais. Tente Novamente.');
        return;
    }

	var bool_ok = "";
    // Chama a função requisitar com POST e dados do formulário
    requisitar('POST', { nome: nome, email: email, cpf: cpf, matricula:matricula, senha: senha, solicitacao:"adicionar" })
        .then(result => {
            if (result.erro) {
				console.log(result);
                //console.error('Erro:', result.erro);
                alert('Ocorreu um erro ao enviar os dados. Tente novamente.');
				bool_ok = false;
            } else {
                console.log('Dados recebidos:', result.dados);
                // Limpa os campos de entrada e mostra mensagem de sucesso
                document.getElementById("nome_id").value = '';
                document.getElementById("email_id").value = '';
                document.getElementById("cpf_id").value = '';
                document.getElementById("matricula_id").value = '';
                document.getElementById("senha_id").value = '';
                alert('Dados enviados com sucesso!');
				bool_ok = true;
				
            }
			window.location.reload();	
        });
});

//Voltar Pagina.

function voltarPagina() {
    window.history.back();
}

/**
 * Realiza uma requisição HTTP ao back-end.
 * 
 * @param {string} metodo - O método HTTP a ser utilizado ("GET" ou "POST").
 * @param {Object} dados - Os dados a serem enviados (se aplicável, para POST).
 * @returns {Promise<Object>} - Um array associativo com as chaves "dados" e "erro".
 */
function requisitar(metodo, dados) {
    return new Promise((resolve) => {
        // Configuração do método e headers padrão
        let config = {
            method: metodo,
            headers: {
                'Content-Type': 'application/json'
            }
        };

        let url = 'cadastro.php';

        // Adiciona o corpo da requisição se for POST
        if (metodo === 'POST') {
            config.body = JSON.stringify(dados);
        } else if (metodo === 'GET' && dados) {
            // Constrói a URL com parâmetros de consulta
            const params = new URLSearchParams(dados).toString();
            url += '?' + params;
        }

		console.log(url);
		
        // Realiza a requisição
        fetch(url, config)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                resolve({
                    dados: data,
                    erro: null
                });
            })
            .catch(error => {
                resolve({
                    dados: null,
                    erro: error.message
                });
            });
    });
}
document.getElementById('adicionar').addEventListener('click', function() {
    window.location.href="../login/login.html" // ARRUMAR ESSE REDIRECIONAMENTO PRA PAGINA CORRETA, TA INDO PRA DE TESTE DE SESSAO
})  
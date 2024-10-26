// Evento de clique do botão [enviar]

document.getElementById('adicionar').addEventListener('click', function(event) {
    event.preventDefault();  // Isso impede o envio tradicional do formulário
    var nome = document.getElementById("nome_id").value;
    var email = document.getElementById("email_id").value;
    var cpf = document.getElementById("cpf_id").value;
    var registro = document.getElementById("registro_id").value;
    var senha = document.getElementById("senha_id").value;

    if (!email || !senha || !cpf || !registro) {
        alert('Por favor, preencha todos os campos.');
        return;
    }

    requisitar('POST', { nome: nome, email: email, cpf: cpf, registro: registro, senha: senha, solicitacao: "adicionar" })
        .then(result => {
            if (result.erro) {
                alert('Credenciais já regisradas');
            } else {
                alert('Cadastro realizado com sucesso!');
            }
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

        let url = 'efetuar_cadastro_fun.php';

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
// Evento de clique do botão [enviar]
document.getElementById('adicionar').addEventListener('click', function() {
    var email = document.getElementById("email_id").value;
    var senha = document.getElementById("senha_id").value;
    
    // Validação básica do lado do cliente
    if (!email || !senha) {
        alert('Por favor, preencha todos os campos.');
        return;
    }

	var bool_ok = "";
    // Chama a função requisitar com POST e dados do formulário
    requisitar('POST', { email: email, senha: senha, solicitacao:"adicionar" })
        .then(result => {
            if (result.erro) {
				console.log(result);
                //console.error('Erro:', result.erro);
                alert('Ocorreu um erro ao enviar os dados. Tente novamente.');
				bool_ok = false;
            } else {
                console.log('Dados recebidos:', result.dados);
                // Limpa os campos de entrada e mostra mensagem de sucesso
                document.getElementById("email_id").value = '';
                document.getElementById("senha_id").value = '';
                alert('Dados enviados com sucesso!');
				bool_ok = true;
				
            }
			window.location.reload();	
        });
});

// Evento de clique do botão [enviar]
document.getElementById('enviar').addEventListener('click', function() {
    var email = document.getElementById("email_id").value;
    var senha = document.getElementById("senha_id").value;
    
    // Validação básica do lado do cliente
    if (!email || !senha) {
        alert('Por favor, preencha todos os campos.');
        return;
    }

    // Chama a função requisitar com POST e dados do formulário
    requisitar('POST', { email: email, senha: senha, solicitacao:"consultar" })
        .then(result => {
            if (result.erro) {
                console.error('Erro:', result.erro);
                alert('Ocorreu um erro ao enviar os dados. Tente novamente.');
            } else {
                console.log('Dados recebidos:', result.dados);
                // Limpa os campos de entrada e mostra mensagem de sucesso
                document.getElementById("email_id").value = '';
                document.getElementById("senha_id").value = '';
                alert('Dados enviados com sucesso!');
            }
        });
});

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

        let url = 'back_end.php';

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

async function carregarUsuarios() {
    try {
        const { dados, erro } = await requisitar('GET', { metodo: 'listar' });
        
        if (erro) {
            console.error('Erro ao carregar os dados:', erro);
            return;
        }

        const tabelaBody = document.querySelector('#lista_usuarios tbody');
        tabelaBody.innerHTML = ''; // Limpa a tabela antes de adicionar novos dados

        dados.forEach(usuario => {
            const linha = document.createElement('tr');
            const colunaBotao = document.createElement('td');
            const botaoExcluir = document.createElement('button');
            botaoExcluir.textContent = 'Excluir'; // Texto do botão
            botaoExcluir.className = 'btn btn-danger btnExcluir'; // Adiciona as classes CSS
            botaoExcluir.dataset.id = usuario.id; // Adiciona o ID do usuário como data attribute

            colunaBotao.appendChild(botaoExcluir);
            linha.appendChild(colunaBotao);

            const colunaUsuario = document.createElement('td');
            colunaUsuario.textContent = usuario.usuario;
            linha.appendChild(colunaUsuario);

            const colunaSenha = document.createElement('td');
            colunaSenha.textContent = usuario.senha;
            linha.appendChild(colunaSenha);

            tabelaBody.appendChild(linha);
        });

        // Adiciona o listener de eventos aos botões "Excluir"
        tabelaBody.addEventListener('click', function(event) {
            if (event.target.classList.contains('btnExcluir')) {
                const id = event.target.dataset.id;
				excluirUsuario(id);
            }
        });
    } catch (error) {
        console.error('Erro ao carregar os dados:', error);
    }
}

async function carregandoPagina(){
	carregarUsuarios();
}

async function excluirUsuario(id) {
    try {
        const { erro } = await requisitar('GET', { metodo: 'excluir', id: id });

        if (erro) {
            console.error('Erro ao excluir o usuário:', erro);
            alert('Ocorreu um erro ao excluir o usuário. Tente novamente.');
        } else {
            carregarUsuarios(); // Recarregar a lista de usuários após a exclusão
        }
    } catch (error) {
        console.error('Erro ao excluir o usuário:', error);
        alert('Ocorreu um erro ao excluir o usuário. Tente novamente.');
    }
}
// Carregar os usuários quando a página estiver carregada
document.addEventListener('DOMContentLoaded', carregandoPagina);
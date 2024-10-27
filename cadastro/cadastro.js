document.getElementById('adicionar').addEventListener('click', function(event) {
    event.preventDefault();
    
    var nome = document.getElementById("nome_id").value;
    var email = document.getElementById("email_id").value;
    var cpf = document.getElementById("cpf_id").value;
    var matricula = document.getElementById("matricula_id").value;
    var senha = document.getElementById("senha_id").value;
    var confirmsenha = document.getElementById("confirm").value;
    
        // Verificação do comprimento do CPF
    if (cpf.length !== 11 || isNaN(cpf)) {
        alert('O CPF deve conter exatamente 11 dígitos numéricos.');
        return;
    }
    
    if (senha != confirmsenha) {
        alert('As Senhas não são iguais. Tente Novamente.');
        return;
    }

    // Validação básica 
    if (!nome || !email || !cpf || !senha || !confirmsenha) {
        alert('Por favor, preencha todos os campos.');
        return;
    }

    // Chama a função requisitar com POST e dados do formulário
    requisitar('POST', { nome: nome, email: email, cpf: cpf, matricula: matricula, senha: senha, solicitacao: "adicionar" })
    .then(result => {
        if (result.erro) {
            alert('Credenciais já registradas');
        } else {
            alert('Cadastro realizado com sucesso!');
            window.location.href = '../login/login.html';
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
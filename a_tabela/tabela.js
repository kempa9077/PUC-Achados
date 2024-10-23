// Função para buscar e exibir todas as pessoas da tabela
function carregarPessoas() {
    fetch('gerenciar_pessoa.php?acao=buscar')
        .then(response => response.json())
        .then(data => {
            const tabela = document.getElementById('corpoTabela');
            tabela.innerHTML = ''; // Limpar tabela

            data.forEach(pessoa => {
                const linha = document.createElement('tr');
                linha.innerHTML = `
                    <td>${pessoa.cpf}</td>
                    <td><input type="email" value="${pessoa.email}" id="email_${pessoa.cpf}"></td>
                    <td><input type="text" value="${pessoa.nome}" id="nome_${pessoa.cpf}"></td>
                    <td><input type="text" value="${pessoa.matricula}" id="matricula_${pessoa.cpf}"></td>
                    <td><input type="text" value="${pessoa.registro_puc}" id="registro_${pessoa.cpf}"></td>
                    <td><input type="number" value="${pessoa.acesso_nivel}" id="acesso_${pessoa.cpf}"></td>
                    <td>
                        <button onclick="atualizarPessoa('${pessoa.cpf}')">Update</button>
                        <button onclick="deletarPessoa('${pessoa.cpf}')">Delete</button>
                    </td>
                `;
                tabela.appendChild(linha);
            });
        });
}

// Função para atualizar os dados de uma pessoa existente
function atualizarPessoa(cpf) {
    const email = document.getElementById(`email_${cpf}`).value;
    const nome = document.getElementById(`nome_${cpf}`).value;
    const matricula = document.getElementById(`matricula_${cpf}`).value;
    const registro_puc = document.getElementById(`registro_${cpf}`).value;
    const acesso_nivel = document.getElementById(`acesso_${cpf}`).value;

    fetch('gerenciar_pessoa.php?acao=atualizar', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `cpf=${cpf}&email=${email}&nome=${nome}&matricula=${matricula}&registro_puc=${registro_puc}&acesso_nivel=${acesso_nivel}`
    })
    .then(response => response.text())
    .then(data => {
        alert(data);
        carregarPessoas(); // Recarrega a tabela após atualizar
    });
}

// Função para deletar uma pessoa
function deletarPessoa(cpf) {
    if (confirm("Tem certeza que deseja deletar essa pessoa?")) {
        fetch('gerenciar_pessoa.php?acao=deletar', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `cpf=${cpf}`
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            carregarPessoas(); // Recarrega a tabela após deletar
        });
    }
}

// Carregar os dados ao iniciar
document.addEventListener('DOMContentLoaded', carregarPessoas);

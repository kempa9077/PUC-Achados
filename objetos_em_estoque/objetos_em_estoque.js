// Função para buscar e exibir todos os objetos do estoque
function carregarObjetos() {
    fetch('objetos_em_estoque.php?acao=buscar')
        .then(response => response.json())
        .then(data => {
            const tabela = document.getElementById('corpoTabela');
            tabela.innerHTML = ''; // Limpar a tabela

            data.forEach(objeto => {
                const linha = document.createElement('tr');
                linha.innerHTML = `
                    <td>${objeto.id_objeto}</td>
                    <td>${objeto.local_bloco}</td>
                    <td>${objeto.categoria}</td>
                    <td>${objeto.nome}</td>
                    <td>${objeto.encontrado === '1' ? 'Sim' : 'Não'}</td>
                `;
                tabela.appendChild(linha);
            });
        });
}

// Carregar os objetos ao iniciar
document.addEventListener('DOMContentLoaded', carregarObjetos);

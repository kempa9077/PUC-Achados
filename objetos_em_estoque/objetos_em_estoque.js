document.addEventListener("DOMContentLoaded", function() {
    fetch('imprimir_estoque.php')
        .then(response => response.json())
        .then(data => {
            const tbodySecretaria = document.getElementById('objeto-tbody-secretaria');
            const tbodyOutros = document.getElementById('objeto-tbody-outros');

            // Limpa os corpos das tabelas
            tbodySecretaria.innerHTML = '';
            tbodyOutros.innerHTML = '';

            data.forEach(objeto => {
                const tr = document.createElement('tr');

                // Cria as células da linha
                const idCell = document.createElement('td');
                idCell.textContent = objeto.id_objeto;
                tr.appendChild(idCell);

                const nomeCell = document.createElement('td');
                nomeCell.textContent = objeto.nome;
                tr.appendChild(nomeCell);

                const secretariaCell = document.createElement('td');
                secretariaCell.textContent = objeto.secretaria;
                tr.appendChild(secretariaCell);

                const situacaoCell = document.createElement('td');
                if (objeto.encontrado == 2) {
                    situacaoCell.textContent = 'Devolvido';
                } else if (objeto.encontrado == 1) {
                    situacaoCell.textContent = 'Em Estoque';
                } else {
                    situacaoCell.textContent = 'Perdido';
                }
                tr.appendChild(situacaoCell);

                const categoriaCell = document.createElement('td');
                categoriaCell.textContent = objeto.categoria;
                tr.appendChild(categoriaCell);

                // Se o objeto não foi encontrado (encontrado == 0), adiciona o botão "Encontrado"
                if (objeto.encontrado == 0) {
                    const botaoCell = document.createElement('td');
                    const botaoEncontrado = document.createElement('button');
                    botaoEncontrado.textContent = 'Encontrado';

                    // Adiciona a função de clique no botão
                    botaoEncontrado.onclick = function() {
                        const bloco = prompt('Informe seu Bloco:');
                        if (bloco) {
                            if (confirm('Tem certeza que deseja marcar este objeto como encontrado?')) {
                                marcarComoEncontrado(objeto.id_objeto, bloco);
                            }
                        }
                    };

                    botaoCell.appendChild(botaoEncontrado);
                    tr.appendChild(botaoCell);
                }

                // Adiciona a linha à tabela correta
                if (objeto.is_secretaria == 1) {
                    tbodySecretaria.appendChild(tr);
                } else {
                    tbodyOutros.appendChild(tr);
                }
            });
        })
        .catch(error => console.error('Erro ao buscar dados:', error));
});

// Função para marcar o objeto como encontrado e enviar o novo local (bloco)
function marcarComoEncontrado(id_objeto, novo_local) {
    fetch('objeto_encontrado.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `id_objeto=${id_objeto}&novo_local=${novo_local}`
    })
    .then(response => {
        if (response.ok) {
            location.reload(); // Recarrega a página para mostrar a tabela atualizada
        } else {
            alert('Erro ao marcar o objeto como encontrado.');
        }
    })
    .catch(error => console.error('Erro ao atualizar o objeto:', error));
}

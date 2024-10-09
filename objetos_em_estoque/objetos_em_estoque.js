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
                // Verifica as situações possíveis: 0 (Perdido), 1 (Em Estoque) e 2 (Devolvido)
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

// Função para marcar o objeto como encontrado
function marcarComoEncontrado(id_objeto) {
    fetch('atualizar_objeto.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id_objeto: id_objeto })
    })
    .then(response => {
        if (response.ok) {
            // Atualiza a tabela após a mudança
            location.reload(); // Recarrega a página para mostrar a tabela atualizada
        } else {
            alert('Erro ao marcar o objeto como encontrado.');
        }
    })
    .catch(error => console.error('Erro ao atualizar o objeto:', error));
}


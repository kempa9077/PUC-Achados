document.addEventListener("DOMContentLoaded", function() {
    fetch('imprimir_estoque.php')
        .then(response => response.json())
        .then(data => {
            const tbody = document.getElementById('objeto-tbody');
            tbody.innerHTML = '';  // Limpa o corpo da tabela

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
                situacaoCell.textContent = objeto.encontrado === 1 ? 'Encontrado' : 'Perdido';
                tr.appendChild(situacaoCell);

                const categoriaCell = document.createElement('td');
                categoriaCell.textContent = objeto.categoria;
                tr.appendChild(categoriaCell);

                // Adiciona a linha à tabela
                tbody.appendChild(tr);
            });
        })
        .catch(error => console.error('Erro ao buscar dados:', error));
});

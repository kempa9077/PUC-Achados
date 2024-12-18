document.addEventListener("DOMContentLoaded", function() {
    fetch('imprimir_estoque.php')
        .then(response => response.json())
        .then(data => {
            const tbodySecretaria = document.getElementById('objeto-tbody-secretaria'); // coisas com nome secretaria vem do id_local que antes era secretaria o nome
            const tbodyOutros = document.getElementById('objeto-tbody-outros');
            const tbodyDevolvidos = document.getElementById('objeto-tbody-devolvidos'); // Tabela de itens devolvidos
            const tbodyexcluidos = document.getElementById('objeto-tbody-excluidos');
            const filterInput = document.getElementById("filter-input");

            // Limpa os corpos das tabelas
            tbodySecretaria.innerHTML = '';
            tbodyOutros.innerHTML = '';
            tbodyDevolvidos.innerHTML = ''; // Limpa a tabela de itens devolvidos
            tbodyexcluidos.innerHTML = '';

            data.forEach(objeto => {
                const tr = document.createElement('tr');
                const nomeCell = document.createElement('td');

                const idprotoCell = document.createElement('td');
                if (objeto.id_protocolo == null) {
                    idprotoCell.textContent = "-"
                } else{
                    idprotoCell.textContent = objeto.id_protocolo;
                }
                tr.appendChild(idprotoCell);

                // Cria as células da linha
                const idCell = document.createElement('td');
                idCell.textContent = objeto.id_objeto;
                tr.appendChild(idCell);

                
                const botaoNome = document.createElement('button');
                botaoNome.textContent = objeto.nome;
                botaoNome.setAttribute("class", "nome-btn")

                botaoNome.onclick = function() { verMais(objeto.id_objeto); };

                nomeCell.appendChild(botaoNome);

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

                const dataRegistroCell = document.createElement('td');
                // Formata o valor de data_registro
                const dataOriginal = objeto.data_registro;
                const dataFormatada = new Date(dataOriginal).toLocaleString('pt-BR', {
                    day: '2-digit',
                    month: '2-digit',
                    year: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit',
                });
                dataRegistroCell.textContent = dataFormatada;
                tr.appendChild(dataRegistroCell);

                const categoriaCell = document.createElement('td');
                categoriaCell.textContent = objeto.categoria;
                tr.appendChild(categoriaCell);

            
                const actionCell = document.createElement('td');

                // Se o objeto não foi encontrado (encontrado == 0), adiciona o botão "Encontrado"
                if (objeto.encontrado == 0) {
                    const botaoEncontrado = document.createElement('button');
                    botaoEncontrado.textContent = 'Encontrado';
                    botaoEncontrado.setAttribute("id", "botaoEncontrado")
                    botaoEncontrado.classList.add("botoesDeEncontro")

                    // Adiciona a função de clique no botão
                    // Adiciona a função de clique no botão "Encontrado"
                    botaoEncontrado.onclick = function() {
                        let bloco = prompt('Informe seu Bloco:');
                        
                        // Validação do bloco
                        bloco = parseInt(bloco, 10); // Converte para número inteiro
                        
                        if (isNaN(bloco)) {
                            alert('Bloco inválido! Por favor, insira um número.');
                        } else if (bloco < 1 || bloco > 10) {
                            alert('Bloco inválido! O número do bloco deve estar entre 1 e 10.');
                        } else {
                            if (confirm('Tem certeza que deseja marcar este objeto como encontrado?')) {
                                marcarComoEncontrado(objeto.id_objeto, bloco);
                            }
                        }
                    };

                    actionCell.appendChild(botaoEncontrado);
                }

                // Se o objeto foi encontrado (encontrado == 1), adiciona o botão "Devolver"
                if (objeto.encontrado == 1) {
                    const botaoDevolver = document.createElement('button');
                    botaoDevolver.textContent = 'Devolver';
                    botaoDevolver.setAttribute("id", "botaoDevolver")
                    botaoDevolver.classList.add("botoesDeDevolucao")

                    // Adiciona a função de clique no botão
                    botaoDevolver.onclick = function() {
                        const cpfRetirante = prompt('Informe o CPF da Pessoa Retirante:');
                        if (cpfRetirante) {
                            if (confirm('Tem certeza que deseja confirmar a devolução?')) {
                                marcarComoDevolvido(objeto.id_objeto, cpfRetirante);
                            }
                        }
                    };

                    actionCell.appendChild(botaoDevolver);
                }
                
                tr.appendChild(actionCell);

                tr.dataset.filterContent = `${objeto.id_protocolo} ${objeto.id_objeto} ${objeto.nome} ${objeto.secretaria} ${situacaoCell.textContent} ${dataFormatada} ${objeto.categoria} ${objeto.descricao}`;
                // Adiciona a linha à tabela correta
                if (objeto.encontrado == 2) {
                    tbodyDevolvidos.appendChild(tr); // Adiciona os itens devolvidos à tabela de devolvidos
                } else if (objeto.encontrado == 1) {
                    tbodySecretaria.appendChild(tr);
                } else if (objeto.encontrado == 0) {
                    tbodyOutros.appendChild(tr);
                } else if (objeto.encontrado == 4){
                    const trex = document.createElement('tr');
                    const nomeCell = document.createElement('td');

                    const idprotoCell = document.createElement('td');
                    if (objeto.id_protocolo == null) {
                        idprotoCell.textContent = "-"
                    } else{
                        idprotoCell.textContent = objeto.id_protocolo;
                    }
                    trex.appendChild(idprotoCell);

                    const idCell = document.createElement('td');
                    idCell.textContent = objeto.id_objeto;
                    trex.appendChild(idCell);

                    const botaoNome = document.createElement('button');
                    botaoNome.textContent = objeto.nome;
                    botaoNome.setAttribute("class", "nome-btn")

                    botaoNome.onclick = function() { verMais(objeto.id_objeto); };

                    nomeCell.appendChild(botaoNome);

                    trex.appendChild(nomeCell);

                    const categoriaCell = document.createElement('td');
                    categoriaCell.textContent = objeto.categoria;
                    trex.appendChild(categoriaCell);

                    const dataRegistroCell = document.createElement('td');
                    // Formata o valor de data_registro
                    const dataOriginal = objeto.data_registro;
                    const dataFormatada = new Date(dataOriginal).toLocaleString('pt-BR', {
                        day: '2-digit',
                        month: '2-digit',
                        year: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit',
                        second: '2-digit',
                    });
                    dataRegistroCell.textContent = dataFormatada;
                    trex.appendChild(dataRegistroCell);


                    tbodyexcluidos.appendChild(trex);
                }
            });

            // Adiciona evento de input ao campo de filtro
            filterInput.addEventListener("input", filtrarLogs);
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
            alert('Operação realizada com sucesso.');
            // -- POR ALGUM MOTIVO N ESTA RECARREGANDO A PAGINA
            location.reload(); // Recarrega a página para mostrar a tabela atualizada
        } else {
            alert('Erro ao marcar o objeto como encontrado.');
        }
    })
    .catch(error => console.error('Erro ao atualizar o objeto:', error));
}

// Função para marcar o objeto como devolvido e verificar o CPF do retirante
function marcarComoDevolvido(id_objeto, cpfRetirante) {
    fetch('objeto_devolvido.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `id_objeto=${id_objeto}&pessoa_retirante=${cpfRetirante}`
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            alert('Devolução realizada com sucesso.');
            location.reload(); // Recarrega a página para mostrar a tabela atualizada
        } else if (result.error == 'usuario_nao_encontrado') {
            alert('Usuário não cadastrado.');
        } else {
            alert('Erro ao registrar a devolução.');
        }

    })
    .catch(error => console.error('Erro ao registrar a devolução:', error));

}
// Função para filtrar os logs
function filtrarLogs() {
    const filterInput = document.getElementById('filter-input');

    const termoFiltro = filterInput.value.toLowerCase();
    const tabelas = [document.getElementById('objeto-tbody-secretaria'), document.getElementById('objeto-tbody-outros'), document.getElementById('objeto-tbody-devolvidos')];
    
    tabelas.forEach(tbody => {
        const linhas = tbody.getElementsByTagName("tr");
        Array.from(linhas).forEach(linha => {
            const conteudoLinha = linha.dataset.filterContent.toLowerCase();
            linha.style.display = conteudoLinha.includes(termoFiltro) ? "" : "none";
        });
    });

    
}

window.verMais = function(idobjeto) {
    // Abre a página objeto_vermais.php com o idobjeto como parâmetro na URL
    window.open(`../objeto_vermais/objeto_vermais.php?idobjeto=${encodeURIComponent(idobjeto)}`);
};

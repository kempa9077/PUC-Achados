document.addEventListener("DOMContentLoaded", function() {
    const tbody = document.getElementById("protocolos-tbody");
    const filterInput = document.getElementById("filter-input");

    function carregarProtocolos() {
        // Fazendo a requisição AJAX para buscar os protocolos
        fetch('imprimir_meus_protocolos.php?acao=buscar')
            .then(response => response.json())
            .then(data => {
                if (Array.isArray(data)) {
                    // Limpa o tbody antes de adicionar novos dados
                    tbody.innerHTML = '';

                    // Itera sobre os dados retornados
                    data.forEach(protocolo => {
                        const tr = document.createElement("tr");

                        const situacaoCell = document.createElement('td');
                        if (protocolo.protocolo_situacao == 2) {
                            situacaoCell.textContent = 'Devolvido';
                        } else if (protocolo.protocolo_situacao == 1) {
                            situacaoCell.textContent = 'Encontrado';
                        } else {
                            situacaoCell.textContent = 'Perdido';
                        }

                        const localcell = document.createElement('td');
                        if (protocolo.protocolo_achado_local == 1 && protocolo.protocolo_situacao == 1) {
                            localcell.textContent = 'Secretaria Bloco 1';
                        } else if (protocolo.protocolo_achado_local == 2 && protocolo.protocolo_situacao == 1) {
                            localcell.textContent = 'Secretaria Bloco 2';
                        } else if (protocolo.protocolo_achado_local == 3 && protocolo.protocolo_situacao == 1) {
                            localcell.textContent = 'Secretaria Bloco 3';
                        } else if (protocolo.protocolo_achado_local == 4 && protocolo.protocolo_situacao == 1) {
                            localcell.textContent = 'Secretaria Bloco 4';
                        } else if (protocolo.protocolo_achado_local == 5 && protocolo.protocolo_situacao == 1) {
                            localcell.textContent = 'Secretaria Bloco 5';
                        } else if (protocolo.protocolo_achado_local == 6 && protocolo.protocolo_situacao == 1) {
                            localcell.textContent = 'Secretaria Bloco 6';
                        } else if (protocolo.protocolo_achado_local == 7 && protocolo.protocolo_situacao == 1) {
                            localcell.textContent = 'Secretaria Bloco 7';
                        } else if (protocolo.protocolo_achado_local == 8 && protocolo.protocolo_situacao == 1) {
                            localcell.textContent = 'Secretaria Bloco 8';
                        } else if (protocolo.protocolo_achado_local == 9 && protocolo.protocolo_situacao == 1) {
                            localcell.textContent = 'Secretaria Bloco 9';
                        } else if (protocolo.protocolo_achado_local == 10 && protocolo.protocolo_situacao == 1) {
                            localcell.textContent = 'Secretaria Bloco 10';
                        } else {
                            localcell.textContent = '-';
                        }

                        // Adiciona as células da tabela
                        tr.innerHTML = `
                            <td>${protocolo.idprotocolo}</td>
                            <td>${protocolo.nome_objeto}</td>
                            <td>${protocolo.nome_categoria || '-'}</td>                    
                            <td>${protocolo.data_perda}</td>
                            <td>${protocolo.data_abertura}</td>
                            <td>${protocolo.data_fechamento || '-'}</td>
                            
                        `;

                        tr.appendChild(situacaoCell);
                        tr.appendChild(localcell);

                         // Adiciona um atributo data para facilitar o filtro
                         tr.dataset.filterContent = `${protocolo.idprotocolo} ${protocolo.nome_objeto} ${protocolo.nome_categoria} ${protocolo.data_perda} ${protocolo.data_abertura}${protocolo.data_fechamento} ${protocolo.protocolo_situacao} ${protocolo.protocolo_achado_local}`;

                        // Adiciona a linha na tabela
                        tbody.appendChild(tr);
                    });
                } else {
                    console.error("Dados inválidos recebidos:", data);
                }
            })
            .catch(error => {
                console.error("Erro ao carregar os protocolos:", error);
            });
    }
    // Função para filtrar os logs
    function filtrarLogs() {
        const termoFiltro = filterInput.value.toLowerCase();
        const linhas = tbody.getElementsByTagName("tr");

        Array.from(linhas).forEach(linha => {
            const conteudoLinha = linha.dataset.filterContent.toLowerCase();
            linha.style.display = conteudoLinha.includes(termoFiltro) ? "" : "none";
        });
    }

    // Carrega os logs quando a página é carregada
    carregarProtocolos();

    // Adiciona evento de input ao campo de filtro
    filterInput.addEventListener("input", filtrarLogs);
});

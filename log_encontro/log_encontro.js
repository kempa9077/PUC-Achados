document.addEventListener("DOMContentLoaded", function() {
    const tbody = document.getElementById("log-tbody");
    const filterInput = document.getElementById("filter-input");

    function carregarLogs() {
        // Fazendo a requisição AJAX para buscar os logs de encontro
        fetch('imprimir_logs.php?acao=buscar')
            .then(response => response.json())
            .then(data => {
                if (Array.isArray(data)) {
                    // Limpa o tbody antes de adicionar novos dados
                    tbody.innerHTML = '';

                    // Itera sobre os dados retornados
                    data.forEach(log => {
                        const tr = document.createElement("tr");
                        // Converte a data para o formato desejado
                        const situacaoantigoCell = document.createElement('td');
                        if (log.valor_antigo == 2) {
                            situacaoantigoCell.textContent = 'Devolvido';
                        } else if (log.valor_antigo == 1) {
                            situacaoantigoCell.textContent = 'Em Estoque';
                        } else {
                            situacaoantigoCell.textContent = 'Perdido';
                        }

                        const situacaonovaCell = document.createElement('td');
                        if (log.valor_novo == 2) {
                            situacaonovaCell.textContent = 'Devolvido';
                        } else if (log.valor_novo == 1) {
                            situacaonovaCell.textContent = 'Em Estoque';
                        } else {
                            situacaonovaCell.textContent = 'Perdido';
                        }

                        const dataOriginal = new Date(log.data);
                        const dataFormatada = `${String(dataOriginal.getDate()).padStart(2, '0')}/${
                            String(dataOriginal.getMonth() + 1).padStart(2, '0')}/${
                            dataOriginal.getFullYear()} ${
                            String(dataOriginal.getHours()).padStart(2, '0')}:${
                            String(dataOriginal.getMinutes()).padStart(2, '0')
                        }`;

                        // Adiciona as células da tabela
                        tr.innerHTML = `
                            <td>${log.id_log}</td>
                            <td>${log.id_objeto}</td>
                            <td>${log.funcionario}</td>
                            <td>${dataFormatada}</td>
                        `;

                        tr.appendChild(situacaoantigoCell);
                        tr.appendChild(situacaonovaCell);

                        tr.dataset.filterContent = `${log.id_log} ${log.id_objeto} ${log.funcionario} ${dataFormatada} ${situacaoantigoCell} ${situacaonovaCell}`;

                        // Adiciona a linha na tabela
                        tbody.appendChild(tr);
                    });
                } else {
                    console.error("Dados inválidos recebidos:", data);
                }
            })
            .catch(error => {
                console.error("Erro ao carregar os logs:", error);
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
    carregarLogs();

    // Adiciona evento de input ao campo de filtro
    filterInput.addEventListener("input", filtrarLogs);
});

document.addEventListener("DOMContentLoaded", function() {
    const tbody = document.getElementById("protocolos-tbody");
    const filterInput = document.getElementById("filter-input");

    function carregarProtocolos() {
        // Fazendo a requisição AJAX para buscar os protocolos
        fetch('imprimir_protocolos.php?acao=buscar')
            .then(response => response.json())
            .then(data => {
                if (Array.isArray(data)) {
                    // Limpa o tbody antes de adicionar novos dados
                    tbody.innerHTML = '';

                    // Itera sobre os dados retornados
                    data.forEach(protocolo => {
                        const tr = document.createElement("tr");

                        // Adiciona as células da tabela
                        tr.innerHTML = `
                            <td>${protocolo.idprotocolo}</td>
                            <button class="nome-btn" onclick="verMais(${protocolo.idprotocolo})">${protocolo.nome_objeto}</button>
                            <td>${protocolo.nome_categoria || '-'}</td>
                            <td>${protocolo.situacao == 1 ? 'Fechado' : 'Aberto'}</td>
                            <td>${protocolo.data_perda}</td>
                            <td>${protocolo.data_abertura}</td>
                            <td>${protocolo.data_fechamento || '-'}</td>
                            
                        `;
                            // ver pq situação não filtra tentar especificar melhor
                        tr.dataset.filterContent = `${protocolo.idprotocolo} ${protocolo.nome_objeto} ${protocolo.nome_categoria} ${protocolo.situacao} ${protocolo.data_perda} ${protocolo.data_abertura}${protocolo.data_fechamento }`;
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

    window.verMais = function(idprotocolo) {
        // Abre a página protocolo_vermais.php com o idprotocolo como parâmetro na URL
        window.open(`../protocolo_vermais/protocolo_vermais.php?idprotocolo=${encodeURIComponent(idprotocolo)}`, '_blank');
    };

    // Carrega os logs quando a página é carregada
    carregarProtocolos();

    // Adiciona evento de input ao campo de filtro
    filterInput.addEventListener("input", filtrarLogs);
});

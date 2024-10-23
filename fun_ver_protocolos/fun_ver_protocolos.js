document.addEventListener("DOMContentLoaded", function() {
    const tbody = document.getElementById("protocolos-tbody");

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
                            <td>${protocolo.nome_objeto}</td>
                            <td>${protocolo.nome_categoria || '-'}</td>
                            <td>${protocolo.situacao == 1 ? 'Fechado' : 'Aberto'}</td>
                            <td>${protocolo.data_perda}</td>
                            <td>${protocolo.data_abertura}</td>
                            <td>${protocolo.data_fechamento || '-'}</td>
                            
                        `;

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

    // Carrega os protocolos quando a página é carregada
    carregarProtocolos();
});

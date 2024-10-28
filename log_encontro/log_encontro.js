document.addEventListener("DOMContentLoaded", function() {
    const tbody = document.getElementById("log-tbody");

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
                        const dataOriginal = new Date(log.data);
                        const dataFormatada = `${String(dataOriginal.getDate()).padStart(2, '0')}/${
                            String(dataOriginal.getMonth() + 1).padStart(2, '0')}/${
                            dataOriginal.getFullYear()} ${
                            String(dataOriginal.getHours()).padStart(2, '0')}:${
                            String(dataOriginal.getMinutes()).padStart(2, '0'),
                            String(dataOriginal.getSeconds()).padStart(2, '0')
                        }`;

                        // Adiciona as células da tabela
                        tr.innerHTML = `
                            <td>${log.id_log}</td>
                            <td>${log.id_objeto}</td>
                            <td>${log.funcionario}</td>
                            <td>${dataFormatada}</td>
                            <td>${log.valor_antigo}</td>
                            <td>${log.valor_novo}</td>
                        `;

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

    // Carrega os logs quando a página é carregada
    carregarLogs();
});

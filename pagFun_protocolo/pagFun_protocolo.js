document.addEventListener("DOMContentLoaded", () => {
    const tableBody = document.querySelector("tbody");

    // Função para carregar os protocolos do servidor
    function carregarProtocolos() {
        fetch('pagFun_protocolo.php')
            .then(response => response.json())
            .then(data => {
                data.forEach(protocolo => {
                    // Cria a linha da tabela para cada protocolo
                    const row = document.createElement('tr');
                    row.setAttribute("descricao-do-item", protocolo.nome);

                    row.innerHTML = `
                        <td>${protocolo.id_protocolo}</td>
                        <td>${protocolo.nome}</td>
                        <td>${protocolo.categoria}</td>
                        <td>${protocolo.situacao}</td>
                        <td>${protocolo.data_perda}</td>
                        <td>${protocolo.data_abertura}</td>
                        <td>${protocolo.data_fechamento}</td>
                    `;

                    tableBody.appendChild(row);
                });

                adicionarEventoDescricao();
            })
            .catch(error => console.error('Erro ao carregar protocolos:', error));
    }

    // Função para adicionar evento de descrição
    function adicionarEventoDescricao() {
        const rows = document.querySelectorAll("tbody tr");

        rows.forEach(row => {
            row.addEventListener("click", function() {
                let nextRow = this.nextElementSibling;
                if (nextRow && nextRow.classList.contains("description-row")) {
                    nextRow.remove();
                } else {
                    const descriptionRow = document.createElement("tr");
                    descriptionRow.classList.add("description-row");  
                    const descriptionCell = document.createElement("td");
                    descriptionCell.colSpan = 7; 
                    descriptionCell.classList.add("description");
                    descriptionCell.textContent = this.getAttribute("descricao-do-item");

                    descriptionRow.appendChild(descriptionCell);
                    this.after(descriptionRow);
                }
            });
        });
    }

    // Chama a função para carregar os protocolos quando a página for carregada
    carregarProtocolos();
});

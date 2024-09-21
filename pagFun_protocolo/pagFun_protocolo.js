// função para exibir a linha de descrição do item

document.addEventListener("DOMContentLoaded", () => {
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
});

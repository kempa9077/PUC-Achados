document.addEventListener('DOMContentLoaded', function() {
    carregarCategorias();
    carregarBlocos();
});

// Função para carregar categorias do banco de dados
function carregarCategorias() {
    fetch('carregar_categorias.php')
        .then(response => response.json())
        .then(data => {
            console.log(data);
            const tipoItem = document.getElementById('tipo_item');
            data.forEach(categoria => {
                const option = document.createElement('option');
                option.value = categoria.id; // Ajuste conforme a chave primária
                option.textContent = categoria.categoria; // Ajuste conforme o nome da categoria
                tipoItem.appendChild(option);
            });
        });
}

// Função para carregar blocos do banco de dados
function carregarBlocos() {
    fetch('carregar_blocos.php')
        .then(response => response.json())
        .then(data => {
            const arrBlocos = [];
            data.forEach(local => {
                arrBlocos[local.bloco] = local.bloco;
            });

            const blocoEncontro = document.getElementById('bloco_encontro');
            arrBlocos.forEach(bloco => {
                const option = document.createElement('option');
                option.value = bloco; // Ajuste conforme a chave primária
                option.textContent = bloco; // Ajuste conforme o nome do bloco
                blocoEncontro.appendChild(option);
            });
        });
}

function carregarSalas(id_bloco) {
    fetch(`carregar_salas.php?id_bloco=${id_bloco}`)
        .then(response => response.json())
        .then(data => {
            const salaEncontro = document.getElementById('sala_encontro');
            data.forEach(bloco => {
                const option = document.createElement('option');
                if(id_bloco === data.bloco){
                    option.value = data.id_local; // Ajuste conforme a chave primária
                    option.textContent = data.sala; // Ajuste conforme o nome do bloco
                    salaEncontro.appendChild(option);
                }
            });
        });
}



// Função para habilitar/desabilitar campos de bloco e sala
function caixaBlocos() {
    const isChecked = document.getElementById('checkbox_bloco').checked;
    const blocoSelect = document.getElementById('bloco_encontro');
    const salaSelect = document.getElementById('sala_encontro');

    blocoSelect.disabled = isChecked;
    salaSelect.disabled = isChecked;
}

// 1º - Criar o listener do SELECT on change do Bloco (categoria)
// 2º - Na chamada, pegar o value do option selecionado e passar por parametro para  a função carregar salas
// 3º - Ajustar e dar debug console para verificar o retorno do data filtrado

// Função para habilitar/desabilitar campo de data
function caixaData() {
    const isChecked = document.getElementById('checkbox_data').checked;
    document.getElementById('date').disabled = isChecked;
}

// Função para enviar o protocolo
document.getElementById('enviar_objeto').addEventListener('click', function() {
    const nomeItem = document.getElementById('nome_item').value;
    const tipoItem = document.getElementById('tipo_item').value;
    const blocoEncontro = document.getElementById('bloco_encontro').value;
    const salaEncontro = document.getElementById('sala_encontro').value;
    const dataPerda = document.getElementById('date').value;
    const descricao = document.getElementById('descricao').value;

    fetch('registrar_protocolo.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `nome_item=${encodeURIComponent(nomeItem)}&tipo_item=${tipoItem}&bloco_encontro=${blocoEncontro}&sala_encontro=${salaEncontro}&data_perda=${dataPerda}&descricao=${encodeURIComponent(descricao)}`
    })
    .then(response => response.text())
    .then(data => {
        alert(data);
        // Limpar campos após envio
        document.getElementById('nome_item').value = '';
        document.getElementById('tipo_item').selectedIndex = 0;
        document.getElementById('bloco_encontro').selectedIndex = 0;
        document.getElementById('sala_encontro').selectedIndex = 0;
        document.getElementById('date_encontrado').value = '';
        document.getElementById('descricao').value = '';
    });
});

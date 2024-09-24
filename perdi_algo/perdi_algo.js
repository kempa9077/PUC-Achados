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

// 1º - Criar o listener do SELECT on change do Bloco (categoria)
// 2º - Na chamada, pegar o value do option selecionado e passar por parametro para  a função carregar salas
// 3º - Ajustar e dar debug console para verificar o retorno do data filtrado

// 1º - Criar o listener do SELECT on change do Bloco
document.getElementById('bloco_encontro').addEventListener('change', function() {
    const blocoSelecionado = this.value;
    
    console.log('Bloco selecionado:', blocoSelecionado); // Debug para verificar o valor
    carregarSalas(blocoSelecionado); // 2º - Chama a função carregarSalas com o bloco selecionado
});

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

            // 1. Automaticamente carrega as salas do bloco 1 ao iniciar a página
            carregarSalas(1);
        });
}

// Função para carregar salas filtrando secretarias
function carregarSalas(id_bloco) {
    fetch(`carregar_salas.php?id_bloco=${id_bloco}`)
        .then(response => response.json())
        .then(data => {
            const salaEncontro = document.getElementById('sala_perda');
            salaEncontro.innerHTML = ''; // Limpa as opções anteriores

            data.forEach(local => {
                if (local.tipo !== 'secretaria') { // 2. Filtra secretarias
                    const option = document.createElement('option');
                    option.value = local.id_local; // Ajuste conforme a chave primária
                    option.textContent = local.sala; // Nome da sala
                    salaEncontro.appendChild(option);
                }
            });
        })
        .catch(error => {
            console.error('Erro ao carregar as salas:', error);
        });
}

// Isso deve fazer as salas serem carregas assim que entramos na pagina, eu acho 
document.getElementById('bloco_encontro').addEventListener('change', function() {
    const id_bloco = this.value;
    carregarSalas(id_bloco); // Carrega as salas do bloco selecionado
});

/*
// Função para habilitar/desabilitar campo de data
function caixaData() {
    const isChecked = document.getElementById('checkbox_data').checked;
    document.getElementById('date').disabled = isChecked;
}
/*
// Função para habilitar/desabilitar campos de bloco e sala
function caixaBlocos() {
    const isChecked = document.getElementById('checkbox_bloco').checked;
    const blocoSelect = document.getElementById('bloco_encontro');
    const salaSelect = document.getElementById('sala_perda');

    blocoSelect.disabled = isChecked;
    salaSelect.disabled = isChecked;
}
*/

// Função para enviar o protocolo
document.getElementById('enviar_objeto').addEventListener('click', function() {
    const nomeItem = document.getElementById('nome_item').value;
    const tipoItem = document.getElementById('tipo_item').value; // A categoria, não o id
    const blocoEncontro = document.getElementById('bloco_encontro').value;
    const salaEncontro = document.getElementById('sala_perda').value;
    const dataPerda = document.getElementById('data_perda').value;
    const descricao = document.getElementById('descricao').value;

    console.log({
        nomeItem, 
        tipoItem, 
        blocoEncontro, 
        salaEncontro, 
        dataPerda, 
        descricao
    });
    
    const formData = `nome_item=${encodeURIComponent(nomeItem)}&tipo_item=${encodeURIComponent(tipoItem)}&bloco_encontro=${encodeURIComponent(blocoEncontro)}&sala_perda=${encodeURIComponent(sala_perda)}&data_perda=${encodeURIComponent(dataPerda)}&descricao=${encodeURIComponent(descricao)}`;

    fetch('registrar_protocolo.php?acao=buscar', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: formData
    })
    })
    .then(response => response.json())
    .then(data => {
        if (data.sucesso) {
            alert(data.sucesso);
            // Limpar campos após envio
        } else if (data.erro) {
            alert(data.erro);
        }
    })
    .catch(error => {
        console.error('Erro ao processar a requisição:', error);
    });


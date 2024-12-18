document.addEventListener('DOMContentLoaded', function() {
    carregarCategorias();
    carregarBlocos();
});
// limita o calendario para a data do dia atual, NA TEORIA
document.addEventListener('DOMContentLoaded', function() {
    const today = new Date().toISOString().split('T')[0]; // Obtém a data atual no formato YYYY-MM-DD como é em bd sql
    const dataPerdaInput = document.getElementById('data_perda');
    
    // Define o valor padrão e o valor máximo como o dia atual
    dataPerdaInput.value = today;
    dataPerdaInput.setAttribute('max', today);
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
                option.value = categoria.id_tipo; // Ajuste conforme a chave primária
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

// Função para enviar o protocolo, pode ta certo, pode estar errado
document.getElementById('enviar_objeto').addEventListener('click', function() {
    const nomeItem = document.getElementById('nome_item').value;
    const tipoItem = document.getElementById('tipo_item').value;
    const blocoEncontro = document.getElementById('bloco_encontro').value;
    const salaEncontro = document.getElementById('sala_perda').value;
    const dataPerda = document.getElementById('data_perda').value;
    const descricao = document.getElementById('descricao').value;

        // validação para não colocar apenas espaço
    if (nomeItem.trim() ==="" ) {
        alert('Por favor, insira um Nome válido');
        return;
    }
        
        // Validação básica 
    if (!nomeItem) {
        alert('Por favor Informe o nome do item.');
        return;
    }

    const formData = `acao=buscar&nome_item=${encodeURIComponent(nomeItem)}&tipo_item=${encodeURIComponent(tipoItem)}&bloco_encontro=${encodeURIComponent(blocoEncontro)}&sala_perda=${encodeURIComponent(salaEncontro)}&data_perda=${encodeURIComponent(dataPerda)}&descricao=${encodeURIComponent(descricao)}`;

    fetch('registrar_protocolo.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: formData
    })
    .then(response => response.json())

    .then(data => {
        if (data.sucesso) {
            alert(data.sucesso);
            window.location.href = "../index.php";
        } else if (data.erro) {
            alert(data.erro);
        }
    })
    .catch(error => {
        console.error('Erro ao processar a requisição:', error);
    });
});

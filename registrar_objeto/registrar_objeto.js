document.addEventListener('DOMContentLoaded', function() {
    carregarCategorias();
    carregarBlocos();
    
    // Listener para o botão registrar, agora dentro do DOMContentLoaded
    document.getElementById('botao_registrar').addEventListener('click', function() {
        const nome_item = document.getElementById('nome_item').value;
        const tipo_item = document.getElementById('tipo_item').value;
        const sala_encontro = document.getElementById('sala_encontro').value;

        // Faz a requisição para registrar o objeto
        fetch('registrar_objeto.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `nome_item=${nome_item}&tipo_item=${tipo_item}&sala_encontro=${sala_encontro}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.resultado) {
                alert('Objeto registrado com sucesso! ID: ' + data.resultado);
            } else {
                alert('Erro ao registrar objeto: ' + data.erro);
            }
        })
        .catch(error => {
            console.error('Erro:', error);
        });
    });
});

function carregarCategorias() {
    fetch('../perdi_algo/carregar_categorias.php')
        .then(response => response.json())
        .then(data => {
            console.log(data);
            const tipoItem = document.getElementById('tipo_item');
            data.forEach(categoria => {
                const option = document.createElement('option');
                option.value = categoria.id_tipo; 
                option.textContent = categoria.categoria; 
                tipoItem.appendChild(option);
            });
        });
}

function carregarBlocos() {
    fetch('../perdi_algo/carregar_blocos.php')
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
            
            // Carrega as salas do primeiro bloco ao iniciar a página
            carregarSalas(1);
        });
}

function carregarSalas(id_bloco) {
    fetch(`../perdi_algo/carregar_salas.php?id_bloco=${id_bloco}`)
        .then(response => response.json())
        .then(data => {
            const salaEncontro = document.getElementById('sala_encontro');
            salaEncontro.innerHTML = ''; // Limpa o campo quando atualizar

            data.forEach(local => {
                if (local.tipo !== 'secretaria') { // filtra secretarias
                    const option = document.createElement('option');
                    option.value = local.id_local; 
                    option.textContent = local.sala; 
                    salaEncontro.appendChild(option);
                }
            });
        })
        .catch(error => {
            console.error('Erro ao carregar as salas:', error);
        });
}

// Listener para carregar salas quando o bloco é selecionado
document.getElementById('bloco_encontro').addEventListener('change', function() {
    const id_bloco = this.value;
    carregarSalas(id_bloco); // Carrega as salas do bloco selecionado
});

/* Código comentado de funcionalidades futuras */
// Função para habilitar/desabilitar campo de data
/*
function caixaData() {
    const isChecked = document.getElementById('checkbox_data').checked;
    document.getElementById('date_encontrado').disabled = isChecked;
}

// Função para habilitar/desabilitar campos de bloco e sala
function caixaBlocos() {
    const isChecked = document.getElementById('checkbox_bloco').checked;
    const blocoSelect = document.getElementById('bloco_encontro');
    const salaSelect = document.getElementById('sala_encontro');

    blocoSelect.disabled = isChecked;
    salaSelect.disabled = isChecked;
}

// Listener para carregar salas quando o bloco é selecionado
document.getElementById('bloco_encontro').addEventListener('change', function() {
    const blocoSelecionado = this.value;
    carregarSalas(blocoSelecionado);
});
*/

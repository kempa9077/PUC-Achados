document.addEventListener('DOMContentLoaded', function() {
    carregarCategorias();
    carregarBlocos();
    
    // Listener para o botão registrar
    document.getElementById('botao_registrar').addEventListener('click', function() {
        const nome_item = document.getElementById('nome_item').value;
        const tipo_item = document.getElementById('tipo_item').value;
        const id_local = document.getElementById('bloco_encontro').value; // Agora id_local é o mesmo que bloco_encontro NA TEORIA

        if (nome_item.trim() ==="") {
            alert('Por favor, insira informações válidas');
            return;
        }
                    // Validação básica 
        if (!nome_item) {
            alert('Por favor Informe o nome do item.');
            return;
        }
        // Faz a requisição para registrar o objeto
        fetch('efetua_registro.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `nome_item=${nome_item}&tipo_item=${tipo_item}&bloco_encontro=${id_local}` // Passando id_local NA TEORIA
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
    fetch('../protocolo_perda/carregar_categorias.php')
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
    fetch('../protocolo_perda/carregar_blocos.php')
        .then(response => response.json())
        .then(data => {
            const arrBlocos = [];
            data.forEach(local => {
                arrBlocos[local.bloco] = local.bloco;
            });

            const blocoEncontro = document.getElementById('bloco_encontro');
            arrBlocos.forEach(bloco => {
                const option = document.createElement('option');
                option.value = bloco; 
                option.textContent = bloco; 
                blocoEncontro.appendChild(option);
            });
        });
};

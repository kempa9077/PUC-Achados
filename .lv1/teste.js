document.getElementById('enviar_objeto').addEventListener('buscar', function() {
    const nomeItem = document.getElementById('nome_item').value;
    const tipoItem = document.getElementById('tipo_item').value;
    const blocoEncontro = document.getElementById('bloco_encontro').value;
    const salaEncontro = document.getElementById('sala_perda').value;
    const dataPerda = document.getElementById('data_perda').value;
    const descricao = document.getElementById('descricao').value;

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
        } else if (data.erro) {
            alert(data.erro);
        }
    })
    .catch(error => {
        console.error('Erro ao processar a requisição:', error);
    });
});

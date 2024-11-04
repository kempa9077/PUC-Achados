document.addEventListener("DOMContentLoaded", function() {
    const divprotocolo = document.getElementById("protocolo-div");
    const urlParams = new URLSearchParams(window.location.search);
    const idobjeto = urlParams.get('idobjeto');

    document.getElementById("titulo").innerHTML = " &nbsp; Objeto #" + idobjeto;

    function buscarObjeto() {
        fetch('imprimir_objeto.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `acao=buscar&idobjeto=${encodeURIComponent(idobjeto)}`
        })
        .then(response => response.json())
        .then(data => {
            if (Array.isArray(data) || data) {
                divprotocolo.innerHTML = ''; 
                
                [data].flat().forEach(objeto => {
                    const dataOriginal = objeto.data_registro;
                    const dataFormatada = new Date(dataOriginal).toLocaleString('pt-BR', {
                        day: '2-digit',
                        month: '2-digit',
                        year: 'numeric',
                        hour: '2-digit',
                        minute: '2-digit',
                        second: '2-digit',
                    });
                    

                    const localCell = objeto.encontrado == 2 ? "LOCAL DEVOLVIDO" : objeto.encontrado == 1 ? 'LOCAL ARMAZENADO' : 'LOCAL PERDIDO';

                    const situacaoCell = objeto.encontrado == 2 ? 'Devolvido' : objeto.encontrado == 1 ? 'Em Estoque' : 'Perdido';

                    const idprotoCell = objeto.id_protocolo == null ? '-' : objeto.id_protocolo;

                    divprotocolo.innerHTML += `
                        <div class="menu-principal"> 
                            <div class="opt-menu-principal">
                                <div class="titulo-opt"><a>ID PROTOCOLO:</a></div>
                                <a class="descricao-a">${idprotoCell}</a>
                            </div>
                            <div class="opt-menu-principal">
                                <div class="titulo-opt"><a>ID OBJETO:</a></div>
                                <a class="descricao-a">${objeto.id_objeto}</a>
                            </div>
                            <div class="opt-menu-principal">
                                <div class="titulo-opt"><a>NOME:</a></div>
                                <a class="descricao-a">${objeto.nome}</a>
                            </div>
                            <div class="opt-menu-principal">
                                <div class="titulo-opt"><a>CATEGORIA:</a></div>
                                <a class="descricao-a">${objeto.categoria}</a>
                            </div>
                        </div>
                        <div class="menu-principal"> 
                            <div class="opt-menu-principal">
                                <div class="titulo-opt"><a>SITUAÇÃO:</a></div>
                                <a class="descricao-a">${situacaoCell}</a>
                            </div>
                            <div class="opt-menu-principal">
                                <div class="titulo-opt"><a>${localCell}:</a></div>
                                <a class="descricao-a">${objeto.secretaria}</a>
                            </div>
                            <div class="opt-menu-principal">
                                <div class="titulo-opt"><a>DATA DE REGISTRO:</a></div>
                                <a class="descricao-a">${dataFormatada}</a>
                            </div>
                        </div>
                        <div class="menu-principal"> 
                            <div class="opt-desc">
                                <div class="titulo-desc"><a>DESCRIÇÃO:</a></div>
                                <a class="descricao">${objeto.descricao_objeto != null ? objeto.descricao_objeto : '-'}</a>
                            </div>
                        </div>
                    `;
                    document.title = `PUC Achados - Objeto #${objeto.id_objeto}`;
                });
            } else {
                console.error("Dados inválidos recebidos:", data);
            }
        })
        .catch(error => {
            console.error("Erro ao carregar os Objetos:", error);
        });
    }

    const btnCell = document.getElementById("btn-sobrescrever");

    btnCell.innerHTML += `
            <button class="btn-merge" onclick="excluirObjeto(${idobjeto})">Fundir à outro Objeto</button>                     
    `;

    window.excluirObjeto = function(idobjeto) {

        if (!idobjeto) {
            alert("ID do objeto não fornecido.");
            return;
        }
    
        if (confirm("Tem certeza de que deseja fundir esse protocolo à outro? \n\nFazendo isso você apagará o objeto atual do Banco de Dados e passará a data de registro mais antiga ao outro objeto")) {
            let id_sobrescrito = prompt('Informe o ID do objeto a ser sobrescrito:');
            

            if (!id_sobrescrito) {
                alert("ID do objeto a ser sobrescrito não foi fornecido.");
                return;
            }
    
            fetch('imprimir_objeto.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `acao=excluir&idobjeto=${encodeURIComponent(idobjeto)}&idobjetosobrescritos=${encodeURIComponent(id_sobrescrito)}`
            })
            .then(response => response.json())
            .then(data => {
                console.log('Resposta do servidor:', data);
                if (data.sucesso) {
                    alert(data.sucesso);
                    window.location.replace(`../objeto_vermais/objeto_vermais.php?idobjeto=${encodeURIComponent(id_sobrescrito)}`);
                } else {
                    alert(data.erro);
                }
            })
            .catch(error => {
                console.error('Erro ao excluir o objeto:', error);
                alert("Erro ao processar a solicitação. \n\nVerifique se você digitou um Objeto sem Protocolo Atribuído, ou se os dois Objetos têm Protocolos Atribuídos");
            });
        }
    }
    

    // Chama a função para buscar o protocolo
    buscarObjeto();
});

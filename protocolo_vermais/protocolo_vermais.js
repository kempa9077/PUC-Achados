document.addEventListener("DOMContentLoaded", function() {
    // Captura o ID do protocolo da URL
    const divprotocolo = document.getElementById("protocolo-div");

    const urlParams = new URLSearchParams(window.location.search);
    const idprotocolo = urlParams.get('idprotocolo');

    document.getElementById("titulo").innerHTML = " &nbsp; PROTOCOLO #" + idprotocolo;


    // Função para buscar os dados do protocolo
    function buscarProtocolo() {
        fetch('imprimir_protocolo.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `idprotocolo=${encodeURIComponent(idprotocolo)}`
        })
        .then(response => response.json())
        .then(data => {
            if (Array.isArray(data)) {
                // Limpa o divprotocolo antes de adicionar novos dados
                divprotocolo.innerHTML = '';


                // Itera sobre os dados retornados
                data.forEach(protocolo => {
                    //const div = document.createElement("div");

                    // Adiciona as células da tabela
                    divprotocolo.innerHTML = `
                        
                        <div class="menu-principal"> 
                            <div class="opt-menu-principal">
                                <div class="titulo-opt">
                                    <a>
                                        ID PROTOCOLO:
                                    </a>
                                </div>
                                <a class="descricao-a">${protocolo.idprotocolo}</a>
                            </div>

                            <div class="opt-menu-principal">
                                <div class="titulo-opt">
                                    <a>
                                        NOME:
                                    </a>
                                </div>
                                <a class="descricao-a">${protocolo.nome_objeto}</a>
                            </div>

                            <div class="opt-menu-principal">
                                <div class="titulo-opt">
                                    <a>
                                        CATEGORIA:
                                    </a>
                                </div>
                                <a class="descricao-a">${protocolo.nome_categoria || '-'}</a>
                            </div>

                            <div class="opt-menu-principal">
                                <div class="titulo-opt">
                                    <a>
                                        SITUAÇÃO:
                                    </a>
                                </div>
                                <a class="descricao-a">${protocolo.situacao == 1 ? 'Fechado' : 'Aberto'}</a>
                            </div>
                        </div>


                        <div class="menu-principal"> 
                            <div class="opt-menu-principal">
                                <div class="titulo-opt">
                                    <a>
                                        DATA PERDA:
                                    </a>
                                </div>
                                <a class="descricao-a">${protocolo.data_perda}</a>
                            </div>

                            <div class="opt-menu-principal">
                                <div class="titulo-opt">
                                    <a>
                                        DATA ABERTURA:
                                    </a>
                                </div>
                                <a class="descricao-a">${protocolo.data_abertura}</a>
                            </div>

                            <div class="opt-menu-principal">
                                <div class="titulo-opt">
                                    <a>
                                        DATA FECHAMENTO:
                                    </a>
                                </div>
                                <a class="descricao-a">${protocolo.data_fechamento || '-'}</a>
                            </div>
                        </div>

                        <div class="menu-principal"> 
                            <div class="opt-desc">
                                <div class="titulo-desc">
                                    <a>
                                        DESCRIÇÃO:
                                    </a>
                                </div>
                                <a class="descricao">${protocolo.descricao}</a>
                            </div>
                        </div>

                    `;
                    // Adiciona a linha na tabela
                    //divprotocolo.appendChild(div);



                    document.title = `PUC Achados - Protocolo #${protocolo.idprotocolo}`;
                });
            } else {
                console.error("Dados inválidos recebidos:", data);
            }
        })
        .catch(error => {
            console.error("Erro ao carregar os protocolos:", error);
        });
    }

    // Chama a função para buscar o protocolo
    buscarProtocolo();
});
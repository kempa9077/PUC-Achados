document.addEventListener("DOMContentLoaded", function() {
    // Captura o ID do protocolo da URL
    const divprotocolo = document.getElementById("protocolo-div");

    const urlParams = new URLSearchParams(window.location.search);
    const idprotocolo = urlParams.get('idprotocolo');

    document.getElementById("titulo").innerHTML = " &nbsp; PROTOCOLO #" + idprotocolo;



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

                divprotocolo.innerHTML = '';


                data.forEach(protocolo => {

                    const pessoanomecell = protocolo.nome_pessoa_abertura == null ? '-' : protocolo.nome_pessoa_abertura;

                    const pessoacpfcell = protocolo.pessoa_abertura_cpf == null ? '-' : protocolo.pessoa_abertura_cpf; 
                    
                    const funnomecell = protocolo.nome_pessoa_fechado == null ? '-' : protocolo.nome_pessoa_fechado;

                    const funcpfcell = protocolo.pessoa_fechado_cpf == null ? '-' : protocolo.pessoa_fechado_cpf;

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

                        <div class="menu-principal"> 
                            <div class="opt-menu-principal">
                                <div class="titulo-opt">
                                    <a>
                                        ${protocolo.situacao == 1 ? 'QUEM RETIROU OBJETO:' : 'QUEM ABRIU PROTOCOLO:'}
                                    </a>
                                </div>
                                <a class="descricao-a">${pessoanomecell}\n${pessoacpfcell}</a>
                            </div>

                            <div class="opt-menu-principal">
                                <div class="titulo-opt">
                                    <a>
                                        FUNCIONARIO QUE ENTREGOU OBJETO :
                                    </a>
                                </div>
                                <a class="descricao-a">${funnomecell}\n${funcpfcell}</a>
                            </div>
                        </div>

                    `;




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
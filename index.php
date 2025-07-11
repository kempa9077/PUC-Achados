<?php
            include('login/session.php');
            session_start();
            
?>
<!DOCTYPE html>
<html lang="pt-br">
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PUC Achados - Home</title>
        <link rel="stylesheet" href="index.css">
        <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
        <link rel="manifest" href="img/site.webmanifest">
        <link rel="mask-icon" href="img/safari-pinned-tab.svg" color="#882727">
        <meta name="msapplication-TileColor" content="#882727">
        <meta name="theme-color" content="#882727">
    </head>
    <body>
        <header class="top-bar">
            <nav class="barranav">
                <div class="logo">
                    <a href="index.php">
                        <img src="img\logo_texto_branco.png" alt="Logo PUC Achados">
                    </a>
                    
                </div>
                <div class="spaceperfil">

                    <?php

                    if(isset($_SESSION) AND $_SESSION):?>

                        <a id="login_sem_cadastro" class="login" href="perfil/perfil.php">
                            <img src="img\icon-login.png" alt="">
                        </a>
                        <a id="login_sem_cadastro" class="login" href="perfil/perfil.php">
                            <?php echo $_SESSION['usuario']['nome'];
                            ?>
                        </a> 
                        <form action="login/session.php" method="POST">
                            <button type="submit" name="acao" value="sair">Sair</button>
                        </form>

                        <?php

                        ?>
                    <?php
                    else:?>

                        <a id="login_sem_cadastro" class="login" href="login/login.html">
                            <img src="img\icon-login.png" alt="">
                        </a>
                        <a id="login_sem_cadastro" class="login" href="login/login.html">
                            Login
                        </a>

                    <?php endif; ?>
                    
                </div>
            </nav>
        </header>
    
        <nav class="second-bar">
            <div class="menu-nav">
                <div class="divnav">                
                    <a href="index.php" id="pagina_home_sem_cadastro">
                        <img src="img\icon-home.png" alt="icon-home">
                    </a>
                    <a href="index.php" id="pagina_home_sem_cadastro" class="menu-btn">Home</a>
                </div>

                <?php
                if(isset($_SESSION) AND $_SESSION AND $_SESSION['usuario']['acesso_nivel'] > 0):?>
                
                <div class="divnav">                
                    <a href="fun_ver_protocolos/fun_ver_protocolos.php" id="pagina_home_sem_cadastro">
                        <img src="img\icon-protocolos.png" alt="icon-home">
                    </a>
                    <a href="fun_ver_protocolos/fun_ver_protocolos.php" id="pagina_home_sem_cadastro" class="menu-btn" >Protocolos</a>
                </div>

                <?php
                else:?>

                <div class="divnav">                
                    <a href="meus_protocolos/meus_protocolos.php" id="pagina_home_sem_cadastro">
                        <img src="img\icon-protocolos.png" alt="icon-home">
                    </a>
                    <a href="meus_protocolos/meus_protocolos.php" id="pagina_home_sem_cadastro" class="menu-btn" >Meus Protocolos</a>
                </div>

                <?php endif; ?>
                
                <?php
                if(isset($_SESSION) AND $_SESSION AND $_SESSION['usuario']['acesso_nivel'] > 0):?>

                <div class="divnav">                
                    <a href="objetos_em_estoque\objetos_em_estoque.php" id="pagina_home_sem_cadastro">
                        <img src="img\icon-estoque.png" alt="icon-home">
                    </a>
                    <a href="objetos_em_estoque\objetos_em_estoque.php" id="pagina_home_sem_cadastro" class="menu-btn">Ver Objetos</a>
                </div>

                <?php endif; ?>
                    
            </div>
        </nav>
    

    <main class="content-area">

        <div class="div-titulo">
            <div class="area-logo-titulo">
                <img src="img\icon-home.png" alt="">
            </div>
            &nbsp; HOME
        </div>

        <div class="menu-principal">
            <div class="opt-menu-principal">
                <div class="titulo-opt">
                    <a id="link_perdi_algo" href="protocolo_perda\perdi_algo.php">
                    <img src="img/icon-lupa.png" alt="lupa">
                         PERDI ALGO
                    </a>
                </div>
                <a href="protocolo_perda\perdi_algo.php" class="descricao-a">Perdeu algo? Clique aqui para abrir um protocolo de perda de um item</a>
            </div>

            <?php
                if(isset($_SESSION) AND $_SESSION AND $_SESSION['usuario']['acesso_nivel'] > 0):?>

            <div class="opt-menu-principal">
                <div class="titulo-opt">
                    <a id= registrar_objeto href="registrar_objeto\registrar_objeto.php">
                        <img src="img/icon-achei-algo.png" alt="lupa">
                        REGISTRAR OBJETO ACHADO
                    </a>
                </div>
                <a href="registrar_objeto\registrar_objeto.php" class="descricao-a">Achou algo? Clique aqui para registrar o objeto.</a>
            </div>

            <?php
            else:?>

            <div class="opt-menu-principal">
                <div class="titulo-opt">
                    <a href="achei_algo\achei_algo.php">
                        <img src="img/icon-achei-algo.png" alt="pessoa-com-mao-levantada">
                        ACHEI ALGO
                    </a>
                </div>
                <a href="achei_algo\achei_algo.php" class="descricao-a">Achou algo? Clique aqui para saber o quer fazer.</a>
            </div>

            <?php endif; ?>

        </div>

        <?php
            if(isset($_SESSION) AND $_SESSION AND $_SESSION['usuario']['acesso_nivel'] > 0):?>
        
        <div class="menu-principal">
            <div class="opt-menu-principal">
                <div class="titulo-opt">
                    <a href="fun_ver_protocolos/fun_ver_protocolos.php">
                        <img src="img/icon-protocolos.png" alt="prancheta">
                        PROTOCOLOS
                    </a>
                </div>
                <a href="fun_ver_protocolos/fun_ver_protocolos.php" class="descricao-a">Clique aqui para ver todos os protocolos.</a>
            </div>

            <div class="opt-menu-principal">
                <div class="titulo-opt">
                    <a href="objetos_em_estoque\objetos_em_estoque.php">
                        <img src="img/icon-estoque.png" alt="caixa">
                        VER OBJETOS
                    </a>
                </div>
                <a href="objetos_em_estoque\objetos_em_estoque.php" class="descricao-a">Clique aqui para ver objetos em estoque, perdidos, devolvidos e excluídos.</a>
            </div>

            <?php
            else:?>

            <?php endif; ?>

        </div>

        <?php
            if(isset($_SESSION) AND $_SESSION AND $_SESSION['usuario']['acesso_nivel'] == 2):?>
        
        <div class="menu-principal">
            <div class="opt-menu-principal">
                <div class="titulo-opt">
                    <a href="log_encontro/log_encontro.php">
                        <img src="img/icon-log.png" alt="log">
                        LOG ENCONTRO
                    </a>
                </div>
                <a href="log_encontro/log_encontro.php" class="descricao-a">Clique aqui para ver Log de achados.</a>
            </div>

            <div class="opt-menu-principal">
                <div class="titulo-opt">
                    <a href="log_retirada\log_retirada.php">
                        <img src="img/icon-log.png" alt="log">
                        LOG RETIRADA DE OBJETOS
                    </a>
                </div>
                <a href="log_retirada\log_retirada.php" class="descricao-a">Clique aqui para ver Log de retirada de objetos do estoque.</a>
            </div>

            <?php
            elseif (isset($_SESSION) AND $_SESSION AND $_SESSION['usuario']['acesso_nivel'] == 1):?>

            <div class="menu-principal">
                <div class="opt-menu-principal">
                    <div class="titulo-opt">
                        <a href="meus_protocolos/meus_protocolos.php">
                            <img src="img/icon-protocolos.png" alt="protocolos">
                            MEUS PROTOCOLOS
                        </a>
                    </div>
                <a href="meus_protocolos/meus_protocolos.php" class="descricao-a">Clique aqui para ver protocolos abertos por você.</a>
            </div>

            <?php endif; ?>

        </div>

        <?php
            if(isset($_SESSION) AND $_SESSION AND $_SESSION['usuario']['acesso_nivel'] == 2):?>
        
        <div class="menu-principal">
            <div class="opt-menu-principal">
                <div class="titulo-opt">
                    <a href="log_pessoa/log_pessoa.php">
                        <img src="img/icon-log.png" alt="log">
                        LOG PESSOAS
                    </a>
                </div>
                <a href="log_pessoa/log_pessoa.php" class="descricao-a">Clique aqui para ver Log de pessoas no sistema.</a>
            </div>

            <div class="opt-menu-principal">
                <div class="titulo-opt">
                    <a href="gerenciar_fun\gerenciar_fun.php">
                        <img src="img/icon-funcionario.png" alt="pessoa">
                        GERENCIAR FUNCIONÁRIOS
                    </a>
                </div>
                <a href="gerenciar_fun\gerenciar_fun.php" class="descricao-a">Clique aqui para gerenciar conta de funcionários.</a>
            </div>

            <?php
            else:?>

            <?php endif; ?>

        </div>

        <?php
            if(isset($_SESSION) AND $_SESSION AND $_SESSION['usuario']['acesso_nivel'] == 2):?>
        
        <div class="menu-principal">
            <div class="opt-menu-principal">
                <div class="titulo-opt">
                    <a href="cadastro_fun/cadastro_fun.php">
                        <img src="img/icon-funcionario.png" alt="pessoa">
                        CADASTRAR FUNCIONÁRIO
                    </a>
                </div>
                <a href="cadastro_fun/cadastro_fun.php" class="descricao-a">Clique aqui para cadastrar novo funcionário.</a>
            </div>

            <div class="opt-menu-principal">
                    <div class="titulo-opt">
                        <a href="meus_protocolos/meus_protocolos.php">
                            <img src="img/icon-protocolos.png" alt="protocolos">
                            MEUS PROTOCOLOS
                        </a>
                    </div>
                <a href="meus_protocolos/meus_protocolos.php" class="descricao-a">Clique aqui para ver protocolos abertos por você.</a>
            </div>

            <?php
            else:?>

            <?php endif; ?>

            <?php
            if(isset($_SESSION) AND $_SESSION AND $_SESSION['usuario']['acesso_nivel'] == 0):?>
        
            <div class="opt-menu-principal">
                    <div class="titulo-opt">
                        <a id = meus_protocolos href="meus_protocolos/meus_protocolos.php">
                            <img src="img/icon-protocolos.png" alt="protocolos">
                            MEUS PROTOCOLOS
                        </a>
                    </div>
                <a id = meus_protocolos href="meus_protocolos/meus_protocolos.php" class="descricao-a">Clique aqui para ver protocolos abertos por você.</a>
            </div>

            <?php
            else:?>

            <?php endif; ?>

    </main>

    <footer>
        <div class="dados-div">
            <div class="dados-footer">
                <p>Desenvolvedores</p>
                <ul>
                    <li>
                        Davi Martins &ensp;&ensp; &ensp; &ensp;
                        <a href="https://www.linkedin.com/in/davi-noel-martins-mundt-8b8256245/" target="_blank">
                            <img src="img/linkedin-icon.png" alt="linkedin" class="img-footer">
                        </a>
                        <a href="https://github.com/DaviMartins26" target="_blank">
                            <img src="img/github-icon.png" alt="github" class="img-footer">
                        </a>
                    </li>

                    <li>
                        Joshua Mendes &ensp; &ensp;
                        <a href="https://www.linkedin.com/in/joshua-mendes-7126b42b7/" target="_blank">
                            <img src="img/linkedin-icon.png" alt="linkedin" class="img-footer">
                        </a>
                        <a href="https://github.com/JoshuaMeds" target="_blank">
                            <img src="img/github-icon.png" alt="github" class="img-footer">
                        </a>
                    </li>

                    <li>
                        Leander Antônio &ensp;&ensp;
                        <a href="https://www.linkedin.com/in/leander-hallu/" target="_blank">
                            <img src="img/linkedin-icon.png" alt="linkedin" class="img-footer">
                        </a>
                        <a href="https://github.com/Leander-Antonio" target="_blank">
                            <img src="img/github-icon.png" alt="github" class="img-footer">
                        </a>
                    </li>

                    <li>
                        Lucas Kempa &ensp;&ensp; &ensp; &ensp;
                        <a href="https://linkedin.com/in/lucas-kempa" target="_blank">
                            <img src="img/linkedin-icon.png" alt="linkedin" class="img-footer">
                        </a>
                        <a href="https://github.com/kempa9077" target="_blank">
                            <img src="img/github-icon.png" alt="github" class="img-footer">
                        </a>
                    </li>
                </ul>
            </div>

            <div class="dados-footer">
                <p>Professores</p>
                <ul>
                    <li>Giulio Domenico &ensp; &ensp; &ensp; - &ensp; Experiência Criativa</li>
                    <li>Aline Bampi &ensp; &ensp; &ensp; &ensp; &ensp;&ensp; - &ensp; Modelos de Soluções Computacionais</li>
                    <li>Marina de Lara &ensp; &ensp; &ensp; &ensp; - &ensp; Programação Orientada a Objetos</li>
                    <li>Pedro Horchulhack &ensp;&ensp; - &ensp; Performance em Sistemas Ciberfísicos</li>
                    <li>Luis Gonzaga &ensp; &ensp; &ensp; &ensp; &ensp; - &ensp; Segurança da Informação</li>
                </ul>
            </div>

            <div class="dados-footer">
                <p>Bytebusters</p>
                <a href="index.php">
                    <img src="img/bytebusters_logo1 2.png" alt="Bytebusters" class="logo-bytebusters">
                </a>
            </div>

        </div>

        <div class="copy-bytebusters">
            <a href="index.php">
                ©Bytebusters
            </a>
        </div>

    </footer>
</body>
<script src="index.js"></script>
</html>
<?php
$acesso = 1;
include '../header.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PUC Achados - Protocolo de Achado</title>
    <link rel="stylesheet" href="registrar_objeto.css">
    <link rel="apple-touch-icon" sizes="180x180" href="../img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../img/favicon-16x16.png">
    <link rel="manifest" href="../img/site.webmanifest">
    <link rel="mask-icon" href="../img/safari-pinned-tab.svg" color="#882727">
    <meta name="msapplication-TileColor" content="#882727">
    <meta name="theme-color" content="#882727">
</head>
<body>
<header class="top-bar">
            <nav class="barranav">
                <div class="logo">
                    <a href="../index.php">
                        <img src="..\img\logo_texto_branco.png" alt="Logo PUC Achados">
                    </a>
                    
                </div>
                <div class="spaceperfil">

                    <?php

                    if(isset($_SESSION) AND $_SESSION):?>

                        <a id="login_sem_cadastro" class="login" href="../perfil/perfil.php">
                            <img src="..\img\icon-login.png" alt="">
                        </a>
                        <a id="login_sem_cadastro" class="login" href="../perfil/perfil.php">
                            <?php echo $_SESSION['usuario']['nome'];
                            ?>
                        </a> 
                        <form action="../login/session.php" method="POST">
                            <button type="submit" name="acao" value="sair">Sair</button>
                        </form>

                        <?php

                        ?>
                    <?php
                    else:?>

                        <a id="login_sem_cadastro" class="login" href="../login/login.html">
                            <img src="..\img\icon-login.png" alt="">
                        </a>
                        <a id="login_sem_cadastro" class="login" href="../login/login.html">
                            Login
                        </a>

                    <?php endif; ?>
                    
                </div>
            </nav>
        </header>
    
        <nav class="second-bar">
            <div class="menu-nav">
                <div class="divnav">                
                    <a href="../index.php" id="pagina_home_sem_cadastro">
                        <img src="..\img\icon-home.png" alt="icon-home">
                    </a>
                    <a href="../index.php" id="pagina_home_sem_cadastro" class="menu-btn">Home</a>
                </div>

                <?php
                if(isset($_SESSION) AND $_SESSION AND $_SESSION['usuario']['acesso_nivel'] > 0):?>
                
                <div class="divnav">                
                    <a href="../fun_ver_protocolos/fun_ver_protocolos.php" id="pagina_home_sem_cadastro">
                        <img src="..\img\icon-protocolos.png" alt="icon-home">
                    </a>
                    <a href="../fun_ver_protocolos/fun_ver_protocolos.php" id="pagina_home_sem_cadastro" class="menu-btn" >Protocolos</a>
                </div>

                <?php
                else:?>

                <div class="divnav">                
                    <a href="../meus_protocolos/meus_protocolos.php" id="pagina_home_sem_cadastro">
                        <img src="..\img\icon-protocolos.png" alt="icon-home">
                    </a>
                    <a href="../meus_protocolos/meus_protocolos.php" id="pagina_home_sem_cadastro" class="menu-btn" >Meus Protocolos</a>
                </div>

                <?php endif; ?>
                
                <?php
                if(isset($_SESSION) AND $_SESSION AND $_SESSION['usuario']['acesso_nivel'] > 0):?>

                <div class="divnav">                
                    <a href="../objetos_em_estoque\objetos_em_estoque.php" id="pagina_home_sem_cadastro">
                        <img src="..\img\icon-estoque.png" alt="icon-home">
                    </a>
                    <a href="../objetos_em_estoque\objetos_em_estoque.php" id="pagina_home_sem_cadastro" class="menu-btn">Ver Objetos</a>
                </div>

                <?php endif; ?>
                    
            </div>
        </nav>

    <main class="content-area">

        <div class="div-titulo">
            <div class="area-logo-titulo">
                <img src="../img/icon-achei-algo.png" alt="">
            </div>
            &nbsp; REGISTRAR OBJETO
        </div>

        <div class="redbox-under-text">PREENCHA O FORMULÁRIO ABAIXO</div>
        <div class="flex-container">
            <div class="nome-do-item">
                <label for="nome_item">Nome do item:</label>
                <textarea id="nome_item" name="nome_item" rows="1" cols="33"></textarea>
            </div>
            <div class="tipo-do-item">
                <label for="tipo_item">Categoria do Item:</label>
                <select name="tipo_item" id="tipo_item"></select>
            </div>
            <div class="bloco-de-encontro">
                <label for="bloco_encontro">Bloco Encontrado:</label>
                <select name="bloco_encontro" id="bloco_encontro"></select>
            </div>

            <button id="botao_registrar">Registrar Objeto</button>

        
        </div>

        

    </main> 

    <footer>
        <div class="dados-div">
            <div class="dados-footer">
                <p>Desenvolvedores</p>
                <ul>
                <li>
                        Davi Martins &ensp;&ensp; &ensp; &ensp;
                        <a href="https://www.linkedin.com/in/davi-noel-martins-mundt-8b8256245/" target="_blank">
                            <img src="../img/linkedin-icon.png" alt="linkedin" class="img-footer">
                        </a>
                        <a href="https://github.com/DaviMartins26" target="_blank">
                            <img src="../img/github-icon.png" alt="github" class="img-footer">
                        </a>
                    </li>

                    <li>
                        Joshua Mendes &ensp; &ensp;
                        <a href="https://www.linkedin.com/in/joshua-mendes-7126b42b7/" target="_blank">
                            <img src="../img/linkedin-icon.png" alt="linkedin" class="img-footer">
                        </a>
                        <a href="https://github.com/JoshuaMeds" target="_blank">
                            <img src="../img/github-icon.png" alt="github" class="img-footer">
                        </a>
                    </li>

                    <li>
                        Leander Antônio &ensp;&ensp;
                        <a href="https://www.linkedin.com/in/leander-hallu/" target="_blank">
                            <img src="../img/linkedin-icon.png" alt="linkedin" class="img-footer">
                        </a>
                        <a href="https://github.com/Leander-Antonio" target="_blank">
                            <img src="../img/github-icon.png" alt="github" class="img-footer">
                        </a>
                    </li>

                    <li>
                        Lucas Kempa &ensp;&ensp; &ensp; &ensp;
                        <a href="https://linkedin.com/in/lucas-kempa" target="_blank">
                            <img src="../img/linkedin-icon.png" alt="linkedin" class="img-footer">
                        </a>
                        <a href="https://github.com/kempa9077" target="_blank">
                            <img src="../img/github-icon.png" alt="github" class="img-footer">
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
                <a href="../index.php">
                    <img src="../img/bytebusters_logo1 2.png" alt="Bytebusters" class="logo-bytebusters">
                </a>
            </div>

        </div>

        <div class="copy-bytebusters">
            <a href="../index.php">
                ©Bytebusters
            </a>
        </div>

    </footer>
</body>
<script src="registrar_objeto.js"></script>
</html>

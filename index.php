<?php
            include('login/session.php');
            include('header.php');

            error_reporting(E_ALL & ~E_NOTICE);
            ini_set('display_errors', 0);
?>
<!DOCTYPE html>
<html lang="pt-br">
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home</title>
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
                    <a href="">
                        <img src="img\logo_texto_branco.png" alt="Logo PUC Achados">
                    </a>
                    
                </div>
                <div class="spaceperfil">

                    <?php

                    if(isset($_SESSION) AND $_SESSION):?>

                        <a id="login_sem_cadastro" class="login">
                            <img src="img\icon-login.png" alt="">
                        </a>
                        <a id="login_sem_cadastro" class="login">
                            <?php echo $_SESSION['usuario']['nome'];
                            ?>
                        </a>

                        <a href="session.php?acao=sair" class="logout-btn">Sair</a>
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
                    <a id="pagina_home_sem_cadastro">
                        <img src="img\icon-home.png" alt="icon-home">
                    </a>
                    <a id="pagina_home_sem_cadastro" class="menu-btn">Home</a>
                </div>
                
                <div class="divnav">                
                    <a id="pagina_home_sem_cadastro">
                        <img src="img\icon-protocolos.png" alt="icon-home">
                    </a>
                    <a id="pagina_home_sem_cadastro" class="menu-btn" >Meus Protocolos</a>
                </div>
                
                <div class="divnav">                
                    <a href="objetos_em_estoque.php" id="pagina_home_sem_cadastro">
                        <img src="img\icon-estoque.png" alt="icon-home">
                    </a>
                    <a href="objetos_em_estoque.php" id="pagina_home_sem_cadastro" class="menu-btn">Objetos em Estoque</a>
                </div>
                    
            </div>
        </nav>
    

    <main class="content-area">

        <div class="div-titulo">
            <div class="area-logo-titulo">
                <img src="img\icon-home.png" alt="">
            </div>
            &nbsp; HOME
        </div>
    </main>

    <footer>
        <div class="dados-div">
            <div class="dados-footer">
                <p>Desenvolvedores</p>
                <ul>
                    <li>
                        Davi Martins &ensp;&ensp; &ensp; &ensp;
                        <a href="linkedin.com" target="_blank">
                            <img src="img/linkedin-icon.png" alt="linkedin" class="img-footer">
                        </a>
                        <a href="github.com" target="_blank">
                            <img src="img/github-icon.png" alt="github" class="img-footer">
                        </a>
                    </li>

                    <li>
                        Joshua Mendes &ensp; &ensp;
                        <a href="linkedin.com" target="_blank">
                            <img src="img/linkedin-icon.png" alt="linkedin" class="img-footer">
                        </a>
                        <a href="github.com" target="_blank">
                            <img src="img/github-icon.png" alt="github" class="img-footer">
                        </a>
                    </li>

                    <li>
                        Leander Antônio &ensp;&ensp;
                        <a href="linkedin.com" target="_blank">
                            <img src="img/linkedin-icon.png" alt="linkedin" class="img-footer">
                        </a>
                        <a href="github.com" target="_blank">
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
                <a href="">
                    <img src="img/bytebusters_logo1 2.png" alt="Bytebusters" class="logo-bytebusters">
                </a>
            </div>

        </div>

        <div class="copy-bytebusters">
            <a href="">
                ©Bytebusters
            </a>
        </div>

    </footer>
</body>
<script src="index.js"></script>
</html>
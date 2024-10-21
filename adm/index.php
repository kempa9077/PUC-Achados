<?php
$acesso = 2; // adm
include '../header.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Exemplo</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <header class="top-bar">
        <div class="left">
            <h1>PUC ACHADOS</h1>
        </div>
        <div class="right">
            <button id="login_sem_cadastro" class="login-btn">Login</button>
        </div>
    </header>

    <nav class="second-bar">
        <button id="pagina_home_sem_cadastro" class="nav-btn">Home</button>
        TESTE ACESSO ADM
        <button id="meus_protocolos_sem_cadastro" class="nav-btn center-btn">Meus Protocolos</button>
    </nav>

    <main class="content-area">
        <div class="gray-box">
            <div class="beige-bar"></div>
            <div class="gray-box-text">HOME</div>
            <!-- Retângulo branco à esquerda -->
            <div class="white-box left-box">
                <button id="perdi_algo" class="nav-btn">Perdi Algo</button>
            </div>
            <!-- Retângulo branco à direita -->
            <div class="white-box right-box">
                <button id="achei-algo" class="nav-btn">Achei Algo</button>
            </div>            
        </div>
    </main>
</body>
<script src="index.js"></script>
</html>
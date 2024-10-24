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
        <?php echo $_SESSION['usuario']['nome']?>
        <button id="sair" class="login-btn">Sair</button>
        <form action=" ../login/session.php" method="POST">
        <button type="submit" name="acao" value="sair">Sair</button>
        </form>
        </div>
    </header>

    <nav class="second-bar">
    <button id="home" class="nav-btn">Home</button>
        <button id="meus_protocolos" class="nav-btn center-btn">Meus Protocolos</button>
        <button id="perdi_algo" class="nav-btn">Perdi Algo</button>
    </nav>

    <main class="content-area">
        <div class="gray-box">
            <div class="beige-bar"></div>
            <div class="gray-box-text">HOME</div>
            <!-- Retângulo branco à esquerda -->
            <div class="white-box left-box">
                <button id="registrar-objeto" class="nav-btn">Registrar Objeto</button>
                <div class="white-box right-box">
                <button id="ver-protocolos" class="nav-btn">Ver Protocolos</button>
                <button id="log-retirada" class="nav-btn">Ver Logs Retirada</button>
                <button id="log-encontro" class="nav-btn">Ver Logs Objetos</button>
            </div>   
            </div>
            <!-- Retângulo branco à direita -->
            <div class="white-box right-box">
                <button id="ver-estoque" class="nav-btn">Estoque Objeto</button>
                <div class="white-box right-box">
                <button id="cadastrar-fun" class="nav-btn">Cadastrar Funcionario</button>
                <button id="gerenciar-fun" class="nav-btn">Gerenciar Funcionario</button>
                <button id="log-pessoa" class="nav-btn">Ver Logs Pessoa</button>
            </div>   
            </div>               
        </div>
    </main>
</body>
<script src="index.js"></script>
</html>
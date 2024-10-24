<?php
$acesso = 0; //qualquer um logado
include '../header.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Exemplo</title>
    <link rel="stylesheet" href="protocolo_perda.css">
</head>
<body>
    <header class="top-bar">
        <div class="left">
            <h1>PUC ACHADOS</h1>
        </div>
        <div class="right">
            <button id="login_sem_cadastro" class="login-btn"><?php echo $_SESSION['usuario']['nome']?></button>
        </div>
    </header>

    <nav class="second-bar">
        <button id="pagina_home_sem_cadastro" class="nav-btn">Home</button>
        <button id="meus_protocolos_sem_cadastro" class="nav-btn center-btn">Meus Protocolos</button>
    </nav>

    <main class="content-area">
        <div class="gray-box">
            <div class="beige-bar"></div>
            <div class="gray-box-text">PERDI ALGO</div>
            <div class="redbox-under"></div>
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
                    <label for="bloco_encontro">Bloco que Perdeu:</label>
                    <select name="bloco_encontro" id="bloco_encontro"></select>
                </div>
                <div class="sala-de-encontro">
                    <label for="sala_perda">Sala que Perdeu:</label>
                    <select name="sala_perda" id="sala_perda"></select>
                </div>
                <div class="data-de-entrada">
                    <label for="date">Data de Perda:</label>
                    <input id="data_perda" type="date" />
                </div>
            </div>
            
            <div class="descricao-item">
                <label for="descricao">Descrição do item:</label>
                <textarea id="descricao" name="descricao" rows="4" placeholder="Descreva o item perdido aqui..."></textarea>
            </div>
            
            <button id="enviar_objeto" class="enviar-btn">Enviar</button>
        </div>
    </main>
</body>
<script src="protocolo_perda.js"></script>
</html>

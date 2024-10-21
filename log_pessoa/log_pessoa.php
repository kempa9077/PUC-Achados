<?php
$acesso = 2;
include '../header.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logs de Encontro</title>
    <link rel="stylesheet" href="log_pessoa.css">
</head>
<body>
    <header class="top-bar">
        <nav class="barranav">
            <div class="logo">
                <a href="">
                    <img src="..\img\logo_texto_branco.png" alt="Logo PUC Achados">
                </a>
            </div>
        </nav>
    </header>

    <main class="content-area">
        <div class="div-titulo">
            <div class="area-logo-titulo">
                <img src="..\img\icon-log.png" alt="Log Icon">
            </div>
            &nbsp; LOGS DE MUDANÇA NAS PESSOAS
        </div>

        <div class="log-table">
            <table>
                <thead>
                    <tr>
                        <th>ID LOG</th>
                        <th>CPF MODIFICADOR</th>
                        <th>CPF ALTERADO</th>
                        <th>DATA</th>
                        <th>EMAIL ANTIGO</th>
                        <th>EMAIL NOVO</th>
                        <th>NOME ANTIGO</th>
                        <th>NOME NOVO</th>
                        <th>ACESSO ANTIGO</th>
                        <th>ACESSO NOVO</th>
                        <th>Abhurvhrkvt</th>
                    </tr>
                </thead>
                <tbody id="log-tbody">
                    <!-- Os dados dos logs serão inseridos aqui via JS -->
                </tbody>
            </table>
        </div>
    </main>

    <footer>
        <p>©Bytebusters</p>
    </footer>

    <script src="log_pessoa.js"></script>
</body>
</html>

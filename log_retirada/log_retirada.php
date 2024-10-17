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
    <link rel="stylesheet" href="log_retirada.css">
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
            &nbsp; LOGS DE RETIRADA DE OBJETOS
        </div>

        <div class="log-table">
            <table>
                <thead>
                    <tr>
                        <th>ID LOG</th>
                        <th>ID OBJETO</th>
                        <th>PESSOA QUE RETIROU</th>
                        <th>FUNCIONARIO RESPONSAVEL</th>
                        <th>DATA</th>
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

    <script src="log_retirada.js"></script>
</body>
</html>

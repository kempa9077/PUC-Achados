<?php
    include('../funcoes_banco.php');
    include('../header.php');
    include('../login/session.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PUC Achados - Perfil</title>
        <link rel="stylesheet" href="perfil.css">
        <link rel="apple-touch-icon" sizes="180x180" href="../img/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="../img/favicon-16x16.png">
        <link rel="manifest" href="../img/site.webmanifest">
        <link rel="mask-icon" href="../img/safari-pinned-tab.svg" color="#882727">
        <meta name="msapplication-TileColor" content="#882727">
        <meta name="theme-color" content="#882727">
    </head>

    <body>
        
        <div id="div_perfil">

            <a id="voltar_home" href="../">&times;</a>

            <a title="Voltar à Home" href="../"><img src="../img/logo-texto-preto.png" alt="Logo PUC" id="logo-perfil"></a>

            <h3 class="login-h3">Perfil</h3>
            <h5 class="login-h5">Visualize seu perfil</h5>

            <div id="user_name">
                <img src="../img/icon-funcionario.png" alt="foto de perfil" id="foto_perfil">

                <div id="nome_email">
                    <p id="nome_completo"><?php echo $_SESSION['usuario']['nome'];?></p>
                    <p id="email_user"><?php echo  $_SESSION['usuario']['email'] ?></p>
                    <div id="botoes_editar">
                        <a href="..\editar_perfil\editar_perfil.php" id="botao_editar">Editar</a>
                    </div>
                </div>
            </div>

            <form action="../login/session.php" method="POST">
                <button id="botao_sair" type="submit" name="acao" value="sair">Sair</button>
            </form>

            <p id="bytebusters_copy"><a href="../index.php">&copy;Bytebusters</a></p>
        </div>

        <script>
            function voltarPagina() {
                window.history.back();
            }
        </script>
    </body>

</html>
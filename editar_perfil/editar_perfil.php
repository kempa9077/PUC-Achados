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
        <title>PUC Achados - Editar Perfil</title>
        <link rel="stylesheet" href="editar_perfil.css">
        <link rel="apple-touch-icon" sizes="180x180" href="../img/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="../img/favicon-16x16.png">
        <link rel="manifest" href="../img/site.webmanifest">
        <link rel="mask-icon" href="../img/safari-pinned-tab.svg" color="#882727">
        <meta name="msapplication-TileColor" content="#882727">
        <meta name="theme-color" content="#882727">
    </head>

    <body>
        <main>
            <section class="box">
                <a id="voltar-home" onclick="history.back()">&times;</a>

                <div class="alinharelementos">
                    <img src="../img/logo-texto-preto.png" alt="" id="logo">
                </div>

                <div class="alinharelementosescrita">
                    <p id="elemento1">Editar perfil</p>
                    <?php
                    if(isset($_SESSION) AND $_SESSION AND $_SESSION['usuario']['acesso_nivel'] > 0):?>
                    <p id="elemento2">Edite seu nome, e-mail e registro</p>
                    <?php
                    else:?>
                    <p id="elemento2">Edite seu nome, e-mail e matrícula</p>
                    <?php endif; ?>
                </div>

                <form id="form1" action="atualizar_perfil.php">
                    <div class="espacodentrobox">

                        <input type="text" name="txtNome" maxlength="100" id="nome_id" value="<?php echo $_SESSION['usuario']['nome']?>" class="campocheio" required>

                        <input type="email" name="email" id="email_id" value="<?php echo $_SESSION['usuario']['email']?>" maxlength="100" class="campocheio" required>

                        <?php
                        if(isset($_SESSION) AND $_SESSION AND $_SESSION['usuario']['acesso_nivel'] > 0):?>
                        <input type="text" value="<?php echo $_SESSION['usuario']['registro_puc']?>" id="id_registro" maxlength="10" name="txtMatricula" class="campocheio" required>
                        <label id="label-email" for="email">Email: </label><label id="label-nome" for="email">Nome: </label><label id="label-registro" for="email">Registro: </label>
                        <?php
                        else:?>
                        <input type="text" value="<?php echo $_SESSION['usuario']['matricula']?>" id="matricula_id" maxlength="10" name="txtMatricula" class="campocheio" required>
                        <label id="label-email" for="email">Email: </label><label id="label-nome" for="email">Nome: </label><label id="label-matricula" for="email">Matricula: </label>
                        <?php endif; ?>

                    </div>

                    <div id="botoes">
                        <a id="excluirsubmit">Excluir conta</a>

                        <button id="enviarsubmit">Atualizar</button>
                    </div>

                </form>

                <p id="bytebusters_copy"><a href="../../">&copy;Bytebusters</a></p>
            </section>



            <div id="popup" class="popup">
                <span class="close" id="closePopup">&times;</span>
                <div id="titulo_div">

                    <div class="popup-content">
                        <span id="titulo">Excluir</span>

                        <form action="excluir_perfil.php" id="form_senha" method="get">

                            <div style="display: flex; align-items: center;">
                                <input type="password" id="senha_excluir" name="senha_excluir" placeholder="Confirme com sua senha" required>
                            </div>

                            <input type="submit" value="Excluir" id="botao_excluir_popup">

                        </form>
                    </div>
                </div>
            </div>

        </main>
        <script src="editar_perfil.js"></script>
    </body>

<?php
$acesso = 2; // 2 somente adm
include '../header.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="cadastro.css">
</head>
<body>
    <main>
        <section class="box">
            <a id="voltar-home" onclick="voltarPagina()">&times;</a>

            <a title="Voltar à Home" href="../"><img src="../img/logo-texto-preto.png" alt="Logo PUC" id="logo-login"></a>

                    <div class="alinharelementosescrita">
                        <p id="elemento1">Fazer Cadastro</p>
                        <p id="elemento2">Digite seus dados e crie uma senha</p>
                    </div>

                    <form id="form1" name="form1" method="post">
                        <div class="espacodentrobox">
                            <input type="text" name="txtNome" value="" maxlength="100" id="nome_id" placeholder="Nome" class="campocheio" required>

                            <input type="email" name="email" id="email_id" value="" placeholder="E-mail" maxlength="100" class="campocheio" required>

                            <input type="text" placeholder="CPF" id="cpf_id" name="txtCPF" value="" maxlength="14" class="campomedio" required>

                            <input type="text" placeholder="Registro_PUC" id="registro_id" name="txtMatricula" value="" class="campomedio" required>

                            <input type="password" name="txtSenha" value="" id="senha_id" placeholder="Senha" class="campocheio" maxlength="20" required>


                        </div>

                        <div id="buttons">
                            <a href="../" id="voltar-button">Voltar</a>
                            <input type="submit" value="Criar conta" id="adicionar">
                        </div>
                    </form>

                    <p id="bytebusters_copy"><a href="../">&copy;Bytebusters</a></p>
        </section>
    </main>
</body>
<script src="cadastro_fun.js"></script>
</html>

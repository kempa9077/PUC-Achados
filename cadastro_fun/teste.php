<?php
include("..//funcoes_banco.php");

        $tabela = "pessoa";
        $colunas = 'cpf,email,senha,nome,registro_puc,acesso_nivel';
        $cpf = 12345678911;
        $email = "tete@gmail.com";
        $nome = "AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAdilson";
        $registro = "aur4301";
        $acesso = 1;
        $senha = "123";

        // Hash da senha usando password_hash()
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
        
        $valores = "$cpf,'$email','$senha_hash','$nome','$registro','$acesso'";
        $fun = inserir_dado($tabela, $colunas, $valores);
        var_dump($fun)

?>

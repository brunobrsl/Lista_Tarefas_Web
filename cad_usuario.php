<?php

    if( isset($_POST['submit'])) {
        include_once 'conexao.php';

        $nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
        $email = mysqli_real_escape_string($conexao, trim($_POST['email']));
        $senha = mysqli_real_escape_string($conexao, trim($_POST['senha']));
        $cSenha = trim($_POST['cSenha']);

        if (empty($nome) || empty($email) || empty($senha) || empty($cSenha)) {
            header("Location: cadastro.php?signup=empty");
            exit();

        } else if (!preg_match("/^[a-zA-ZÀ-ú\s]*$/", $nome)) {
            header("Location: cadastro.php?signup=char");
            exit();
            
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: cadastro.php?signup=email");
            exit();

        } else if ($senha != $cSenha) {
            header("Location: cadastro.php?signup=password");
            exit();

        } else {

            $hash = password_hash($senha, PASSWORD_BCRYPT);

            $sql = "INSERT INTO tb_usuarios (nome, email, senha) VALUES ('$nome', '$email', '$hash')";

            $res = $conexao -> query($sql);

            header("Location: cadastro.php?signup=success");
            exit();
        }

    }
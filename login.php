<?php

if( isset($_POST['submit'])) {
    require 'conexao.php';

    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $senha = mysqli_real_escape_string($conexao, $_POST['senha']);

    if(empty($email) || empty($senha)) {
        header("Location: index.php?login=empty");
        exit();
    } else {
        $sql = "SELECT * from tb_usuarios WHERE email = '{$email}'";

        $res = mysqli_query($conexao, $sql);
    
        $row = mysqli_num_rows($res);
    
        $login = mysqli_fetch_assoc($res);
        
        if (password_verify($senha, $login['senha'])) {
            session_start();
            $_SESSION['id'] = $login['id'];
            $_SESSION['email'] = $login['email'];
            $_SESSION['nome'] = $login['nome'];

            header("Location: tarefas_pendentes.php");
            exit();
        } else {
            header("Location: index.php?login=wrongpassword");
            exit();
        }
    }

    


}
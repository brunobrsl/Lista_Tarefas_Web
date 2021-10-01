<?php

    require "conexao.php";

    $acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

    if($acao == 'inserir') {
        session_start();

        $id_usuario = $_SESSION['id'];
        
        $tarefa = mysqli_real_escape_string($conexao, trim($_POST['tarefa']));

        $sql = "INSERT INTO tb_tarefas (id_usuario, tarefa) VALUES ('$id_usuario', '$tarefa')";
        $res = $conexao->query($sql);

        header('Location: nova_tarefa.php?inclusao=1');

    } else if($acao == 'listar') {
        $id_usuario = $_SESSION['id'];

        $sql = "SELECT t.id, t.id_usuario, s.status, t.tarefa FROM tb_tarefas AS t
                LEFT JOIN tb_status AS s
                ON (t.id_status = s.id)
                WHERE t.id_usuario = ('$id_usuario')";
    
        $res = $conexao->query($sql) or die($conexao->error);
        $qtd = $res->num_rows;

    } else if($acao == 'atualizar') {
        $id = $_POST['id'];
        $tarefa = $_POST['tarefa'];

        $sql = "UPDATE tb_tarefas SET tarefa = ('$tarefa') WHERE id = ('$id')";
        $res = $conexao->query($sql);

        if( isset($_GET['page']) && $_GET['page'] == 'tp') {
            header('Location: tarefas_pendentes.php');
        } else {
            header('Location: todas_tarefas.php');
        }

    } else if($acao == 'remover') {
        $id = $_GET['id'];

        $sql = "DELETE FROM tb_tarefas WHERE id = ('$id')";
        $res = $conexao->query($sql);

        if( isset($_GET['page']) && $_GET['page'] == 'tp') {
            header('Location: tarefas_pendentes.php');
        } else {
            header('Location: todas_tarefas.php');
        }

    } else if($acao == 'marcarRealizada') {
        $id_status = 2;
        $id = $_GET['id'];

        $sql = "UPDATE tb_tarefas SET id_status = ('$id_status') WHERE id = ('$id')";
        $res = $conexao->query($sql);

        if( isset($_GET['page']) && $_GET['page'] == 'tp') {
            header('Location: tarefas_pendentes.php');
        } else {
            header('Location: todas_tarefas.php');
        }
    } else if($acao == 'listarTarefasPendentes') {
        $id_usuario = $_SESSION['id'];
        $id_status = 1;

        $sql = "SELECT t.id, t.id_usuario, s.status, t.tarefa FROM tb_tarefas AS t
                LEFT JOIN tb_status AS s
                ON (t.id_status = s.id)
                WHERE t.id_status = ('$id_status')
                AND t.id_usuario = ('$id_usuario')";

        $res = $conexao->query($sql) or die($conexao->error);
        $qtd = $res->num_rows;
    }
?>
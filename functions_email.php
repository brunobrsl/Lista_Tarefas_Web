<?php
    include("conexao.php");

    function verificar_dados($conexao) {
        if(isset($_POST['env']) && $_POST['env'] == "form"){
            $email = addslashes($_POST['email']);
            $sql = $conexao->prepare("SELECT * FROM tb_usuarios WHERE email = ?");
            $sql->bind_param("s", $email);
            $sql->execute();
            $res = $sql->get_result();
            $total = $res->num_rows;

            if($total > 0){ 
                $data = $res->fetch_assoc();
                add_data_recover($conexao, $email);
            } else {
                
            }
        }
    } 

    function add_data_recover($conexao, $email){
        $hash = md5(rand());
        $sql = $conexao->prepare("INSERT INTO tb_token (email, hash) VALUES (?, ?)");
        $sql->bind_param("ss", $email, $hash);
        $sql->execute();

        if($sql->affected_rows > 0){
            enviar_email($conexao, $email, $hash);
        }
    }

    function enviar_email($conexao, $email, $hash){
        $to = $email;
        $assunto = 'Redefinição de Senha';
        $url = 'www.brunobrsl.tk/redefinir_senha.php?hash=' . $hash;
        $from = 'listadetarefasbr@gmail.com';

        $mensagem = "<h3>Recebemos um pedido de redefinição de senha. O link para redifinir está logo abaixo, se não foi você que fez este pedido, pode ignorar este email</h3><hr>";
	    $mensagem .= "<h4>Aqui está o seu link para redefinir a senha: </h4>";
        $mensagem .= "<p><a href='" . $url . "'>" . $url . "</a></p>";

        $headers  = 'MIME-Version: 1.0' . "\r\n";
	    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    	$headers .= 'From: ' . $from . "\r\n" .
    		        'Reply-To: ' . $from . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
                    
        if(mail($to, $assunto, $mensagem, $headers)){
            echo "<br>";
            echo "<br>";
            echo "<div class='alert alert-success'>Os dados foram enviados para o seu email.</div>";
        } else {
            echo "<div class='alert alert-danger'>Erro ao enviar</div>";
        }
    }

    function verificar_hash($conexao, $hash){
        $sql = $conexao->prepare("SELECT * FROM tb_token WHERE hash = ? AND status = 0");
        $sql->bind_param("s", $_GET['hash']);
        $sql->execute();
        $res = $sql->get_result();
        $total = $res->num_rows;
            
        if($total > 0){
            if(isset($_POST['env']) && $_POST['env'] == "upd") {
                $senha = mysqli_real_escape_string($conexao, trim($_POST['senha']));
                $nSenha = password_hash($senha, PASSWORD_BCRYPT);
                $data = $res->fetch_assoc();
                atualizar_senha($conexao, $data['email'], $nSenha);
                deletar_hash($conexao, $data['email']);
                echo "<br><div class='alert alert-success'>Senha alterada com sucesso.</div>";
                redirect("index.php");
            } 
        } else {
            echo "<br><div class='alert alert-danger'>Sessão Expirada. Tente Novamente.</div>";
        }
    }

    function atualizar_senha($conexao, $email, $senha) {
        $sql = $conexao->prepare("UPDATE tb_usuarios SET senha = ? WHERE email = ?");
        $sql->bind_param("ss", $senha, $email);
        $sql->execute();

        if($sql->affected_rows > 0){
            return true;
        } else {
            return false;
        }
    }

    function deletar_hash($conexao, $email) {
        $sql = $conexao->prepare("DELETE FROM tb_token WHERE email = ?");
        $sql->bind_param("s", $email);
        $sql->execute();

        if($sql->affected_rows > 0){
            return true;
        } else {
            return false;
        }
    }

    function redirect($dir) {
        echo "<meta http-equiv='refresh' content='2; url={$dir}'>";
    }

?>
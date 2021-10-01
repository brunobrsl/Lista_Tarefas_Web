<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Criar uma conta</title>
    
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <link rel="shortcut icon" href="img/logo.png" type="image/x-png">
</head>
<body>
	<div class="container">
        <div class="row" style="margin-top: 70px;">
			<div class="col-lg-4 offset-lg-4 jumbotron" style="background-color: #e3f2fd;">
                <a id="logo-name" style="line-height: 80px; font-size: 28px; color: #003F7F; font-weight: bold;" href="#">
                    <img src="img/logo.png" width="80" height="80" class="d-inline-block align-top" alt="Lista de Tarefas">
                    Lista de Tarefas
                </a>
                <?php
                    if(isset($_GET['signup'])) {
                        $signupCheck = $_GET['signup'];
                    
                        if($signupCheck == "empty") {
                            echo "<br>";
                            echo "<br>";
                            echo "<div class='alert alert-danger'>Todos os campos devem ser preenchidos!</div>"; 
                        } else if ($signupCheck == "char") {
                            echo "<br>";
                            echo "<br>";
                            echo "<div class='alert alert-danger'>Caracteres inválidos!</div>";
                        } else if ($signupCheck == "email") {
                            echo "<br>";
                            echo "<br>";
                            echo "<div class='alert alert-danger'>Email Inválido!</div>";
                        } else if ($signupCheck == "password") {
                            echo "<br>";
                            echo "<br>";
                            echo "<div class='alert alert-danger'>As senhas não coincidem!</div>";
                        } else if ($signupCheck == "success") {
                            echo "<br>";
                            echo "<br>";
                            echo "<div class='alert alert-success'>Cadastro efetuado com sucesso!</div>";
                        }

                    }
                ?>
                <form action="cad_usuario.php" method="POST">
                    <h2 style="margin-top: 30px; font-size: 26px; color: #003F7F;">Criar uma conta</h2><br>
                    <div class="form-group">
                        <label>Nome</label>
						<input type="text" name="nome" class="form-control">
					</div>
                    <div class="form-group">
                        <label>E-mail</label>
						<input type="text" name="email" class="form-control">
					</div>
					<div class="form-group">
                        <label>Senha</label>
                        <input type="password" name="senha" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Confirmar Senha</label>
                        <input type="password" name="cSenha" class="form-control">
					</div>
					<div class="form-group">
						<button type="submit" name="submit" class="btn btn-primary">Cadastrar</button>
                    </div>
                    <div class="form-group" style="margin-top: 40px; margin-bottom: -10px;">
                        <a href="index.php" style="font-size: 18px;"><i class="fas fa-arrow-left" style="color: #003F7F;">&nbsp;</i>Voltar</a>
                    </div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
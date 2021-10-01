<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Entrar · Lista de Tarefas</title>
    
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <link rel="shortcut icon" href="img/logo.png" type="image/x-png">
</head>
<body>
	<div class="container">
        <div class="row" style="margin-top: 150px;">
			<div class="col-lg-4 offset-lg-4 jumbotron" style="background-color: #e3f2fd;">
                <a id="logo-name" style="line-height: 80px; font-size: 28px; color: #003F7F; font-weight: bold;" href="#">
                    <img src="img/logo.png" width="80" height="80" class="d-inline-block align-top" alt="Lista de Tarefas">
                    Lista de Tarefas
                </a>
                <?php
                    if(isset($_GET['login'])) {
                        $loginCheck = $_GET['login'];

                        if($loginCheck == "empty") {
                            echo "<br>";
                            echo "<br>";
                            echo "<div class='alert alert-danger'>Todos os campos devem ser preenchidos!</div>"; 
                        } else if ($loginCheck == "wrongpassword") {
                            echo "<br>";
                            echo "<br>";
                            echo "<div class='alert alert-danger'>Email ou senha inválidos!</div>";
                        }
                    }
                    
                ?>
                <form action="login.php" method="POST">
                    <h2 style="margin-top: 30px; font-size: 26px; color: #003F7F;">Login</h2><br>
					<div class="form-group">
                        <i class="fas fa-user" style="color: #003F7F;">&nbsp;</i><label>E-mail</label>
						<input type="text" name="email" class="form-control">
					</div>
					<div class="form-group">
                        <i class="fas fa-lock" style="color: #003F7F;">&nbsp;</i><label>Senha</label>
                        <input type="password" name="senha" class="form-control">
					</div>
					<div class="form-group">
						<button type="submit" name="submit" class="btn btn-primary">Entrar</button>
					</div>
					<div class="form-group" style="margin-top: 40px; margin-bottom: -10px;">
                        <a href="recuperar_senha.php">Esqueceu sua senha?</a> ·
                        <a href="cadastro.php">Cadastre-se</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
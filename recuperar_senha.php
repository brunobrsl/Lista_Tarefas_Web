<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Recuperar Senha</title>
    
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
                <form action="#" method="POST">
                    <h2 style="margin-top: 30px; font-size: 26px; color: #003F7F;">Recuperar Senha</h2><br>
					<div class="form-group">
                        <label style="font-size: 14px;">Insira seu email para voltar a acessar a sua conta.</label>
						<input type="text" name="email" class="form-control" placeholder="Email">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary">Confirmar</button>
                        <input type="hidden" name="env" value="form">
                    </div>
					<div class="form-group" style="margin-top: 40px; margin-bottom: -10px;">
                        <a href="index.php" style="font-size: 18px;"><i class="fas fa-arrow-left" style="color: #003F7F;">&nbsp;</i>Voltar</a>
                    </div>
                </form>
                <?php 
					include("conexao.php");
					include("functions_email.php");
					echo verificar_dados($conexao); 
				?>
			</div>
		</div>
	</div>
</body>
</html>
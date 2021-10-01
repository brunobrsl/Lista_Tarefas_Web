<?php
	session_start();

	if(!isset($_SESSION['id'])) {
		header("Location: index.php");
	}
?>

<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Lista de Tarefas</title>

		<link rel="stylesheet" href="css/estilo.css">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="fontawesome/css/all.css">
		<link rel="shortcut icon" href="img/logo.png" type="image/x-png">
	</head>

	<body>
		<nav class="navbar navbar-light" style="background-color: #e3f2fd;">
			<div class="container">
				<a class="navbar-brand" style="line-height: 40px; font-size: 22px; color: #003F7F;" href="#">
					<img src="img/logo.png" width="40" height="40" class="d-inline-block align-top" alt="">
					Lista de Tarefas
				</a>
				<div>
					<button class="btn btn-primary" style="background-color: #003F7F; color: #e3f2fd;"><i class="fas fa-user" style="padding-right: 5px;"></i><?= $_SESSION['nome'] ?></button>
				</div>
				<a href="sair.php"><i class="fas fa-sign-out-alt fa-lg" style="color: #003F7F;"></i></a>
			</div>
		</nav>

		<? if( isset($_GET['inclusao']) && $_GET['inclusao'] == 1 ) { ?>
			<div class="pt-2 text-white d-flex justify-content-center" style="background-color: #003F7F;">
				<h5>Tarefa inserida com sucesso!</h5>
			</div>
		<? } ?>

		<div class="container app">
			<div class="row">
				<div class="col-md-3 menu">
					<ul class="list-group">
						<li class="list-group-item"><a style="color: #003F7F;" href="tarefas_pendentes.php">Tarefas Pendentes</a></li>
						<li class="list-group-item active" style="border-color: #003F7F;"><a class="font-weight-bold" style="color: #003F7F;" href="#">Nova Tarefa</a></li>
						<li class="list-group-item"><a style="color: #003F7F;" href="todas_tarefas.php">Todas as Tarefas</a></li>
					</ul>
				</div>

                <div class="col-md-9">
					<div class="container pagina">
						<div class="row">
							<div class="col">
								<h3 style="color: #003F7F;">Nova Tarefa</h3>
								<hr />

								<form method="POST" action="tarefa_controller.php?acao=inserir">
									<div class="form-group">
										<label>Descrição da tarefa:</label>
										<input type="text" class="form-control" name="tarefa" placeholder="Exemplo: Ler um livro">
									</div>
									<button class="btn btn-primary">Adicionar</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<script src="js/jquery-3.5.1.min.js"></script>
		<script src="js/popper.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>
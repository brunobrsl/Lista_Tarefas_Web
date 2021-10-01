<?php
	session_start();

	if(!isset($_SESSION['id'])) {
		header("Location: index.php");
	}

	$acao = 'listarTarefasPendentes';
	require 'tarefa_controller.php';
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

		<script>
			function editar(id, txt_tarefa) {
				//form de edição
				let form = document.createElement('form')
				form.action = 'tarefas_pendentes.php?page=tp&acao=atualizar'
				form.method = 'post'
				form.className = 'row'

				//input para entrada do texto
				let inputTarefa = document.createElement('input')
				inputTarefa.type = 'text'
				inputTarefa.name = 'tarefa'
				inputTarefa.className = 'col-9 form-control'
				inputTarefa.value = txt_tarefa

				//input hidden para guardar o id da tarefa
				let inputId = document.createElement('input')
				inputId.type = 'hidden'
				inputId.name = 'id'
				inputId.value = id


				//button para envio do form
				let button = document.createElement('button')
				button.type = 'submit'
				button.className = 'col-3 btn btn-info'
				button.innerHTML = 'Atualizar'

				//incluir inputTarefa no form
				form.appendChild(inputTarefa)

				//incluir inputId no form
				form.appendChild(inputId)

				//incluir button no form
				form.appendChild(button)

				//selecionar div tarefa
				let tarefa = document.getElementById('tarefa_'+id)

				//limpar o texto da tarefa para a inclusão do form
				tarefa.innerHTML = ''

				//incluir form na página
				tarefa.insertBefore(form, tarefa[0])
			}

			function remover(id) {
				location.href = 'tarefas_pendentes.php?page=tp&acao=remover&id='+id;
			}

			function marcarRealizada(id) {
				location.href = 'tarefas_pendentes.php?page=tp&acao=marcarRealizada&id='+id;
			}
 		</script>
	</head>

	<body>
		<nav class="navbar navbar-light" style="background-color: #e3f2fd;">
			<div class="container">
				<a class="navbar-brand float-left" style="line-height: 40px; font-size: 22px; color: #003F7F;" href="#">
					<img src="img/logo.png" width="40" height="40" class="d-inline-block align-top" alt="">
					Lista de Tarefas
				</a>
				<div>
					<button class="btn btn-primary" style="background-color: #003F7F; color: #e3f2fd;"><i class="fas fa-user" style="padding-right: 5px;"></i><?= $_SESSION['nome'] ?></button>
				</div>
				<a href="sair.php"><i class="fas fa-sign-out-alt fa-lg" style="color: #003F7F;"></i></a>
			</div>
		</nav>

		<div class="container app">
			<div class="row">
				<div class="col-md-3 menu">
					<ul class="list-group">
						<li class="list-group-item active" style="border-color: #003F7F;"><a class="font-weight-bold" style="color: #003F7F;" href="#">Tarefas Pendentes</a></li>
						<li class="list-group-item"><a style="color: #003F7F;" href="nova_tarefa.php">Nova Tarefa</a></li>
						<li class="list-group-item"><a style="color: #003F7F;" href="todas_tarefas.php">Todas as Tarefas</a></li>
					</ul>
				</div>

				<div class="col-md-9">
					<div class="container pagina">
						<div class="row">
							<div class="col">
								<h3 style="color: #003F7F;">Tarefas Pendentes</h3>
								<hr />

								<? if($qtd > 0) { ?>
									<? while($row = $res->fetch_object()) { ?>		
										<div class="row mb-3 d-flex align-items-center">
											<div class="col-sm-9" id="tarefa_<?= $row->id ?>">
												<?= $row->tarefa ?>
											</div>
											<div class="col-sm-3 mt-2 d-flex justify-content-between">
												<i class="fas fa-trash-alt fa-lg text-danger" onclick="remover(<?= $row->id ?>)"></i>
												<i class="fas fa-edit fa-lg text-info" onclick="editar(<?= $row->id ?>, '<?= $row->tarefa ?>')"></i>
												<i class="fas fa-check-square fa-lg text-success" onclick="marcarRealizada(<?= $row->id ?>)"></i>
											</div>
										</div>
									<? } ?>
									
								<? } else { ?>
									<div>
										<h4 class="text-center">Não há nenhuma tarefa pendente</h4>
									</div>
								<? } ?>
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
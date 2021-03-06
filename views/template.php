<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Facebook</title>
		<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/template.css">
		<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/script.js"></script>		
	</head>
	<body>
		<nav class="navbar navbar-inverse">
			<div class="container">
				<div id="navbar">
					<ul class="nav navbar-nav navbar-left">
						<li><a href="<?php echo BASE_URL; ?>">Rede Social</a></li>
						<li>
							<form method="GET" action="<?php echo BASE_URL; ?>busca" class="navbar-form navbar-left navbar-input-group">
								<div class="form-group">
									<input type="text" name="q" class="form-control" placeholder="Buscar...">
									<button type="submit" class="btn btn-default">Buscar</button>
								</div>
								
							</form>
						</li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo $viewData['usuario_nome']; ?><span class="caret"></span>		
							</a>
							<ul class="dropdown-menu">
								<li><a href="<?php echo BASE_URL; ?>perfil">Editar Perfil</a></li>
								<li><a href="<?php echo BASE_URL; ?>login/sair">Sair</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>

		<div class="container">
			<?php $this->loadViewInTemplate($viewName, $viewData); ?>
		</div>
	</body>
</html>
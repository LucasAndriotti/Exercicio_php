<?php
	if(!isset($_SESSION))
	{
		session_start();
	}
?>
<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Loja</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
	</head>
	<body>
	<nav class="navbar navbar-expand-lg bg-body-tertiary bg-primary" data-bs-theme="dark">
  <div class="container-fluid">
    
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
		<?php
		if(isset($_SESSION["tipo"]) && $_SESSION["tipo"] == "Administrador")
		{
			echo "<li class='nav-item'>
				  <a class='nav-link' href='index.php?controle=categoriaController&metodo=listar'>Categorias</a>
				  </li>
				  <li class='nav-item'>
				  <a class='nav-link' href='index.php?controle=produtoController&metodo=listar'>Produtos</a>
				  </li>
				  <li class='nav-item'>
				  <a class='nav-link' href='index.php?controle=vendaController&metodo=produtos_mais_vendidos&grafico=B'>Gráfico Barras</a>
				  </li>
				  <li class='nav-item'>
				  <a class='nav-link' href='index.php?controle=vendaController&metodo=produtos_mais_vendidos&grafico=P'>Gráfico Pizza</a>
				  </li>";
		}
		echo "</ul>";
		echo "<div class='collapse navbar-collapse justify-content-end'>";
		echo "<ul class='navbar-nav'>";
		if(!isset($_SESSION["idusuario"]))
		{
			echo "<li class='nav-item'>
				  <a class='nav-link' href='index.php?controle=usuarioController&metodo=inserir'>Cadastre-se</a>
				  </li>
				  <li class='nav-item'>
				  <a class='nav-link' href='index.php?controle=usuarioController&metodo=login'>Entrar</a>
				  </li>";
		}
		else
		{
			echo "<li class='nav-item'>
				  <a class='nav-link' href='index.php?controle=usuarioController&metodo=logout'>Sair</a>
				  </li>";
		}
		?>
		<li class='nav-item'>
			<a class='nav-link' href='index.php?controle=vendaController&metodo=mostrar_carrinho'>Carrinho</a>
		</li>
      </ul>
	  </div>
    </div>
  </div>
</nav>
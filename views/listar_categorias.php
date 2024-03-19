<?php
	require_once "cabecalho.php";
?>
	<div class="content">
	  <div class="container">
	  <?php
			if(isset($_GET["msg"]))
			{
				echo "<div class='alert alert-success' role='alert'>{$_GET['msg']}</div>";
			}
	 ?>
	  
		<br><br><h1 class="row justify-content-center align-items-center">Categorias de Produto</h1><br>
		<table class="table table-striped">
			<tr>
				<th>Categorias</th>
				<th>Situação</th>
				<th>Ações</th>
			</tr>
			<?php
				foreach($retorno as $dado)
				{
					echo "<tr>
							<td>{$dado->descritivo}</td>
							<td>{$dado->situacao}</td>
							<td>
								<a class='btn btn-warning' href='index.php?controle=categoriaController&metodo=alterar&id={$dado->idcategoria}'>Alterar</a>
								&nbsp;&nbsp
								<a class='btn btn-danger' href='index.php?controle=categoriaController&metodo=excluir&id={$dado->idcategoria}'>Excluir</a>&nbsp;&nbsp";
		if($dado->situacao == "Ativo")
		{
			echo "<a class = 'btn btn-primary' href='index.php?controle=categoriaController&metodo=excluir_logico&situacao=Inativo&id={$dado->idcategoria}'>Inativar</a>";
		}
		else
		{
			echo "<a class = 'btn btn-primary' href='index.php?controle=categoriaController&metodo=excluir_logico&situacao=Ativo&id={$dado->idcategoria}'>Ativar</a>";
		}
						echo"</td></tr>"; 
				}//fim do foreach
			?>
		</table>
		<br>
		<a  class="btn btn-primary" href="index.php?controle=categoriaController&metodo=inserir">Nova Categoria</a>
	</div>
</div>
<?php
	require_once "rodape.html";
?>
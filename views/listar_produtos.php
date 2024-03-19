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
	  
		<br><br><h1 class="row justify-content-center align-items-center">Produto</h1><br>
		<table class="table table-striped">
			<tr>
				<th>Nome</th>
				<th>Preço</th>
				<th>Estoque</th>
				<th>Categoria</th>
				<th>Ações</th>
			</tr>
			<?php
				
				
				foreach($retorno as $dado)
				{
					$preco = number_format($dado->preco,2,",",".");
					echo "<tr>
							<td>{$dado->nome}</td>
							<td>$preco</td>
							<td>{$dado->estoque}</td>
							<td>{$dado->descritivo}</td>
							<td>
								<a class='btn btn-warning' href='index.php?controle=produtoController&metodo=alterar&id={$dado->idproduto}'>Alterar</a>
								&nbsp;&nbsp;
								<a class='btn btn-danger' href='index.php?controle=produtoController&metodo=excluir&id={$dado->idproduto}'>Excluir</a>
								
								</td></tr>";
					}//fim do foreach
			?>
		</table>
		<br>
		<a  class="btn btn-primary" href="index.php?controle=produtoController&metodo=inserir">Novo produto</a>&nbsp;&nbsp;&nbsp;
		
	</div>
</div>
<?php
	require_once "rodape.html";
?>
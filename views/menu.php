<?php
	require_once 'cabecalho.php';
?>	
	<div class='content'>
		<div class='container'>
		<?php
			if(is_array($retorno))
			{
				foreach($retorno as $dado)
				{
					echo "<div class='card' style='width: 18rem;'>
						  <img src='produtos/{$dado->imagem}' class='card-img-top' alt='...'>
						  <div class='card-body'>
							<h5 class='card-title'>{$dado->nome} - R$ {$dado->preco}</h5>
							<a href='index.php?controle=vendaController&metodo=inserir_carrinho&id={$dado->idproduto}' class='btn btn-primary'>Comprar</a></div>
							</div>";
				}//foreach
			}
			?>
  
		
		
		</div>
	</div
	
<?php	
	require_once 'rodape.html';
?>
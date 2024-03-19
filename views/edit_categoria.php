<?php
	require_once "cabecalho.php";
?>
	<div class="content">
	  <div class="container">
		<h1>Categoria</h1>
		<form action="#" method="POST">
			<input type="hidden" name="idcategoria" value="<?php echo $ret[0]->idcategoria;?>">
			<div class="mb-3">
				<label for="descritivo" class="form-label">Descritivo</label>
				<input type="text" class="form-control" id="descritivo" name="descritivo" value="<?php echo $ret[0]->descritivo; ?>">
				<div style="color:red"><?php echo $msg;?></div>
			</div>
			<br><br>
			<input class="btn btn-primary" type="submit" value="Alterar">
		</form>
	  </div>
	</div>





<?php
	require_once "rodape.html";
?>
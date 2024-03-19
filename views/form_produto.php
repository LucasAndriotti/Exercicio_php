<?php
	require_once "cabecalho.php";
?>
	<div class="content">
	  <div class="container">
		<h1>Produto</h1>
		<form class="form-control" action="#" method="POST" enctype="multipart/form-data">
			<div class="mb-3">
				<label for="nome" class="form-label">Nome</label>
				<input type="text"  id="nome" name="nome" value="<?php echo isset($_POST['nome'])?$_POST['nome']:''?>">
				<div style="color:red"><?php echo $msg[0] != ""?$msg[0]:'';?></div>
			</div>
			<br><br>
			<div class="mb-3">
				<label for="descricao" class="form-label">Descrição</label>
				<textarea name="descricao" id="descricao"><?php echo isset($_POST['descricao'])?$_POST['descricao']:''?></textarea>
				<div style="color:red"><?php echo $msg[1] != ""?$msg[1]:'';?></div>
			</div>
			<br><br>
			<div class="mb-3">
				<label for="preco" class="form-label">Preço</label>
				<input type="text" class="form-control" id="preco" name="preco" value="<?php echo isset($_POST['preco'])?$_POST['preco']:''?>">
				<div style="color:red"><?php echo $msg[2] != ""?$msg[2]:'';?></div>
			</div>
			<br><br>
			<div class="mb-3">
				<label for="estoque" class="form-label">Estoque</label>
				<input type="number" class="form-control" id="estoque" name="estoque" value="<?php echo isset($_POST['estoque'])?$_POST['estoque']:''?>">
				<div style="color:red"><?php echo $msg[3] != ""?$msg[3]:'';?></div>
			</div>
			<br><br>
			<div class="mb-3">
				<label for="categoria" class="form-label">Categoria</label>
				<select name="categoria" id="categoria">
					<option value="0">Escolha uma categoria</option>
					<?php
						//buscar as categorias no BD
						$categoriaDAO = new categoriaDAO();
						$retorno = $categoriaDAO->buscar_categorias();
						foreach($retorno as $dado)
						{
							if(isset($_POST["categoria"]) && $_POST["categoria"] == $dado->idcategoria)
							{
								echo "<option value='		{$dado->idcategoria}' selected>{$dado->descritivo}</option>";
							}
							else
							{
								echo "<option value='		{$dado->idcategoria}'>{$dado->descritivo}</option>";
							}
						}//fim foreach
					?>
				</select>
				<div style="color:red"><?php echo $msg[4] != ""?$msg[4]:'';?></div>
			</div>
			<br><br>
			<div class="mb-3">
				<label for="imagem" class="form-label">Imagem</label>
				<input type="file" class="form-control" id="imagem" name="imagem" onchange="mostrar(this)" accept="image/png, image/jpeg">
				<div style="color:red"><?php echo $msg[5] != ""?$msg[5]:'';?></div>
			</div>
			<br><br>
			<div class="mb-3">
				<img src="" id="img">
			</div>
			<br><br>
			<input class="btn btn-primary" type="submit" value="Cadastrar">
		</form>
	  </div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
	<script>
		function mostrar(img)
		{
			if(img.files  && img.files[0])
			{
				var reader = new FileReader();
				reader.onload = function(e){
					$('#img')
					.attr('src', e.target.result)
					.width(170)
					.height(100);
				};
				reader.readAsDataURL(img.files[0]);
			}
		}
	</script>




<?php
	require_once "rodape.html";
?>
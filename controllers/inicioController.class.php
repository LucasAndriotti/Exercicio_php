<?php
	class inicioController
	{
		public function inicio()
		{
			require_once "controllers/produtoController.class.php";
			$produtoController = new produtoController();
			$retorno = $produtoController->buscar_produtos();
			require_once "views/menu.php";
		}
	}
?>
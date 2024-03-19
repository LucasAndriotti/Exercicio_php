<?php
	if(!isset($_SESSION))
		session_start();
	
	require_once "models/Conexao.class.php";
	require_once "models/categoriaDAO.class.php";
	require_once "models/categoria.class.php";
	require_once "models/produtoDAO.class.php";
	require_once "models/Produto.class.php";
	
	class produtoController
	{
		public function buscar_produtos()
		{
			$produtoDAO = new produtoDAO();
			$retorno = $produtoDAO->buscar_produtos();
			return $retorno;
		}
		public function listar()
		{
			if(!isset($_SESSION["tipo"]) || $_SESSION["tipo"] != "Administrador")
			{
				header("location:index.php");
			}//if isset
			$produtoDAO = new produtoDAO();
			$retorno = $produtoDAO->buscar_produtos();
			require_once "views/listar_produtos.php";
		}//fim listar
		
		public function inserir()
		{
			$msg = array("","","","","","");
		
			if($_POST)
			{
				//verificações
				
				$erro = false;
				
				$tipos = array("image/png","image/jpeg");
				
				if(empty($_POST["nome"]))
				{
					$msg[0] = "Preencha o nome do produto";
					$erro = true;
				}
				if(empty($_POST["descricao"]))
				{
					$msg[1] = "Preencha a descrição do produto";
					$erro = true;
				}
				if(empty($_POST["preco"]))
				{
					$msg[2] = "Preencha o preço do produto";
					$erro = true;
				}
				if(empty($_POST["estoque"]))
				{
					$msg[3] = "Preencha o estoque do produto";
					$erro = true;
				}
				if($_POST["categoria"] == "0")
				{
					$msg[4] = "Escolha uma categoria";
					$erro = true;
				}
				if($_FILES["imagem"]["name"] == "")
				{
					$msg[5] = "Escolha uma imagem para o produto";
					$erro = true;
				}
				else if(!in_array($_FILES["imagem"]["type"], $tipos))
				{
					$msg[5] = "Formato de imagem não suportado";
					$erro = true;
				}
				
				if(!$erro)
				{
				
					//cadastrar no BD
					$categoria = new Categoria($_POST["categoria"]);
					
					$produto = new produto(nome:$_POST["nome"], descricao:$_POST["descricao"], preco:$_POST["preco"], estoque:$_POST["estoque"], imagem:$_FILES["imagem"]["name"],categoria:$categoria);
					
					$produtoDAO = new produtoDAO();
					$ret = $produtoDAO->inserir($produto);
					header("location:index.php?controle=produtoController&metodo=listar&msg=$ret");
				}
			}//post
			require_once "views/form_produto.php";
		}//fim inserir
		
		public function alterar()
		{
			if(isset($_GET["id"]))
			{
				$produto = new Produto($_GET["id"]);
				$produtoDAO = new produtoDAO();
				$retorno = $produtoDAO->buscar_um_produto($produto);
			}
			
			
			$msg = array("","","","","","");
			
			
			if($_POST)
			{
				//verificações
				
				$erro = false;
				
				$tipos = array("image/png","image/jpeg");
				
				if(empty($_POST["nome"]))
				{
					$msg[0] = "Preencha o nome do produto";
					$erro = true;
				}
				if(empty($_POST["descricao"]))
				{
					$msg[1] = "Preencha a descrição do produto";
					$erro = true;
				}
				if(empty($_POST["preco"]))
				{
					$msg[2] = "Preencha o preço do produto";
					$erro = true;
				}
				if(empty($_POST["estoque"]))
				{
					$msg[3] = "Preencha o estoque do produto";
					$erro = true;
				}
				
				$imagem = "";
				
				if($_FILES["imagem"]["name"] != "")
				{
					if(!in_array($_FILES["imagem"]["type"], $tipos))
					{
						$msg[5] = "Formato de imagem não suportado";
						$erro = true;
					}
					else
					{
						$imagem = $_FILES["imagem"]["name"];
					}
				}
				else
				{
					$imagem = $_POST["img"];
				}
				
				
				if(!$erro)
				{
				
					//cadastrar no BD
					$categoria = new Categoria($_POST["categoria"]);
					
					$produto = new produto(idproduto:$_POST["idproduto"], nome:$_POST["nome"], descricao:$_POST["descricao"], preco:$_POST["preco"], estoque:$_POST["estoque"], imagem:$imagem,categoria:$categoria);
					
					$produtoDAO = new produtoDAO();
					$ret = $produtoDAO->alterar($produto);
					header("location:index.php?controle=produtoController&metodo=listar&msg=$ret");
				}
			}//post
			require_once "views/edit_produto.php";
		}//fim alterar
		public function excluir()
		{
			if(isset($_GET["id"]))
			{
				$produto = new Produto($_GET["id"]);
				$produtoDAO = new produtoDAO();
				$ret = $produtoDAO->excluir($produto);
				header("location:index.php?controle=produtoController&metodo=listar&msg=$ret");
			}
		}
		public function gerar_pdf()
		{
			//buscar dados para o pdf
			$produtoDAO = new produtoDAO();
			$retorno = $produtoDAO->buscar_produtos();
			require_once "views/produto_pdf.php";
		}
	}//fim da classe
?>
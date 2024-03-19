<?php
	if(!isset($_SESSION))
		session_start();
	
	require_once "models/Conexao.class.php";
	require_once "models/CategoriaDAO.class.php";
	require_once "models/Categoria.class.php";
	
	class categoriaController
	{
		public function listar()
		{
			
			if(!isset($_SESSION["tipo"]) || $_SESSION["tipo"] != "Administrador")
			{
				header("location:index.php");
			}
			$categoriaDAO = new categoriaDAO();
			$retorno = $categoriaDAO->buscar_categorias();
			require_once "views/listar_categorias.php";
		}
		
		public function inserir()
		{
			$msg = "";
			if($_POST)
			{
				
				//verificar
				if(empty($_POST["descritivo"]))
				{
					$msg="Preencha o descritivo";
				}
				else
				{
					//gravar no Banco de Dados
					$categoria = new Categoria(descritivo:$_POST["descritivo"], situacao:"Ativo");
					$categoriaDAO = new categoriaDAO();
					$retorno = $categoriaDAO->inserir($categoria);
					header("location:index.php?controle=categoriaController&metodo=listar&msg=$retorno");
				}//else
			}//post
			require_once "views/form_categoria.php";
		}//fim inserir
		
		public function alterar()
		{
			$msg = "";
			if(isset($_GET["id"]))
			{
				$categoria = new Categoria($_GET["id"]);
				$categoriaDAO = new categoriaDAO();
				$ret = $categoriaDAO->buscar_uma_categoria($categoria);
			}//isset
			if($_POST)
			{
				//verificar
				if(empty($_POST["descritivo"]))
				{
					$msg="Preencha o descritivo";
				}
				else
				{
					//alterar
					$categoria = new Categoria($_POST["idcategoria"], $_POST["descritivo"]);
					$categoriaDAO = new categoriaDAO();
					$retorno = $categoriaDAO->alterar($categoria);
					header("location:index.php?controle=categoriaController&metodo=listar&msg=$retorno");
				}
			}//post
			require_once "views/edit_categoria.php";
		}//fim alterar
		
		public function excluir()
		{
			if(isset($_GET["id"]))
			{
				//exclusão
				
				$categoria = new Categoria($_GET["id"]);
				$categoriaDAO = new categoriaDAO();
				$retorno = $categoriaDAO->excluir($categoria);
				header("location:index.php?controle=categoriaController&metodo=listar&msg=$retorno");
			}
		}
		
		public function excluir_logico()
		{
			if($_GET)
			{
				$categoria = new Categoria(idcategoria:$_GET["id"], situacao:$_GET["situacao"]);
				
				$categoriaDAO = new categoriaDAO();
				
				$retorno = $categoriaDAO->alterar_situacao($categoria);
				
				header("location:index.php?controle=categoriaController&metodo=listar&msg=$retorno");
			}
		}
	}//fim da classe
?>
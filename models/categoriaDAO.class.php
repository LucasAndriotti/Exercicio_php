<?php
	class categoriaDAO extends Conexao
	{
		public function __construct()
		{
			parent:: __construct();
		}
		
		public function inserir($categoria)
		{
			$sql = "INSERT INTO categoria (descritivo, situacao) VALUES(?,?)";
			
			$stm = $this->db->prepare($sql);
			$stm->bindValue(1, $categoria->getDescritivo());
			$stm->bindValue(2, $categoria->getSituacao());
			$stm->execute();
			$this->db = null;
			return "Categoria inserida com sucesso";
		}//fim inserir
		public function buscar_categorias()
		{
			$sql = "SELECT * FROM categoria";
			$stm = $this->db->prepare($sql);
			$stm->execute();
			$this->db = null;
			return $stm->fetchAll(PDO::FETCH_OBJ);
		}//fim buscar_categorias
		public function excluir($categoria)
		{
			$sql = "DELETE FROM categoria WHERE idcategoria = ?";
			try
			{
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $categoria->getIdcategoria());
				$stm->execute();
				$this->db = null;
				return "Categoria Excluida com Sucesso";
			}
			catch(PDOException $e)
			{
				$this->db = null;
				if($e->getCode() == "23000")
				{
					return "Categoria contém produtos. Não pode ser excluida";
				}
				else
				{
					return "Problema ao excluir uma categoria de produto";
				}
			}
		}//excluir
		public function buscar_uma_categoria($categoria)
		{
			$sql = "SELECT * FROM categoria WHERE idcategoria = ?";
			$stm = $this->db->prepare($sql);
			$stm->bindValue(1, $categoria->getIdcategoria());
			$stm->execute();
			$this->db = null;
			return $stm->fetchAll(PDO::FETCH_OBJ);
			
		}//fim buscar_uma_categoria
		public function alterar($categoria)
		{
			$sql = "UPDATE categoria SET descritivo = ? WHERE idcategoria = ?";
			$stm = $this->db->prepare($sql);
			$stm->bindValue(1, $categoria->getDescritivo());
			$stm->bindValue(2, $categoria->getIdcategoria());
			$stm->execute();
			$this->db = null;
			return "Categoria alterada com sucesso";
		}//fim alterar
		public function alterar_situacao($categoria)
		{
			$sql = "UPDATE categoria SET situacao = ? WHERE idcategoria = ?";
			$stm = $this->db->prepare($sql);
			$stm->bindValue(1, $categoria->getSituacao());
			$stm->bindValue(2, $categoria->getIdcategoria());
			$stm->execute();
			$this->db = null;
			return "Situação da Categoria foi alterada com sucesso";
		}
	}//fim classe
?>
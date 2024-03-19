<?php
	class produtoDAO extends Conexao
	{
		public function __construct()
		{
			parent:: __construct();
		}
		
		public function inserir($produto)
		{
			$sql = "INSERT INTO produto (nome, descricao, preco, estoque, imagem, idcategoria) VALUES(?,?,?,?,?,?)";
			
			$stm = $this->db->prepare($sql);
			$stm->bindValue(1, $produto->getNome());
			$stm->bindValue(2, $produto->getDescricao());
			$stm->bindValue(3, $produto->getPreco());
			$stm->bindValue(4, $produto->getEstoque());
			$stm->bindValue(5, $produto->getImagem());
			$stm->bindValue(6, $produto->getCategoria()->getIdcategoria());
			$stm->execute();
			$this->db = null;
			return "Produto inserido com sucesso";
		}//fim inserir
		public function buscar_produtos()
		{
			$sql = "SELECT p.*, c.descritivo FROM produto as p, categoria as c WHERE p.idcategoria = c.idcategoria";
			$stm = $this->db->prepare($sql);
			$stm->execute();
			$this->db = null;
			return $stm->fetchAll(PDO::FETCH_OBJ);
		}//fim buscar_produtos
		
		public function buscar_um_produto($produto)
		{
			$sql = "SELECT * FROM produto WHERE idproduto = ?";
			$stm = $this->db->prepare($sql);
			$stm->bindValue(1, $produto->getIdproduto());
			$stm->execute();
			$this->db = null;
			return $stm->fetchAll(PDO::FETCH_OBJ);
			
		}//fim buscar_uma_produto
		public function alterar($produto)
		{
			$sql = "UPDATE produto SET nome = ?,descricao = ?, preco = ?, estoque = ?,imagem = ?, idcategoria = ?  WHERE idproduto = ?";
			$stm = $this->db->prepare($sql);
			$stm->bindValue(1, $produto->getNome());
			$stm->bindValue(2, $produto->getDescricao());
			$stm->bindValue(3, $produto->getPreco());
			$stm->bindValue(4, $produto->getEstoque());
			$stm->bindValue(5, $produto->getImagem());
			$stm->bindValue(6, $produto->getCategoria()->getIdcategoria());
			$stm->bindValue(7, $produto->getIdproduto());
			$stm->execute();
			$this->db = null;
			return "Produto alterado com sucesso";
		}//fim alterar
		public function excluir($produto)
		{
			$sql = "DELETE FROM produto WHERE idproduto = ?";
			try
			{
				$stm = $this->db->prepare($sql);
				$stm->bindValue(1, $produto->getIdproduto());
				$stm->execute();
				$this->db = null;
				return "Produto excluido com sucesso";
			}
			catch(PDOException $e)
			{
				$this->db = null;
				if($e->getCode() == "23000")
				{
					return "Produto vendido. Não pode ser excluido.";
				}
				else
				{
					return "Problema ao excluir um produto";
				}
				
			}
		}//fim excluir
	}//fim classe
?>
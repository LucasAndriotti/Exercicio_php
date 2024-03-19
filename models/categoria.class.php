<?php
	class Categoria
	{
		public function __construct(private int $idcategoria = 0, private string $descritivo = "", private string $situacao = ""){}
		
		public function getIdcategoria()
		{
			return $this->idcategoria;
		}
		public function getDescritivo()
		{
			return $this->descritivo;
		}
		
		public function getSituacao()
		{
			return $this->situacao;
		}
		
	}//fim classe
?>
<?php 
    if(!isset($_SESSION))
    {
        session_start();
    }

    require_once "Models/Conexao.class.php";
    require_once "Models/Produto.class.php";
    require_once "Models/produtoDAO.class.php";

    class vendaController
    {
        public function inserir_carrinho()
        {
            if(isset($_GET["id"]))
            {
                $linha = -1;
                $achou = false;
                if(isset($_SESSION["carrinho"]))
                {
                    foreach($_SESSION["carrinho"] as $linha=>$dado)
                    {
                        if($_GET["id"] == $dado["idproduto"])
                        {
                            $achou = true;
                        }
                    }
                }
                if(!$achou)
                {
                    //buscar dados do produto
                    $produto = new Produto($_GET["id"]);
                    $produtoDAO = new produtoDAO();
                    $retorno = $produtoDAO->buscar_um_produto($produto);
                    //guardar o produto na sessão
                    $_SESSION["carrinho"][$linha+1]["idproduto"] = $retorno[0]->idproduto;
                    $_SESSION["carrinho"][$linha+1]["nome"] = $retorno[0]->nome;
                    $_SESSION["carrinho"][$linha+1]["preco"] = $retorno[0]->preco;
                    $_SESSION["carrinho"][$linha+1]["quantidade"] = $retorno[0] = 1;
                }
                require_once "views/carrinho.php";
            }
        }

        public function alterar_quantidade()
        {

        }

        public function excluir_produto_carrinho()
        {

        }

        public function inserir_venda()
        {

        }
    }
?>
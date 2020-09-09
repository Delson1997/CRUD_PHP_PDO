<?php
// usando autolad seria: require_once "vendor/autoload.php";


require_once "App/Model/Produto.php";
require_once "App/Model/ProdutoDAO.php";
require_once "App/Model/Conexao.php";

$produtoDAO = new \App\Model\ProdutoDAO();
$produtoDAO->delete(3);
$produtoDAO->read();

foreach($produtoDAO->read() as $pro):
    echo $pro["nome"]."<br>".$pro["descricao"]."<hr>";

endforeach;
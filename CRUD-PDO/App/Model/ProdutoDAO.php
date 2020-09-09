<?php
namespace App\Model;
require_once "App/Model/Conexao.php";
require_once "App/Model/Produto.php";
Class ProdutoDAO{

    public function create(Produto $pro){

        $sql = "INSERT INTO produtos (nome,descricao) VALUES(?,?)";
        $stmt= Conexao::getConn()->prepare($sql);
        $stmt->bindValue(1,$pro->getNome());
        $stmt->bindValue(2,$pro->getDescricao());
        $stmt->execute();
    }

    public function read(){
        $sql = "SELECT * FROM produtos";
        $stmt= Conexao::getConn()->prepare($sql);
        $stmt->execute();

        if($stmt->rowCount() > 0):
            $resulado =$stmt->fetchall(\PDO::FETCH_ASSOC);
            return $resulado;
        else:
            return [];
        endif;
    }

    public function update(Produto $pro){

        $sql = "UPDATE produtos SET nome=? , descricao=? WHERE id=?";
        $stmt= Conexao::getConn()->prepare($sql);
        $stmt->bindValue(1,$pro->getNome());
        $stmt->bindValue(2,$pro->getDescricao());
        $stmt->bindValue(3,$pro->getId());
        $stmt->execute();
        
    }
    public function delete($id){

        $sql = "DELETE FROM produtos WHERE id=?";
        $stmt= Conexao::getConn()->prepare($sql);
        $stmt->bindValue(1,$id);
        $stmt->execute();


        
    }




}
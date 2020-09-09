<?php

Class Pessoa{

    private $pdo;

public function __construct($dbname,$host,$user,$password){

    try {
        $this->pdo=new PDO("mysql:dbname=".$dbname.";host=".$host,$user,$password);
    } catch (PDOException $e) {
       echo "Erro do banco de dados: ".$e->Message();
    }catch (Exception $e) {
        echo "Erro generico: ".$e->Message();
     }
 
}


public function buscarDados(){
    $resultado=array();
    $stmt=$this->pdo->query("SELECT * FROM pessoa ORDER BY nome");
    $resultado=$stmt->fetchAll(PDO::FETCH_ASSOC);
    return $resultado;
}

public function CadastrarPessoa($nome,$telefone,$email){
    // verificar se pessoa nao foi cadastrada atravez de email
    $stmt=$this->pdo->prepare("SELECT * FROM pessoa WHERE email= :e");
    $stmt->bindValue(":e",$email);
    $stmt->execute();

    if ($stmt->rowCount()>0) // email ja existe no banco
    {
        return false;
    } else  // se nao existe cadastrar
    {
        $stmt=$this->pdo->prepare("INSERT INTO pessoa (nome,telefone,email) VALUES (:n,:t,:e)");
        $stmt->bindValue(":n",$nome);
        $stmt->bindValue(":t",$telefone);
        $stmt->bindValue(":e",$email);
        $stmt->execute();

        return true;
    }

}

public function excluirpessoa($id){
    $stmt=$this->pdo->prepare("DELETE FROM pessoa WHERE id= :id");
    $stmt->bindValue(":id",$id);
    $stmt->execute();
}



public function buscarDadosPessoa($id){

    $resultado=array();  // definimos o resultado como array vazio
    $stmt=$this->pdo->prepare("SELECT * FROM pessoa WHERE id= :id");
    $stmt->bindValue(":id",$id);
    $stmt->execute();

    $resultado=$stmt->fetch(PDO:: FETCH_ASSOC);
    return $resultado;
}

public function actualizarDadosPessoa($id,$nome,$telefone,$email){

    $stmt=$this->pdo->prepare("UPDATE pessoa SET nome=:n,telefone=:t,email=:e WHERE id= :id");
    $stmt->bindValue(":id",$id);
    $stmt->bindValue(":n",$nome);
    $stmt->bindValue(":t",$telefone);
    $stmt->bindValue(":e",$email);
    $stmt->execute();
   
   
    

}
}
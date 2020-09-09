<?php
require_once "Pessoa.php";

$pessoa =new Pessoa("crudpdo","localhost","root","");
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>CRUD EM POD</title>
</head>
<body>
    <?php
    // SABER SE E CADASTRAR OU ACTUALIZAR
        if (isset($_POST['nome'])){
                
       if(isset($_GET["id_up"])){

        $id_up=addslashes($_GET["id_up"]); 
        $nome=addslashes($_POST["nome"]);
        $telefone=addslashes($_POST["telefone"]);
        $email=addslashes($_POST["email"]);

        if(!empty($nome) && !empty($telefone) && !empty($email)){

            $pessoa->actualizarDadosPessoa($id_up,$nome,$telefone,$email);
            header("location:index.php");
        }
       else{
        ?>
        <div class="aviso">
         <h4>Preencha todos os campos!</h4>
        </div>
        
            <?php
        }
    }
      //----------CADASTRAR----------------------//
      else { 
    
        $nome=addslashes($_POST["nome"]);
        $telefone=addslashes($_POST["telefone"]);
        $email=addslashes($_POST["email"]);

        if(!empty($nome) && !empty($telefone) && !empty($email)){
           

            if(!$pessoa->CadastrarPessoa($nome,$telefone,$email)){

                ?>
        <div class="aviso">
         <h4>O email ja existe!</h4>
        </div>
        
            <?php
                
                
            }
          
      }
       else{
        ?>
        <div class="aviso">
         <h4>Preencha todos os campos!</h4>
        </div>
        
            <?php
            
        } 
      }
    }
    
    ?>
<!-- buscando os dados e preenchendo nos campos formulario-->

<?php
if (isset($_GET['id_up'])) {

    $id_update=addslashes($_GET['id_up']);
    $resultado = $pessoa->buscarDadosPessoa($id_update);

}



?>

<section id="esquerda">
<form action="" method="POST">
<h2>Cadastrar Pessoa</h2>
<label for="nome">Nome</label> <br>
<input type="text" name="nome" id="nome" 
value= "<?php if(isset($resultado)){ echo $resultado['nome'];}?>"><br>
<label for="telefone">Telefone</label><br>
<input type="text" name="telefone" id="telefone"
 value= "<?php if(isset($resultado)){ echo $resultado['telefone'];}?>"><br>
<label for="email">Email</label><br>
<input type="email" name="email" id="email" 
value= "<?php if(isset($resultado)){ echo $resultado['email'];}?>"><br>
<input  type="submit" value= "<?php if(isset($resultado)){ echo "Actualizar";}else{echo "Cadastrar";}?>">
</form>
</section>


<section id="direita">
<table>
<tr id="titulo">
<td>Nome</td>
<td>Telefone</td>
<td colspan="2">Email</td>
</tr>

    <?php
$dados=$pessoa->buscarDados();

if(count($dados)>0) // SE O BANCOO  TIVER DADOS
{

    for ($i=0; $i < count($dados) ; $i++) { 

        echo "<tr>";

        foreach ($dados[$i] as $key => $value) {

            if ($key !="id") { // excluimos a coluna id

         echo "<td>".$value."</td>";
         
                
            }
        }
        
        ?>
        
   <td>
   <a id="editar" href="index.php?id_up=<?php echo $dados[$i]["id"];?>">Editar</a>
 <a id="excluir" href="index.php?id=<?php echo $dados[$i]["id"];?>">Excluir</a></td>
 
<?php
     
echo "</tr>";

  }
}else // O BANCO DE DADOS ESTA FAZIO
{


?>

</table>
</section>

<div >
 <h4>Ainda nao ha pessoas cadastradas!</h4>
</div>
<?php
}
?>
</body>
</html>

<?php
// Para fazer o excluir::::
if (isset($_GET['id'])){
$id_pessoa = addslashes($_GET["id"]);
$pessoa->excluirpessoa($id_pessoa);
header("location: index.php");

}


?>
<?php

include('conexao.php'); 

$idcliente= isset($_GET["idcliente"]) ? $_GET["idcliente"]: null;
$op = isset($_GET["op"]) ? $_GET["op"]: null;

    try {
        $servidor = "localhost";
        $usuario = "root";
        $senha = "";
        $bd = "bdconsultorio";
        $con = new PDO("mysql:host=$servidor;dbname=$bd",$usuario,$senha);
        //var_dump($con);
        //die();

        if($op=="del"){
            $sql = "delete  FROM  tblclientes where idcliente= :idcliente";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":idcliente",$idcliente);
            $stmt->execute();
            header("Location:listarclientes.php");
        }
        if($idcliente){

            //estou buscando os dados do cliente no BD
            $sql = "SELECT * FROM  tblclientes where idcliente= :idcliente";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":idcliente",$idcliente);
            $stmt->execute();
            $tblclientes = $stmt->fetch(PDO::FETCH_OBJ);
            //var_dump($tblclientes);

        }

        if($_POST){

            if($_POST["idcliente"]){

                $sql = "UPDATE tblclientes SET nome=:nome,telefone=:telefone, endereco=:endereco, email=:email  WHERE idcliente =:idcliente";
                $stmt = $con->prepare($sql);
                $stmt->bindValue(":nome", $_POST["nome"]);
                $stmt->bindValue(":telefone", $_POST["telefone"]);
                $stmt->bindValue(":endereco", $_POST["endereco"]);
                $stmt->bindValue(":email", $_POST["email"]);
                $stmt->bindValue(":idcliente", $_POST["idcliente"]);
                $stmt->execute();

            } else {

                $sql = "INSERT INTO tblclientes(nome,telefone,endereco,email) VALUES (:nome,:telefone,:endereco,:email)";
                $stmt = $con->prepare($sql);
                $stmt->bindValue(":nome",$_POST["nome"]);
                $stmt->bindValue(":telefone",$_POST["telefone"]);
                $stmt->bindValue(":endereco",$_POST["endereco"]);
                $stmt->bindValue(":email",$_POST["email"]);
                $stmt->execute();
            }
            header("Location:listarclientes.php");
        }
    } catch(PDOException $e){
         echo "erro de conexão com o BD".$e->getMessage;

        }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Document</title>

</head>
<body>
<h1></h1>
<div class="container-fluid">
<nav class="navbar navbar-dark bg-primary">
<h1>Cadastro de clientes</h1> 
</nav>

<h1></h1>

<nav class="navbar navbar-dark bg-info">
<form method="POST">                                          <!-- isset (seexistir) então cliente->nome  senão nulo -->
Nome  <input type="text" name="nome"        value="<?php echo isset($tblclientes) ? $tblclientes->nome : null ?>"><br>
<h1></h1>
Telefone <input type="text" name="telefone"       value="<?php echo isset($tblclientes) ? $tblclientes->telefone : null ?>"><br>
<h1></h1>
Endereco <input type="text" name="endereco"       value="<?php echo isset($tblclientes) ? $tblclientes->endereco : null ?>"><br>
<h1></h1>
E-mail <input type="text" name="email"       value="<?php echo isset($tblclientes) ? $tblclientes->email : null ?>"><br>
<h1></h1>
<input type="hidden"     name="idcliente"   value="<?php echo isset($tblclientes) ? $tblclientes->idcliente : null ?>"><br>
</nav>
<h1></h1>
<button type="button" class="btn btn-primary">
<input type="submit">
</button>
    <h1></h1>
    </form>
    <button type="button" class="btn btn-secondary">
<a href="listarclientes.php">volta</a>
</button>
</div>
</body>
</html>







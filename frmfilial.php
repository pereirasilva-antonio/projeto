<?php

include('conexao.php'); 

$idfilial= isset($_GET["idfilial"]) ? $_GET["idfilial"]: null;
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
            $sql = "delete  FROM  tblfilial where idfilial= :idfilial";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":idfilial",$idfilial);
            $stmt->execute();
            header("Location:listarfilial.php");
        }
        if($idfilial){

            //estou buscando os dados do cliente no BD
            $sql = "SELECT * FROM  tblfilial where idfilial= :idfilial";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":idfilial",$idfilial);
            $stmt->execute();
            $tblfilial = $stmt->fetch(PDO::FETCH_OBJ);
            //var_dump($tblfilial);

        }

        if($_POST){

            if($_POST["idfilial"]){

                $sql = "UPDATE tblfilial SET filial=:filial, endereco=:endereco, telefone=:telefone WHERE idfilial =:idfilial";
                $stmt = $con->prepare($sql);
                $stmt->bindValue(":filial", $_POST["filial"]);
                $stmt->bindValue(":endereco", $_POST["endereco"]);
                $stmt->bindValue(":telefone", $_POST["telefone"]);
                $stmt->bindValue(":idfilial", $_POST["idfilial"]);
                $stmt->execute();

            } else {

                $sql = "INSERT INTO tblfilial(filial,endereco,telefone) VALUES (:filial,:endereco,:telefone)";
                $stmt = $con->prepare($sql);
                $stmt->bindValue(":filial",$_POST["filial"]);
                $stmt->bindValue(":endereco",$_POST["endereco"]);
                $stmt->bindValue(":telefone",$_POST["telefone"]);
                $stmt->execute();
            }
            header("Location:listarfilial.php");
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
<h1>Cadastro Filial</h1> 
</nav>

<h1></h1>

<nav class="navbar navbar-dark bg-info">
<form method="POST">                                          <!-- isset (seexistir) então cliente->nome  senão nulo -->
filial  <input type="text" name="filial"        value="<?php echo isset($tblfilial) ? $tblfilial->filial : null ?>"><br>
<h1></h1>
endereco <input type="text" name="endereco"       value="<?php echo isset($tblfilial) ? $tblfilial->endereco : null ?>"><br>
<h1></h1>
telefone <input type="text" name="telefone"       value="<?php echo isset($tblfilial) ? $tblfilial->telefone : null ?>"><br>
<h1></h1>
<input type="hidden"     name="idfilial"   value="<?php echo isset($tblfilial) ? $tblfilial->idfilial : null ?>"><br>
</nav>
<h1></h1>
<button type="button" class="btn btn-primary">
<input type="submit">
</button>
    <h1></h1>
    </form>
    <button type="button" class="btn btn-secondary">
<a href="listarfilial.php">volta</a>
</button>
</div>
</body>
</html>






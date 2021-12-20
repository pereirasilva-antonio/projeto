<?php

include('conexao.php'); 

$idagend= isset($_GET["idagend"]) ? $_GET["idagend"]: null;
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
            $sql = "delete  FROM  tblagend where idagend= :idagend";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":idagend",$idagend);
            $stmt->execute();
            header("Location:listaragendamentos.php");
        }
        if($idagend){

            //estou buscando os dados do cliente no BD
            $sql = "SELECT * FROM  tblagend where idagend= :idagend";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":idagend",$idagend);
            $stmt->execute();
            $tblagend = $stmt->fetch(PDO::FETCH_OBJ);
            //var_dump($tblagend);

        }

        if($_POST){

            if($_POST["idagend"]){

                $sql = "UPDATE tblagend SET idcliente=:idcliente, dthragend=:dthragend, fmpagto=:fmpagto, idfilial=:idfilial, iddentista=:iddentista WHERE idagend =:idagend";
                $stmt = $con->prepare($sql);
                $stmt->bindValue(":idcliente", $_POST["idcliente"]);
                $stmt->bindValue(":dthragend", $_POST["dthragend"]);
                $stmt->bindValue(":fmpagto", $_POST["fmpagto"]);
                $stmt->bindValue(":idfilial", $_POST["idfilial"]);
                $stmt->bindValue(":iddentista", $_POST["iddentista"]);
                $stmt->bindValue(":idagend", $_POST["idagend"]);
                $stmt->execute();

            } else {

                $sql = "INSERT INTO tblagend(idcliente,dthragend,fmpagto,idfilial,iddentista) VALUES (:idcliente,:dthragend,:fmpagto,:idfilial,:iddentista)";
                $stmt = $con->prepare($sql);
                $stmt->bindValue(":idcliente",$_POST["idcliente"]);
                $stmt->bindValue(":dthragend",$_POST["dthragend"]);
                $stmt->bindValue(":fmpagto",$_POST["fmpagto"]);
                $stmt->bindValue(":idfilial",$_POST["idfilial"]);
                $stmt->bindValue(":iddentista",$_POST["iddentista"]);
                $stmt->execute();
            }
            header("Location:listaragendamentos.php");
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
<h1>Cadastro de Agendamento</h1> 
</nav>

<h1></h1>

<nav class="navbar navbar-dark bg-info">
<form method="POST">                                          <!-- isset (seexistir) então cliente->nome  senão nulo -->
IDcliente  <input type="text" name="idcliente"        value="<?php echo isset($tblagend) ? $tblagend->idcliente : null ?>"><br>
<h1></h1>
DtHragend <input type="datetime-local" name="dthragend"       value="<?php echo isset($tblagend) ? $tblagend->dthragend : null ?>"><br>
<h1></h1>
Fmpagto <input type="text" name="fmpagto"       value="<?php echo isset($tblagend) ? $tblagend->fmpagto : null ?>"><br>
<h1></h1>
IDfilial <input type="text" name="idfilial"       value="<?php echo isset($tblagend) ? $tblagend->idfilial : null ?>"><br>
<h1></h1>
IDdentista <input type="text" name="iddentista"       value="<?php echo isset($tblagend) ? $tblagend->iddentista : null ?>"><br>
<h1></h1>
<input type="hidden"     name="idagend"   value="<?php echo isset($tblagend) ? $tblagend->idagend : null ?>"><br>
</nav>
<h1></h1>
<button type="button" class="btn btn-primary">
<input type="submit">
</button>
    <h1></h1>
    </form>
    <button type="button" class="btn btn-secondary">
<a href="listaragendamentos.php">volta</a>
</button>
</div>
</body>
</html>







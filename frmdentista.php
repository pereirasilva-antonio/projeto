<?php

include('conexao.php'); 

$iddentista= isset($_GET["iddentista"]) ? $_GET["iddentista"]: null;
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
            $sql = "delete  FROM  tbldentista where iddentista= :iddentista";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":iddentista",$iddentista);
            $stmt->execute();
            header("Location:listardentista.php");
        }
        if($iddentista){

            //estou buscando os dados do cliente no BD
            $sql = "SELECT * FROM  tbldentista where iddentista= :iddentista";
            $stmt = $con->prepare($sql);
            $stmt->bindValue(":iddentista",$iddentista);
            $stmt->execute();
            $dentista = $stmt->fetch(PDO::FETCH_OBJ);
            //var_dump($dentista);

        }

        if($_POST){

            if($_POST["iddentista"]){

                $sql = "UPDATE tbldentista SET dentista=:dentista, dthrdisponivel=:dthrdisponivel, idfilial=:idfilial WHERE iddentista =:iddentista";
                $stmt = $con->prepare($sql);
                $stmt->bindValue(":dentista", $_POST["dentista"]);
                $stmt->bindValue(":dthrdisponivel", $_POST["dthrdisponivel"]);
                $stmt->bindValue(":idfilial", $_POST["idfilial"]);
                $stmt->bindValue(":iddentista", $_POST["iddentista"]);
                $stmt->execute();

            } else {

                $sql = "INSERT INTO tbldentista(dentista,dthrdisponivel,idfilial) VALUES (:dentista,:dthrdisponivel,:idfilial)";
                $stmt = $con->prepare($sql);
                $stmt->bindValue(":dentista",$_POST["dentista"]);
                $stmt->bindValue(":dthrdisponivel",$_POST["dthrdisponivel"]);
                $stmt->bindValue(":idfilial",$_POST["idfilial"]);
                $stmt->execute();
            }
            header("Location:listardentista.php");
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
<h1>Cadastro Dentista</h1> 
</nav>

<h1></h1>

<nav class="navbar navbar-dark bg-info">
<form method="POST">                                          <!-- isset (seexistir) então cliente->nome  senão nulo -->
Dentista  <input type="text" name="dentista"        value="<?php echo isset($dentista) ? $dentista->dentista : null ?>"><br>
<h1></h1>
Dthrdisponivel <input type="datetime-local" name="dthrdisponivel"       value="<?php echo isset($dentista) ? $dentista->dthrdisponivel : null ?>"><br>
<h1></h1>
Idfilial <input type="text" name="idfilial"       value="<?php echo isset($dentista) ? $dentista->idfilial : null ?>"><br>
<h1></h1>
<input type="hidden"     name="iddentista"   value="<?php echo isset($dentista) ? $dentista->iddentista : null ?>"><br>
</nav>
<h1></h1>
<button type="button" class="btn btn-primary">
<input type="submit">
</button>
    <h1></h1>
    </form>
    <button type="button" class="btn btn-secondary">
<a href="listardentista.php">volta</a>
</button>
</div>
</body>
</html>







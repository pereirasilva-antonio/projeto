<?php
include("conexao.php");

try{

    $sql = "SELECT * from tbldentista";
    $qry = $con->query($sql);
    $dentista = $qry->fetchAll(PDO::FETCH_OBJ);
   //echo "<pre>";
  //print_r($dentista);
  ///die();
} catch(PDOException $e){
    echo $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>listar Dentista</title>

</head>

<body>
<div class="container">
  <div class="row justify-content-md-center">
    <div class="col col-lg-2">

    </div>
    <h1></h1>
    <nav class="navbar navbar-dark bg-info">
<h1>Lista Dentista</h1>
</nav>
</div>
<hr>
<div class="container">
<a href="index.html"      class="btn btn-success btn-lg btn-block">Home</a>
<a href="frmdentista.php" class="btn btn-outline-success btn-lg btn-block">Novo Cadastro</a>
<div class="p-3 border bg-light">
  </div>

<table class="table table-secondary table-primary bg-secondary  table-info table-hover">
    <thead>
    <tr>
           <th>ID</th>
           <th>Dentista</th>
           <th>dthrdisponivel</th>
           <th>idfilial</th>
           <th1></th1>
           <th colspan=2>Ações</th>
        </tr>

    </thead>
    <tbody>

        <?php foreach($dentista as $dentista) { ?>
        <tr>
            <td><?php echo $dentista->iddentista ?></td>
            <td><?php echo $dentista->dentista ?></td>
            <td><?php echo $dentista->dthrdisponivel ?></td>
            <td><?php echo $dentista->idfilial ?></td>
            <td><a href="frmdentista.php?iddentista=<?php echo $dentista->iddentista ?>" class="btn btn-warning">Editar</a></td>
            <td><a href="frmdentista.php?op=del&iddentista=<?php echo  $dentista->iddentista ?>" class="btn btn-danger">Excluir</a></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
</div>
</body>
</html>


<?php
include("conexao.php");

try{

    $sql = "SELECT * from tblfilial";
    $qry = $con->query($sql);
    $filial = $qry->fetchAll(PDO::FETCH_OBJ);
   //echo "<pre>";
  //print_r($filial);
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
    <title>listar filial</title>

</head>

<body>
<div class="container">
  <div class="row justify-content-md-center">
    <div class="col col-lg-2">
  <h1></h1>
    </div>
    <nav class="navbar navbar-dark bg-info">
<h1>Lista Filial</h1>
</nav>
</div>
<hr>
<div class="container">
<a href="index.html"      class="btn btn-success btn-lg btn-block">Home</a>
<a href="frmfilial.php" class="btn btn-outline-success btn-lg btn-block">Novo Cadastro</a>
<div class="p-3 border bg-light">
  </div>

<table class="table table-secondary table-primary bg-secondary  table-info table-hover">
    <thead>
    <tr>
           <th>ID</th>
           <th>Filial</th>
           <th>End.</th>
           <th>Tel.</th>
           <th1></th1>
           <th colspan=2>Ações</th>
        </tr>

    </thead>
    <tbody>

        <?php foreach($filial as $filial) { ?>
        <tr>
            <td><?php echo $filial->idfilial ?></td>
            <td><?php echo $filial->filial ?></td>
            <td><?php echo $filial->endereco ?></td>
            <td><?php echo $filial->telefone ?></td>
            <td><a href="frmfilial.php?idfilial=<?php echo $filial->idfilial ?>" class="btn btn-warning">Editar</a></td>
            <td><a href="frmfilial.php?op=del&idfilial=<?php echo  $filial->idfilial ?>" class="btn btn-danger">Excluir</a></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
</div>
</body>
</html>


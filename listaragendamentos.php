<?php
include("conexao.php");

try{

    $sql = "SELECT * from tblagend";
    $qry = $con->query($sql);
    $agendamento = $qry->fetchAll(PDO::FETCH_OBJ);
   //echo "<pre>";
  //print_r($agendamento);
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
    <title>Document</title>

</head>

<body>
<div class="container">
  <div class="row justify-content-md-center">
    <div class="col col-lg-2">
    </div>
    <h1></h1>
    <nav class="navbar navbar-dark bg-info">
<h1>Lista de Agendamentos</h1>
</nav>
</div>
<hr>
<div class="container">
<a href="index.html"      class="btn btn-success btn-lg btn-block">Home</a>
<a href="frmagendamentos.php" class="btn btn-outline-success btn-lg btn-block">Novo Cadastro</a>
<div class="p-3 border bg-light">
  </div>

<table class="table table-secondary table-primary bg-secondary  table-info table-hover">
    <thead>
        <tr>
           <th>ID</th>
           <th>IDCliente</th>
           <th>DTHRagend</th>
           <th>FMPGTO</th>
           <th>IDfilial</th>
           <th>IDdentista</th>
           <th1></th1>
           <th colspan=2>Ações</th>
        </tr>

    </thead>
    <tbody>

        <?php foreach($agendamento as $agendamento) { ?>
        <tr>

            <td><?php echo $agendamento->idagend ?></td>
            <td><?php echo $agendamento->idcliente ?></td>
            <td><?php echo $agendamento->dthragend ?></td>
            <td><?php echo $agendamento->fmpagto ?></td>
            <td><?php echo $agendamento->idfilial ?></td>
            <td><?php echo $agendamento->iddentista ?></td>
            <td><a href="frmagendamentos.php?idagend=<?php echo $agendamento->idagend ?>" class="btn btn-warning">Editar</a></td>
            <td><a href="frmagendamentos.php?op=del&idagend=<?php echo  $agendamento->idagend ?>" class="btn btn-danger">Excluir</a></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
</div>
</body>
</html>



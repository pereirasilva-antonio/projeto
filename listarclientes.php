<?php
include("conexao.php");

try{

    $sql = "SELECT * from tblclientes";
    $qry = $con->query($sql);
    $tblclientes = $qry->fetchAll(PDO::FETCH_OBJ);
   //echo "<pre>";
  //print_r($tblclientes);
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
    <title>listar clientes</title>

</head>

<body>
<div class="container">
  <div class="row justify-content-md-center">
    <div class="col col-lg-2">
    </div>
    <h1></h1>
<nav class="navbar navbar-dark bg-info">
<h1>Lista de clientes</h1>
</nav>
</div>
<hr>
<div class="container">
<a href="index.html"      class="btn btn-success btn-lg btn-block">Home</a>
<a href="frmclientes.php" class="btn btn-outline-success btn-lg btn-block">Novo Cadastro</a>
</div>
<div class="p-3 border bg-light">
  </div>
<table class="table table-secondary table-primary bg-secondary  table-info table-hover">
    <thead>
    <tr>
           <th>ID</th>
           <th>Nome</th>
           <th>Telefone</th>
           <th>Endereco</th>
           <th>E-mail</th>
           <th1></th1>
           <th colspan=2>Ações</th>
        </tr>

    </thead>
    <tbody>

        <?php foreach($tblclientes as $tblclientes) { ?>
        <tr>
            <td><?php echo $tblclientes->idcliente ?></td>
            <td><?php echo $tblclientes->nome ?></td>
            <td><?php echo $tblclientes->telefone ?></td>
            <td><?php echo $tblclientes->endereco ?></td>
            <td><?php echo $tblclientes->email ?></td>
            <td><a href="frmclientes.php?idcliente=<?php echo $tblclientes->idcliente ?>" class="btn btn-warning">Editar</a></td>
            <td><a href="frmclientes.php?op=del&idcliente=<?php echo  $tblclientes->idcliente ?>" class="btn btn-danger">Excluir</a></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
</div>
</body>
</html>


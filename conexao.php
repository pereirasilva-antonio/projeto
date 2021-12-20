<?php

$localhost  = "localhost";
$username   = "root";
$password   = "";
$db         = "bdconsultorio";

try {

    $con = new PDO("mysql:host=$localhost;dbname=$db",$username,$password);
    //var_dump($con); //debugar - Descobrir o que está sendo respondido
} catch(PDOException $e) {

    echo "conexão falhou:<br> ".$e->getMessage();

}
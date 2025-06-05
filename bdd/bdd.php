<?php

try{
    $user = "root";
    $pass = "btssio2023";
    $bdd = new PDO('mysql:host=localhost;dbname=egw', $user, $pass);
}catch(PDOException $e){
    print "Error: " . $e->getMessage() . 
    "<br/";
    die();
}
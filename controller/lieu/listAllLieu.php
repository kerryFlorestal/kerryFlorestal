<?php

require_once("bdd/bdd.php");  // Inclut la connexion à la BDD
require_once("model/lieuModel.php");



$lieu = new lieu($bdd);
$selectAllLieux = $lieu->selectAllLieux();
?>
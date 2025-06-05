<?php

require_once("bdd/bdd.php");  // Inclut la connexion à la BDD
require_once("model/categorieEventModel.php");



$categorie = new categorie($bdd);
$selectAllCategorieEvents = $categorie->selectAllCategorieEvents();
?>
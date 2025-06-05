<?php

require_once("bdd/bdd.php");  // Inclut la connexion à la BDD
require_once("model/commandeModel.php");



$commande = new commande($bdd);
$selectAllCommandes = $commande->selectAllCommandes();
?>
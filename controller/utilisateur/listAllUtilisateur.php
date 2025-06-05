<?php

require_once("bdd/bdd.php");  // Inclut la connexion à la BDD
require_once("model/utilisateurModel.php");



$Utilisateur = new Utilisateur($bdd);
$selectAllClients = $Utilisateur->selectAllClients();
?>
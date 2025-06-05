<?php

require_once("bdd/bdd.php");  // Inclut la connexion à la BDD
require_once("model/commandeModel.php");

// Vérifie si idClient est défini
$idClient = isset($_GET['idClient']) ? intval($_GET['idClient']) : 0;  // Exemple pour GET

$commande = new commande($bdd);
$selectAllCommandesById = $commande->selectAllCommandesById($idClient);


?>

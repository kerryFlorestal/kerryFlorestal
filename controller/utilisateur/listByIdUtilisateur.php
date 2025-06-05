<?php
require_once("bdd/bdd.php");  // Inclut la connexion à la BDD
require_once("model/utilisateurModel.php");

// Initialiser $filtre, soit depuis POST, GET ou avec une valeur par défaut
$filtre = "";
if(isset($_POST['filtre'])) {
    $filtre = $_POST['filtre'];
} elseif(isset($_GET['filtre'])) {
    $filtre = $_GET['filtre'];
}

$Utilisateur = new Utilisateur($bdd);
$selectLikeClient = $Utilisateur->selectLikeClient($filtre);
?>
<?php

require_once("bdd/bdd.php");  // Inclut la connexion à la BDD
require_once("model/eventModel.php");



$event = new event($bdd);
$lesEvenements = $event->lesEvenements();
?>
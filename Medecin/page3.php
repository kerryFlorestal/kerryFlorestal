<link rel="icon" type="image/x-icon" href="images/logo.png">
<link rel="stylesheet" href="page.css"/> 


<?php
require_once("modèle/modele.php");
?>

<header>
<div class="icons">
            <a href="accueil.php">
                <img src="images/home.png" height= "50" width="50"></a>


<h2> Gestion des RDV </h2>
</header>
<center>
<?php

$lesPatients = selectAllPatient();
$lesMedecins = selectAllMedecin();
 


$leRDV = null;
if (isset($_GET['action']) && isset($_GET['idRDV'])){
    $action = $_GET['action'];
    $idRDV = $_GET['idRDV'];
    switch($action){
        case "supp" : deleteRDV ($idRDV); break;
        case "edit" : 
        $leRDV = selectWhereRDV($idRDV);
        break;
    }
}
    require_once ("vue/vue_insert_rdv.php");
    if(isset($_POST['Valider'])){
        insertRDV($_POST);
        echo "<br> Insertion réussie du rdv.";
    }

    if (isset($_POST['Modifier'])){
        updateRDV($_POST);
        header(("Location: page3.php"));
    }
    $lesRDV = selectAllRDV();
    require_once ("vue/vue_select_rdv.php");
?>

<footer class="footer">
<div class="footer-content">
            <p> 12 rue de Cléry, 75002 Paris </p>
        </div>
        <div class="footer-coordinates">
        <p> Fixe : 0605170973 </p>
        <div class="icons">
            <a href="https://www.instagram.com/doctolib/?hl=fr">
                <img src="images/instagram.png" height= "50" width="50"></a>
            <a href="https://twitter.com/doctolib">
                <img src="images/x.png" height= "50" width="50"></a>
            <a href="https://www.facebook.com/doctolib/?locale=fr_FR">
                <img src="images/facebook.png" height= "50" width="50"></a>

</footer>
</center>
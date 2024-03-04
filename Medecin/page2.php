<link rel="icon" type="image/x-icon" href="images/logo.png">
<link rel="stylesheet" href="page.css"/> 


<?php
require_once("modèle/modele.php");
?>

<header>
<div class="icons">
            <a href="accueil.php">
                <img src="images/home.png" height= "50" width="50"></a>


<h2> Gestion des Patients </h2>
</header>
<center>
<?php

$lePatient = null;
if (isset($_GET['action']) && isset($_GET['idpatient'])){
    $action = $_GET['action'];
    $idPatient = $_GET['idpatient'];
    switch($action){
        case "supp" : deletePatient ($idPatient); break;
        case "edit" : 
        $lePatient = selectWherePatient($idPatient);
        break;
    }
}
    require_once ("vue/vue_insert_patient.php");
    if(isset($_POST['Valider'])){
        insertPatient($_POST);
        echo "<br> Insertion réussie du patient.";
    }

    if (isset($_POST['Modifier'])){
        updatePatient($_POST);
        header("Location: page2.php");
    }
    $lespatients = selectAllPatient();
    
    require_once ("vue/vue_select_patient.php");
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
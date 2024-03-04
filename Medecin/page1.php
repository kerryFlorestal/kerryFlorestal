<link rel="icon" type="image/x-icon" href="images/logo.png">
<link rel="stylesheet" href="page.css"/> 

<?php
require_once("modèle/modele.php");
?>
<header>
 <div class="icons">
            <a href="accueil.php">
                <img src="images/home.png" height= "50" width="50"></a>


<h2> Gestion des Medecins </h2>
</header>
<center>
<?php
$leMedecin = null;
if (isset($_GET['action']) && isset($_GET['idMedecin'])){
    $action = $_GET['action'];
    $idMedecin = $_GET['idMedecin'];
    switch($action){
        case "supp" : deleteMedecin ($idMedecin); break;
        case "edit" : 
        $leMedecin = selectWhereMedecin($idMedecin);
        break;
    }
}
    require_once ("vue/vue_insert_medecin.php");
    if(isset($_POST['Valider'])){
        insertMedecin($_POST);
        echo "<br> Insertion réussie du medecin.";
    }

    if (isset($_POST['Modifier'])){
        updateMedecin($_POST);
        header(("Location: page1.php"));
    }
    $lesMedecins = selectAllMedecin();
    require_once ("vue/vue_select_medecin.php");
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
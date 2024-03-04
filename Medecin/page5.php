<link rel="icon" type="image/x-icon" href="images/logo.png">
<link rel="stylesheet" href="page.css"/> 


<?php
require_once("modèle/modele.php");
?>

<header>
<div class="icons">
            <a href="accueil.php">
                <img src="images/home.png" height= "50" width="50"></a>


<h2> Gestion des Médicaments </h2>
</header>
<center>
<?php
$leMedicament = null;
if (isset($_GET['action']) && isset($_GET['idmedicament'])){
    $action = $_GET['action'];
    $idmedicament = $_GET['idmedicament'];
    switch($action){
        case "supp" : deleteMedicament ($idmedicament); break;
        case "edit" : 
        $leMedicament = selectWhereMedicament($idmedicament);
        break;
    }
}
    require_once ("vue/vue_insert_medicament.php");
    if(isset($_POST['Valider'])){
        insertMedicament($_POST);
        echo "<br> Insertion réussie du medicament.";
    }

    if (isset($_POST['Modifier'])){
        updateMedicament($_POST);
        header(("Location: page5.php"));
    }
    $lesMedicaments = selectAllMedicament();
    require_once ("vue/vue_select_medicament.php");
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
<link rel="icon" type="image/x-icon" href="images/logo.png">
<link rel="stylesheet" href="page.css"/> 


<?php
require_once("modèle/modele.php");
?>

<header>
<div class="icons">
            <a href="accueil.php">
                <img src="images/home.png" height= "50" width="50"></a>


<h2> Gestion des Ordonnances </h2>
</header>
<center>
<?php
$lordonance = null;
if (isset($_GET['action']) && isset($_GET['idordonance'])){
    $action = $_GET['action'];
    $idordonance = $_GET['idordonance'];
    switch($action){
        case "supp" : deleteOrdonance ($idordonance); break;
        case "edit" : 
        $lordonance = selectWhereOrdonance($idordonance);
        break;
    }
}
    require_once ("vue/vue_insert_ordonance.php");
    if(isset($_POST['Valider'])){
        insertOrdonance($_POST);
        echo "<br> Insertion réussie de l'ordonance.";
    }

    if (isset($_POST['Modifier'])){
        updateOrdonance($_POST);
        header(("Location: page4.php"));
    }
    $lesOrdonances = selectAllOrdonance();
    require_once ("vue/vue_select_ordonance.php");
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
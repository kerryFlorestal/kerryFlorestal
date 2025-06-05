
<style>
body{
	color: black;
    background-color: #0d0d0d;
}
</style>

<?php
include ("../../bdd/bdd.php");
?>
<?php
// Connexion à la base de données avec PDO
// Enregistrer ou mettre à jour l'événement en fonction de la méthode HTTP (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     
    // Récupérer les données envoyées via le formulaire
    
    $nomCategorie = $_POST['nomCategorie'];
    $description = $_POST['description'];
    


    // Si le formulaire contient le bouton "Modifier", on met à jour un événement existant
    if (isset($_POST['Modifier'])) {
        $idCategorieEvent = $_POST['idCategorieEvent'];
        
        // Préparer la requête SQL pour la mise à jour de l'événement
        $stmt = $bdd->prepare("
            UPDATE Evenement 
            SET nomEvent = :nomEvent, dateEvent = :dateEvent, description = :description, prixBillet = :prixBillet, 
                idCategorieEvent = :idCategorieEvent, idLieu = :idLieu
            WHERE idEvenement = :idEvenement
        ");
        
        // Exécuter la mise à jour avec les paramètres correspondants
      
        
    }
}
?>
<style>
    
<style>
    body {
        font-family: 'Arial', sans-serif;
        color: #ecf0f1;
        margin: 0;
        padding: 0;
        text-align: center;
    }

    h2 {
        margin-top: 30px;
        color: #e74c3c;
    }

    p {
        color: #bdc3c7;
        margin-top: 20px;
    }
/* Style pour le conteneur bozo */
.bozo {
    border-radius: 15px;
    padding: 20px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
    max-width: 800px;
    margin: 20px auto;
    color: #ffffff;
}

/* Style pour le formulaire */
form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

/* Style pour le tableau du formulaire */
.bozo table {
    width: 100%;
    border-collapse: collapse;
    color: #e0e0e0;
}

.bozo table td {
    padding: 12px;
    vertical-align: middle;
}

.bozo table td:first-child {
    font-weight: bold;
    color: #a3bffa;
}

/* Style pour les champs de saisie */
.bozo input[type="text"],
.bozo input[type="date"],
.bozo input[type="time"],
.bozo input[type="number"],
.bozo input[type="float"],
.bozo select {
    width: 100%;
    padding: 8px;
    border: none;
    border-radius: 5px;
    background-color: #3b4a6b;
    color: #ffffff;
    font-size: 14px;
    transition: all 0.3s ease;
}

.bozo input[type="text"]:focus,
.bozo input[type="date"]:focus,
.bozo input[type="time"]:focus,
.bozo input[type="number"]:focus,
.bozo input[type="float"]:focus,
.bozo select:focus {
    outline: none;
    background-color: #4a5e8c;
    box-shadow: 0 0 8px rgba(163, 191, 250, 0.5);
}

/* Style pour le champ fichier */
.bozo input[type="file"] {
    padding: 5px;
    color: #a3bffa;
}

/* Style pour les boutons */
.bozo input[type="reset"],
.bozo input[type="submit"] {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    background-color: #7289da;
    color: #ffffff;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.bozo input[type="reset"]:hover,
.bozo input[type="submit"]:hover {
    background-color: #5a6eb5;
}

/* Style pour le formulaire de filtre */
.form-futuriste {
    background: #2a4066;
    padding: 15px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    max-width: 400px;
    margin: 20px auto;
}

.form-futuriste input[type="text"] {
    padding: 8px;
    border: none;
    border-radius: 5px;
    background-color: #3b4a6b;
    color: #ffffff;
    margin-right: 10px;
}

.form-futuriste input[type="submit"] {
    padding: 8px 15px;
    border: none;
    border-radius: 5px;
    background-color: #7289da;
    color: #ffffff;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.form-futuriste input[type="submit"]:hover {
    background-color: #5a6eb5;
}

/* Style pour le tableau de liste */
.bozo table[border="1"] {
    width: 100%;
    border-collapse: collapse;
    background-color: #1e2a44;
    color: #e0e0e0;
    font-size: 14px;
}

.bozo table[border="1"] th,
.bozo table[border="1"] td {
    padding: 12px;
    text-align: center;
    border: 1px solid #3b4a6b;
}

.bozo table[border="1"] th {
    background-color: #2a4066;
    color: #a3bffa;
    font-weight: bold;
}

.bozo table[border="1"] tr:nth-child(even) {
    background-color: #2a3a5a;
}

.bozo table[border="1"] tr:hover {
    background-color: #3b4a6b;
    transition: background-color 0.2s ease;
}

/* Style pour les icônes d'opération */
.bozo table[border="1"] a {
    color: #7289da;
    margin: 0 5px;
    text-decoration: none;
    font-size: 16px;
    transition: color 0.3s ease;
}

.bozo table[border="1"] a:hover {
    color: #a3bffa;
}

/* Style pour la petite note sous imageKey */
.bozo small {
    display: block;
    margin-top: 5px;
    font-size: 12px;
}
</style>

<center>
<h1> Categories de jeux</h1>

<div class="bozo">
<form action="controller/categorie/categorieController.php" method="post">
	<table>
		<tr>
			<td> Categorie de jeux </td>
			<td> <input type="text" name="nomCategorie" 
				value="<?php if(isset($laCategorie)) echo $laCategorie['nomCategorie'] ?>"></td>
		</tr>
		<tr>
			<td> description </td>
			<td> <input type="text" name="description"
				value="<?php if(isset($laCategorie)) echo $laCategorie['description'] ?>"></td>
		</tr>
		<tr>
			<tr>
                <td><input type="reset" value="Annuler"></td>
                <td><input type="hidden" name="action" value="valider"><br></td>
                <td><input type="submit" name="ajouter" value="ajouter"></td>
            </tr>
	</table> 
	<?php 
	if(isset($laCategorie)) {
		echo "<input type ='hidden' name='idCategorieEvent' value ='".$laCategorie['idCategorieEvent']."'>";
	}
	?>
</form>
</div>
</center>

<?php
require_once('controller/categorie/selectAllCategorie.php');
?>

<center>



<br>
<div class="bozo">
<table border="1">
    <tr>
        <td>id Categorie</td>
        <td>Categorie</td>
        <td>description</td>
        <?php
        if($_SESSION['role'] == 'admin'){
            echo"<td>Opérations</td>";
        }
        ?>
        
        
         
    </tr>
    <?php 
// Ensure $lesCategories is always an array, even if empty
$selectAllCategorieEvents = isset($selectAllCategorieEvents) ? $selectAllCategorieEvents : [];

foreach($selectAllCategorieEvents as $uneCategorieEvent): 
?>
    <tr>
        <td><?= htmlspecialchars($uneCategorieEvent['idCategorieEvent']) ?></td>
        <td><?= htmlspecialchars($uneCategorieEvent['nomCategorie']) ?></td>
        <td><?= htmlspecialchars($uneCategorieEvent['description']) ?></td>

        <td>
            <a href='index.php?page=5&action=sup&idCategorieEvent=<?= $uneCategorieEvent['idCategorieEvent'] ?>'>
                <img src='images/sup.png' height='50' width='50' alt='Supprimer'>
            </a>
            <a href='index.php?page=5&action=edit&idCategorieEvent=<?= $uneCategorieEvent['idCategorieEvent'] ?>'>
                <img src='images/edit.png' height='50' width='50' alt='Éditer'>
            </a>
        </td>
    </tr>
<?php endforeach; ?>
</table>
</div>
</center>

<?php
include(__DIR__ . '/../../bdd/bdd.php');
?>

<?php

// Connexion à la base de données avec PDO
   // Si le formulaire contient le bouton "Modifier", on met à jour un événement existant

// Charger un événement spécifique pour modification si l'ID est passé en paramètre dans l'URL
$lEvenement = null;
if (isset($_GET['idEvenement'])) {
    // Préparer la requête pour sélectionner l'événement par son ID
    $stmt = $bdd->prepare("SELECT * FROM evenement WHERE idEvenement = :idEvenement");
    
    // Exécuter la requête avec l'ID de l'événement
    $stmt->execute(['idEvenement' => $_GET['idEvenement']]);
    
    // Récupérer l'événement correspondant dans un tableau associatif
    $lEvenement = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<style>
    body {
        font-family: 'Arial', sans-serif;
        color: #ecf0f1;
        margin: 0;
        padding: 0;
        text-align: center;
    }

    h2 {
        font-size: 2.5rem;
        margin-top: 30px;
        color: #e74c3c;
    }

    p {
        font-size: 1.2rem;
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


<!-- Formulaire pour la gestion des événements -->
<center>
    <h1>Gestion des Événements</h1>
    <div class="bozo">
        <!-- Formulaire avec la méthode POST pour envoyer les données -->
<!-- Formulaire avec la méthode POST pour envoyer les données au contrôleur -->
<form action="controller/event/eventController.php" method="post" enctype="multipart/form-data">            <table>
                <!-- Champ pour le nom de l'événement -->
                <tr>
                    <td>Nom de l'événement</td>
                    <td>
                        <input type="text" name="nomEvent" value="<?php if (!empty($lEvenement) && (isset($lEvenement))) echo $lEvenement['nomEvent']; ?>">
                    </td>
                </tr>
                
                <!-- Champ pour la date de l'événement -->
                <tr>
                    <td>Date de l'événement</td>
                    <td>
                        <input type="date" name="dateEvent" value="<?php if (isset($lEvenement)) echo $lEvenement['dateEvent']; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Heure</td>
                    <td>
                        <input type="Time" name="Heure" value="<?php if (isset($lEvenement)) echo $lEvenement['Heure']; ?>">
                    </td>
                </tr>
                <!-- Champ pour la description de l'événement -->
                <tr>
                    <td>Nom du Jeu</td>
                    <td>
                        <input type="text" name="description" value="<?php if (!empty($lEvenement) && (isset($lEvenement))) echo $lEvenement['description']; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Prix Billet</td>
                    <td>
                        <input type="float" name="prixBillet" value="<?php if (!empty($lEvenement) && (isset($lEvenement))) echo $lEvenement['prixBillet']; ?>">
                    </td>
                </tr>
                <tr>
                <td>Disponible</td>
                <td>
   <select name="disponible" 
           style="background-color: <?php 
               if (isset($lEvenement['disponible'])) {
                   echo ($lEvenement['disponible'] == 0) ? '#ff4d4d' : '#4d79ff';
               }
           ?>;"
           onchange="this.style.backgroundColor = (this.value == 0 ? '#ff4d4d' : '#4d79ff');">
       <option value="1" <?php if (isset($lEvenement) && $lEvenement['disponible'] == 1) echo 'selected'; ?>>Oui</option>
       <option value="0" <?php if (isset($lEvenement) && $lEvenement['disponible'] == 0) echo 'selected'; ?>>Non</option>
   </select>
</td>
                </tr>

                <!-- Champ pour l'ID de la catégorie de l'événement -->
                <tr>
                    <td>Catégorie de Jeux</td>
                    <td>
                        <select name="idCategorieEvent"> <!-- Ajout de name -->
                            <option value="0">Choisir une Catégorie</option>
                            <?php
                            $stmt = $bdd->query("SELECT * FROM categorieevent");
                            while ($categorie = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value='{$categorie['idCategorieEvent']}'";
                                if (isset($lEvenement) && $lEvenement['idCategorieEvent'] == $categorie['idCategorieEvent']) { // Correction ici
                                    echo " selected";
                                }
                                echo ">{$categorie['nomCategorie']}</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>

                <!-- Champ pour l'ID de l'adresse de l'événement -->
                <tr>
                    <td>Lieu</td>
                    <td>
                        <select name="idLieu"> <!-- Ajout de name -->
                            <option value="0">Choisir un lieu</option>
                            <?php
                            $stmt = $bdd->query("SELECT * FROM lieu");
                            while ($lLieu = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value='{$lLieu['idLieu']}'";
                                if (isset($lEvenement) && $lEvenement['idLieu'] == $lLieu['idLieu']) {
                                    echo " selected";
                                }
                                echo ">{$lLieu['nom']}</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>                   
                    <td>Image</td>
                    <td>    
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>ImageKey</td>
                    <td>
                        <input 
                            type="number" 
                            name="imageKey" 
                            value="<?php if (isset($lEvenement)) echo $lEvenement['imageKey']; ?>" 
                            min="1" 
                            max="8" 
                            class="form-control"
                            required
                            oninput="if(this.value < 1) this.value = 1; if(this.value > 8) this.value = 8;"
                            style="width: 100px;"
                        >
                        <small style="color: #666;">Choisir une valeur entre 1 et 8</small>
                    </td>
                </tr>

                <!-- Bouton "Annuler" pour réinitialiser le formulaire -->
                <tr>
                <td><input type="reset" value="Annuler"></td>
					<td>
					<?php if (isset($lEvenement)) { ?>
						<input type="hidden" name="action" value="modifier">
						<input type="submit" name="Modifier" value="Modifier">
					<?php } else { ?>
						<input type="hidden" name="action" value="valider">
						<input type="submit" name="ajouter" value="ajouter">
					<?php } ?>
					</td>
            </tr>
            </table>

            <!-- Si l'événement est chargé pour modification, on ajoute l'ID de l'événement en champ caché -->
            <?php 
            if (isset($lEvenement)){
                echo"<input type='hidden' name='idEvenement' value='" . $lEvenement['idEvenement'] . "' ?>";
                    }  
         ?>
        </form>
    </div>
</center>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['Modifier']) && isset($_POST['idEvenement'])){

        $idEvenement = $_POST['idEvenement'];
        $nomEvent = $_POST['nomEvent'];
        $dateEvent = $_POST['dateEvent'];
        $Heure = $_POST['Heure'];
        $description = $_POST['description'];
        $prixBillet = $_POST['prixBillet'];
        $disponible = $_POST['disponible'];
        $idCategorieEvent = $_POST['idCategorieEvent'];
        $idLieu = $_POST['idLieu'];
        $image = $_POST['image'];
        $imageKey = $_POST['imageKey'];

        $stmt = $bdd->prepare(
            "UPDATE Evenement
            SET nomEvent = :nomEvent, dateEvent = :dateEvent, 
            Heure = :Heure, description = :description, 
            prixBillet = :prixBillet, disponible = :disponible,
            idCategorieEvent = :idcategorieEvent, idLieu = :idLieu,
            image = :image, imageKey = :imageKey");
        
        $stmt->execute([
            'nomEvent' => $nomEvent,
            'dateEvent' => $dateEvent,
            'Heure' => $Heure,
            'description' => $description,
            'prixBillet' => $prixBillet,
            'disponible' => $disponible,
            'idCategorieEvent' => $idCategorieEvent,
            'idLieu' => $idLieu,
            'image' => $image,
            'imageKey' => $imageKey,

        ]);

        header('Location: index.php?page=tournois');
        exit;
    }elseif (isset($_POST['ajouter'])){
        $nomEvent = $_POST['nomEvent'];
        $dateEvent = $_POST['dateEvent'];
        $Heure = $_POST['Heure'];
        $description = $_POST['description'];
        $prixBillet = $_POST['prixBillet'];
        $disponible = $_POST['disponible'];
        $idCategorieEvent = $_POST['idCategorieEvent'];
        $idLieu = $_POST['idLieu'];
        $image = $_POST['image'];
        $imageKey = $_POST['imageKey'];

        $stmt = $bdd->prepare("
INSERT INTO Evenement (nomEvent, dateEvent, Heure, description, 
    prixBillet, disponible, idCategorieEvent, idLieu,
    image, imageKey) VALUES (:nomEvent, :dateEvent, :Heure, :description, 
    :prixBillet, :disponible, :idCategorieEvent, :idLieu,
    :image, :imageKey)");

        $stmt->execute([
            'nomEvent' => $nomEvent,
            'dateEvent' => $dateEvent,
            'Heure' => $Heure,
            'description' => $description,
            'prixBillet' => $prixBillet,
            'disponible' => $disponible,
            'idCategorieEvent' => $idCategorieEvent,
            'idLieu' => $idLieu,
            'image' => $image,
            'imageKey' => $imageKey,
        ]);

        header('Location: index.php?page=tournois');
        exit;
    }
}

?>

<center>
        <div class="form-futuriste">
            <form method="post">
                Filtrer par : <input type="text" name="filtre">
                <input type="submit" name="Filtrer" value="Filtrer">
            </form>
        </div>
        <br>
<?php
require_once('controller/event/listAllEvent.php');
?>
        <div class="bozo">
            <table border="1">
                <tr>
                    <td>Id Événement</td>
                    <td>Nom Événement</td>
                    <td>Date Événement</td>
                    <td>Heure</td>
                    <td>description</td>
                    <td>Prix Billet</td>
                    <td>Disponible</td>
                    <td>Catégorie</td>
                    <td>Lieu</td>
                    <td>imageKey</td>
                    <td>Opérations</td>
                </tr>
                <div class="bozoo">
                <?php
                // Sample PHP loop for displaying events
                foreach($lesEvenements as $unEvenement) 
                { 
            ?>
                <tr>
                    <td><?php echo $unEvenement['idEvenement'] ?></td>
                    <td><?php echo $unEvenement['nomEvent'] ?></td>
                    <td><?php echo $unEvenement['dateEvent'] ?></td>
                    <td><?php echo $unEvenement['Heure'] ?></td>
                    <td><?php echo $unEvenement['description'] ?></td>
                    <td><?php echo $unEvenement['prixBillet'] ?></td>
                    <td><?php echo $unEvenement['disponible'] ?></td>
                    <td><?php echo $unEvenement['idCategorieEvent'] ?></td>
                    <td><?php echo $unEvenement['idLieu'] ?></td>
                    <td><?php echo $unEvenement['imageKey'] ?></td>

                    <td>

                    <a href="index.php?page=tournois&action=supprimer&idEvenement=<?php echo $unEvenement['idEvenement'] ?>" 
                           onclick="return confirm('Êtes-vous sûr de vouloir supprimer le tournois?')"><i class="fa-solid fa-trash-alt"></i></a>
                        |
                        <a href="index.php?page=tournois&idEvenement=<?php echo $unEvenement['idEvenement'] ?>"><i class="fa-solid fa-pen-to-square"></i></a>

                        </form>

                    </td>

                    <td></td>
                </tr>
            <?php
                }
            ?>
                </div>
            </table>
        </div>
    </center>
    <?php
// Traitement de la suppression
if (isset($_GET['action']) && $_GET['action'] == 'supprimer' && isset($_GET['idEvenement'])) {
    $idEvenement = $_GET['idEvenement'];
    
    // Préparer la requête SQL pour la suppression
    $stmt = $bdd->prepare("DELETE FROM evenement WHERE idEvenement = :idEvenement");
    
    // Exécuter la suppression
    $stmt->execute(['idEvenement' => $idEvenement]);
        
    // Rediriger
    header('Location: index.php?page=tournois');
    exit;
}
?>

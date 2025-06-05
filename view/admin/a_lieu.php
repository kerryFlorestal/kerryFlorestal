<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">



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
<?php
include ("./bdd/bdd.php");
?>

<?php
// Connexion à la base de données avec PDO

$leLieu = null;
if (isset($_GET['idLieu'])) {
	// Préparer la requête pour sélectionner le lieu par son ID
	$stmt = $bdd->prepare("SELECT * FROM lieu WHERE idLieu = :idLieu");

	// Exécuter la requête avec l'ID du lieu
	$stmt->execute(['idLieu' => $_GET['idLieu']]);

	// Récupérer le lieu correspondant dans un tableau associatif
	$leLieu = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<center>
	<h1> Gestion des lieux</h1>

	<div class="bozo">
		<!-- Action pointe directement vers le fichier actuel ou index.php, pas vers le contrôleur -->
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>?page=lieu" method="post">
			<table>
				<tr>
					<td> Nom </td>
					<td> <input type="text" name="nom" value="<?php if (isset($leLieu))
						echo $leLieu['nom'] ?>"></td>
				</tr>
				<tr>
					<td> adresse </td>
					<td> <input type="text" name="adresse" value="<?php if (isset($leLieu))
						echo $leLieu['adresse'] ?>">
					</td>
				</tr>
				<tr>
					<td> capacite </td>
					<td> <input type="int" name="capacite" value="<?php if (isset($leLieu))
						echo $leLieu['capacite'] ?>">
					</td>
				</tr>
				<tr>
					<td> description </td>
					<td> <input type="text" name="description"
							value="<?php if (isset($leLieu))
						echo $leLieu['description'] ?>"></td>
				</tr>
				<tr>
					<td>Lieu</td>
					<td>
						<input type="number" name="lieuKey"
							value="<?php if (isset($leLieu))
						echo $leLieu['lieuKey']; ?>" min="1" max="3"
						oninput="if(this.value < 1) this.value = 1; if(this.value > 3) this.value = 3;">
					</td>
				</tr>
				<tr>
					<td><input type="reset" value="Annuler"></td>
					<td>
					<?php if (isset($leLieu)) { ?>
						<input type="hidden" name="action" value="modifier">
						<input type="submit" name="Modifier" value="Modifier">
					<?php } else { ?>
						<input type="hidden" name="action" value="valider">
						<input type="submit" name="ajouter" value="ajouter">
					<?php } ?>
					</td>
				</tr>
			</table>
			<?php
			if (isset($leLieu)) {
				echo "<input type='hidden' name='idLieu' value='" . $leLieu['idLieu'] . "'>";
			}
			?>
		</form>
	</div>
</center>

<?php
// Traitement du formulaire directement dans cette page
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['Modifier']) && isset($_POST['idLieu'])) {
        // C'est une modification
        $idLieu = $_POST['idLieu'];
        $nom = $_POST['nom'];
        $adresse = $_POST['adresse'];
        $capacite = $_POST['capacite'];
        $description = $_POST['description'];
        $lieuKey = $_POST['lieuKey'];
        
        // Préparer la requête SQL pour la mise à jour du lieu
        $stmt = $bdd->prepare("
            UPDATE lieu 
            SET nom = :nom, adresse = :adresse, description = :description, capacite = :capacite, lieuKey = :lieuKey
            WHERE idLieu = :idLieu
        ");
        
        // Exécuter la mise à jour
        $stmt->execute([
            'nom' => $nom,
            'adresse' => $adresse,
            'description' => $description,
            'capacite' => $capacite,
            'lieuKey' => $lieuKey,
            'idLieu' => $idLieu
        ]);
        
        // Rediriger pour éviter la resoumission du formulaire
        header('Location: index.php?page=lieu');
        exit;
    } elseif (isset($_POST['ajouter'])) {
        // C'est un ajout
        $nom = $_POST['nom'];
        $adresse = $_POST['adresse'];
        $capacite = $_POST['capacite'];
        $description = $_POST['description'];
        $lieuKey = $_POST['lieuKey'];
        
        // Préparer la requête SQL pour l'insertion
        $stmt = $bdd->prepare("
            INSERT INTO lieu (nom, adresse, capacite, description, lieuKey)
            VALUES (:nom, :adresse, :capacite, :description, :lieuKey)
        ");
        
        // Exécuter l'insertion
        $stmt->execute([
            'nom' => $nom,
            'adresse' => $adresse,
            'capacite' => $capacite,
            'description' => $description,
            'lieuKey' => $lieuKey,
        ]);
        
        // Rediriger pour éviter la resoumission du formulaire
        header('Location: index.php?page=lieu');
        exit;
    }
}

require_once('controller/lieu/listAllLieu.php');
?>

<center>
	<div class="form-futuriste">
		<form action="index.php?page=lieu" method="post">
			Filtrer par : <input type="text" name="filtre">
			<input type="submit" name="Filtrer" value="Filtrer">
		</form>
	</div>
	<br />
	<div class="bozo">
		<table border="1">
			<tr>
				<td> id Lieu </td>
				<td> Nom </td>
				<td> adresse </td>
				<td> capacite</td>
				<td> description</td>
				<td> lieuKey </td>
				<td> Opérations </td>
			</tr>

		<?php
                // Affichage de tous les lieux
                foreach ($selectAllLieux as $unLieu) {
                 
            ?>
                <tr>
                    <td><?php echo $unLieu['idLieu'] ?></td>
                    <td><?php echo $unLieu['nom'] ?></td>
                    <td><?php echo $unLieu['adresse'] ?></td>
                    <td><?php echo $unLieu['capacite'] ?></td>
                    <td><?php echo $unLieu['description'] ?></td>
                    <td><?php echo $unLieu['lieuKey'] ?></td>
                    
                    <td>
                        <!-- Utilisation de liens pour éviter les problèmes de redirection -->
                        <a href="index.php?page=lieu&action=supprimer&idLieu=<?php echo $unLieu['idLieu'] ?>" 
                           onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce lieu?')"><i class="fa-solid fa-trash-alt"></i></a>
                        |
                        <a href="index.php?page=lieu&idLieu=<?php echo $unLieu['idLieu'] ?>"><i class="fa-solid fa-pen-to-square"></i></a>
                    </td>
                </tr>
            <?php
                }
            ?>
		</table>
	</div>
</center>

<?php
// Traitement de la suppression
if (isset($_GET['action']) && $_GET['action'] == 'supprimer' && isset($_GET['idLieu'])) {
    $idLieu = $_GET['idLieu'];
    
    // Préparer la requête SQL pour la suppression
    $stmt = $bdd->prepare("DELETE FROM lieu WHERE idLieu = :idLieu");
    
    // Exécuter la suppression
    $stmt->execute(['idLieu' => $idLieu]);
    
    // Rediriger
    header('Location: index.php?page=lieu');
    exit;
}
?>
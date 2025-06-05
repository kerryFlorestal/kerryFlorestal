
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


<?php
require_once('controller/utilisateur/listAllUtilisateur.php');
require_once('controller/utilisateur/listByIdUtilisateur.php');
?>

<div class="form-futuriste">
<form action="controller/utilisateur/utilisateurController.php" method="post">
	Filtrer par : <input type="text" name="filtre">
    <input type="hidden" name="action" value="filtre">  <!-- Envoyer l'action en POST pour éviter les risques de sécurité -->
    <input type="submit" name="Filtrer" value="Filtrer">

</form>
</div>
<br>
<div class="bozo">
<table border="1">
	<tr>
		<td> id Client </td>
		<td> nom  </td>
        <td> prenom </td>
        <td> numeroTel </td>
		<td> Email </td>
		<td> Operation </td>
	</tr>
<?php


	foreach($selectAllClients as $unClient){
		echo "<tr>";
		echo "<td>".$unClient['idClient']."</td>";
		echo "<td>".$unClient['nom']."</td>";
        echo "<td>".$unClient['prenom']."</td>";
        echo "<td>".$unClient['numeroTel']."</td>";
		echo "<td>".$unClient['email']."</td>";
		

		echo "<td>";
	
		echo "<a href='index.php?page=9&action=sup&idClient=".$unClient['idClient']."'><img src='images/sup.png' height='50' witdh='50'> </a>";
		
		echo "<a href='index.php?page=9&action=edit&idClient=".$unClient['idClient']."'><img src='images/edit.png' height='50' witdh='50'> </a>";

		echo "</td>";
		
		echo "</tr>";
	}
?>

</table>
</div>











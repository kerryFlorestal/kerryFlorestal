<?php
require_once('controller/commande/selectAllCommandes.php');
?>


<style>
body {
    color: white;
}

.boz {
    width: 100%;
    overflow-x: auto;
    margin: 20px 0;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin: 0 auto;
    background-color: rgba(0, 0, 0, 0.5);
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

th, td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

th {
    background-color: rgba(50, 50, 50, 0.8);
    font-weight: bold;
    text-transform: uppercase;
    font-size: 14px;
    letter-spacing: 1px;
}

tr:hover {
    background-color: rgba(255, 255, 255, 0.05);
}

.actions {
    display: flex;
    gap: 10px;
    justify-content: center;
}

.actions a {
    color: white;
    text-decoration: none;
    padding: 5px 8px;
    border-radius: 4px;
    transition: all 0.3s ease;
}

.actions a:hover {
    transform: scale(1.2);
}

.delete-btn {
    color: #ff5c5c;
}

.edit-btn {
    color: #5c9fff;
}

.state-badge {
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: bold;
    text-align: center;
    display: inline-block;
    min-width: 80px;
}

.state-valide {
    background-color: #4CAF50;
    color: white;
}

.state-en-cours {
    background-color: #2196F3;
    color: white;
}

.state-refuse {
    background-color: #F44336;
    color: white;
}

.state-selector {
    background-color: transparent;
    color: white;
    border: 1px solid white;
    border-radius: 4px;
    padding: 5px;
    cursor: pointer;
}

.state-selector:focus {
    outline: none;
    box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.3);
}
</style>

</style>
<div class="boz">
    <h2>Gestion des Commandes</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Prix Billet</th>
                <th>Client</th>
                <th>Événement</th>
                <th>État</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($selectAllCommandes as $uneCommande) {
                // Définir les classes pour l'état
                $stateClass = '';
                switch($uneCommande['etat']) {
                    case 'Validé':
                        $stateClass = 'state-valide';
                        break;
                    case 'En cours':
                        $stateClass = 'state-en-cours';
                        break;
                    case 'Refusé':
                        $stateClass = 'state-refuse';
                        break;
                }
                
                echo "<tr>";
                echo "<td>" . $uneCommande['idCommande'] . "</td>";
                echo "<td>" . $uneCommande['prixBillet'] . " €</td>";
                echo "<td>" . $uneCommande['idClient'] . "</td>";
                echo "<td>" . $uneCommande['idEvenement'] . "</td>";
                
                // État de la commande avec menu déroulant pour modification
                echo "<td>";
                echo "<form action='controller/commande/commandeController.php' method='post' class='state-form'>";
                echo "<input type='hidden' name='action' value='updateEtat'>";
                echo "<input type='hidden' name='idCommande' value='" . $uneCommande['idCommande'] . "'>";
                echo "<select name='etat' class='state-selector' onchange='this.form.submit()'>";
                echo "<option value='En cours'" . ($uneCommande['etat'] == 'En cours' ? ' selected' : '') . ">En cours</option>";
                echo "<option value='Validé'" . ($uneCommande['etat'] == 'Validé' ? ' selected' : '') . ">Validé</option>";
                echo "<option value='Refusé'" . ($uneCommande['etat'] == 'Refusé' ? ' selected' : '') . ">Refusé</option>";
                echo "</select>";
                echo "</form>";
                echo "</td>";

                // Actions
                echo "<td class='actions'>";
                echo "<a href='index.php?page=4&action=sup&idCommande=" . $uneCommande['idCommande'] . "' class='delete-btn'><i class='fa-solid fa-trash-alt'></i></a>";
                echo "<a href='index.php?page=4&action=edit&idCommande=" . $uneCommande['idCommande'] . "' class='edit-btn'><i class='fa-solid fa-pen-to-square'></i></a>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script>
// Script pour soumettre automatiquement le formulaire lors du changement d'état
document.addEventListener('DOMContentLoaded', function() {
    const stateForms = document.querySelectorAll('.state-form');
    stateForms.forEach(form => {
        const select = form.querySelector('select');
        select.addEventListener('change', function() {
            form.submit();
        });
    });
});
</script>
<h3> Liste des medecins </h3>

<table class="table table-striped table-hover">
    <tr>
        <td> ID Medecin </td>
        <td> Nom </td>
        <td> Prenom </td>
        <td> Telephone </td>
        <td> Email</td>
        <td> Opérations </td>
    </tr>

    <?php
    
    foreach($lesMedecins as $unMedecin){
        echo"<tr>";
        echo"<td>".$unMedecin['idMedecin']."</td>";       
        echo"<td>".$unMedecin['nom']."</td>";
        echo"<td>".$unMedecin['prenom']."</td>";
        echo"<td>".$unMedecin['telephone']."</td>";
        echo"<td>".$unMedecin['email']."</td>";
        echo"<td>";
        echo"<a href='page1.php?action=supp&idMedecin=".
        $unMedecin['idMedecin']."'><img src='images/supp.png' height='50' width='80'> </a>";
        echo"<a href='page1.php?action=edit&idMedecin=".
        $unMedecin['idMedecin']."'><img src='images/edit.png' height='50' width='60'> </a>";
        echo"</td>";
        echo"</tr>";
    
}
?>
</table>

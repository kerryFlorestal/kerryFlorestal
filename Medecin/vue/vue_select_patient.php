<center>

<h3> Liste des patients </h3>

<table class="table table-striped table-hover">
    <tr>
        <td> ID Patient </td>
        <td> Nom </td>
        <td> Prenom </td>
        <td> Adresse </td>
        <td> Telephone </td>
        <td> Email</td>
        <td> Opérations </td>
    </tr>

    <?php
    foreach($lespatients as $unPatient){
        echo"<tr>";
        echo"<td>".$unPatient['idPatient']."</td>";
        echo"<td>".$unPatient['nom']."</td>";
        echo"<td>".$unPatient['prenom']."</td>";
        echo"<td>".$unPatient['adresse']."</td>";
        echo"<td>".$unPatient['telephone']."</td>";
        echo"<td>".$unPatient['email']."</td>";
        echo"<td>";
        echo"<a href='page2.php?action=supp&idpatient=".
        $unPatient['idPatient']."'><img src='images/supp.png' height='50' width='80'> </a>";
        echo"<a href='page2.php?action=edit&idpatient=".
        $unPatient['idPatient']."'><img src='images/edit.png' height='50' width='60'> </a>";
        echo"</td>";
        echo"</tr>";
    }
?>
</table>
</center>



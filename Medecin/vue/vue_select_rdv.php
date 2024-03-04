<h3> Liste des rendez-vous </h3>

<table class="table table-striped table-hover">
    <tr>
        <td> ID RDV </td>
        <td> Date RDV </td>
        <td> Description </td>
        <td> Heure RDV </td>
        <td> Statut</td>
        <td> Patient </td>
        <td> Medecin </td>
        <td> Opérations </td>
    </tr>
    <?php
    foreach($lesRDV as $unrdv){
        echo"<tr>";
        echo"<td>".$unrdv['idRDV']."</td>";
        echo"<td>".$unrdv['dateRDV']."</td>";
        echo"<td>".$unrdv['description']."</td>";
        echo"<td>".$unrdv['heureRDV']."</td>";
        echo"<td>".$unrdv['statut']."</td>";
        echo"<td>".$unrdv['idpatient']."</td>";
        echo"<td>".$unrdv['idMedecin']."</td>";
        echo"<td>";
        echo"<a href='page3.php?action=supp&idRDV=".
        $unrdv['idRDV']."'><img src='images/supp.png' height='50' width='80'> </a>";
        echo"<a href='page3.php?action=edit&idRDV=".
        $unrdv['idRDV']."'><img src='images/edit.png' height='50' width='60'> </a>";
        echo"</td>";
        echo"</tr>";
    }
?>
</table>

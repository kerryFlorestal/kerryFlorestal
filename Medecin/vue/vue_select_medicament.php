<center>
    <h3> Liste des medicaments </h3>

<table class="table table-striped table-hover">
    <tr>
        <td> ID Medicament </td>
        <td> Nom </td>
        <td> Description </td>
        <td> Utilisation </td>
        <td> Ordonance </td>
        <td> Opérations </td>
    </tr>

<?php
    foreach($lesMedicaments as $unmedicament){
        echo"<tr>";
        echo"<td>".$unmedicament['idmedicament']."</td>";
        echo"<td>".$unmedicament['nom']."</td>";
        echo"<td>".$unmedicament['description']."</td>";
        echo"<td>".$unmedicament['utilisation']."</td>";
        echo"<td>".$unmedicament['idordonance']."</td>";
        echo"<td>";
        echo"<a href='page5.php?action=supp&idmedicament=".
        $unmedicament['idmedicament']."'><img src='images/supp.png' height='50' width='80'> </a>";
        echo"<a href='page5.php?action=edit&idmedicament=".
        $unmedicament['idmedicament']."'><img src='images/edit.png' height='50' width='60'> </a>";
        echo"</td>";
        echo"</tr>";
    }
?>

</table>
</center>
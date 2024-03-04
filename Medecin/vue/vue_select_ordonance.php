<h3> Liste des ordonnances </h3>

<table class="table table-striped table-hover">
    <tr>
        <td> ID Ordonance </td>
        <td> Date Ordonance </td>
        <td> Description </td>
        <td> Medecin </td>
        <td> Opérations </td>
    </tr>

    <?php
    
    foreach($lesOrdonances as $uneordonance){
        echo"<tr>";
        echo"<td>".$uneordonance['idordonance']."</td>";       
        echo"<td>".$uneordonance['dateOrdonance']."</td>";
        echo"<td>".$uneordonance['description']."</td>";
        echo"<td>".$uneordonance['idMedecin']."</td>";
        echo"<td>";
        echo"<a href='page4.php?action=supp&idordonance=".
        $uneordonance['idordonance']."'><img src='images/supp.png' height='50' width='80'> </a>";
        echo"<a href='page4.php?action=edit&idordonance=".
        $uneordonance['idordonance']."'><img src='images/edit.png' height='50' width='60'> </a>";
        echo"</td>";
        echo"</tr>";
    
}
?>
</table>

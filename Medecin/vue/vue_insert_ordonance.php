<link rel="stylesheet" href="page.css"/> 

<body>
<h3> Ajout d'une Ordonnance </h3>

<form method="post">
    <table>
        <tr>
            <td> Date Ordonance </td>
            <td><input type="text" name="dateOrdonance"
            value="<?php if ($lordonance!=null) echo $lordonance['dateOrdonance']?>"></td>
        </tr>
        <tr>
            <td> Description </td>
            <td><input type="text" name="description"
            value="<?php if ($lordonance!=null) echo $lordonance['description']?>"></td>
        </tr>
        <tr>
            <td> Medecin </td>
            <td><input type="text" name="idMedecin"
            value="<?php if ($lordonance!=null) echo $lordonance['idMedecin']?>"></td>
        </tr>
        <tr>
            <td><input type="reset" name="Annuler"  value="Annuler"></td>
            <td><input type="submit"
            <?php if($lordonance != null){
                echo 'name = "Modifier" value = "Modifier"';
            }else{
                echo 'name = "Valider" value = "Valider"';
            }
            ?>
            ></td>
        </tr>
    </table>
    <?php 
        if($lordonance !=null){
            echo"<input type ='hidden' name='idordonance' value ='".$lordonance['idordonance']."'>";
        }
        ?>
</form>
</body>
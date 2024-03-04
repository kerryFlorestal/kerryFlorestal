<link rel="stylesheet" href="page.css"/> 
<link rel="icon" type="image/x-icon" href="images/logo.png">

<body>
<h3> Ajout d'un Medicament </h3>

<form method="post">
<table>
        <tr>
            <td> Nom </td>
            <td><input type="text" name="nom"
            value="<?php if ($leMedicament!=null) echo $leMedicament['nom']?>"></td>
        </tr>
        <tr>
            <td> Description </td>
            <td><input type="text" name="description"
            value="<?php if ($leMedicament!=null) echo $leMedicament['description']?>"></td>
        </tr>
        <tr>
            <td> utilisation </td>
            <td><input type="text" name="utilisation"
            value="<?php if ($leMedicament!=null) echo $leMedicament['utilisation']?>"></td>
        </tr>
        <tr>
            <td> Ordonance </td>
            <td><input type="text" name="idordonance"
            value="<?php if ($leMedicament!=null) echo $leMedicament['idordonance']?>"></td>
        </tr>
        <tr>
            <td><input type="reset" name="Annuler"  value="Annuler"></td>
            <td><input type="submit" 
            <?php if($leMedicament != null){
                echo 'name = "Modifier" value = "Modifier"';
            }else{
                echo 'name = "Valider" value = "Valider"';
            }
            ?>
            ></td>
        </tr>
    </table>
    <?php 
        if($leMedicament !=null){
            echo"<input type ='hidden' name='idmedicament' value ='".$leMedicament['idmedicament']."'>";
        }
        ?>
</form>
</body>
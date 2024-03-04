<link rel="stylesheet" href="page.css"/> 
<body>
<h3> Ajout d'un Medecin </h3>

<form method="post">
<table>
        <tr>
            <td> Nom </td>
            <td><input type="text" name="nom"
            value="<?php if ($leMedecin!=null) echo $leMedecin['nom']?>"></td>
        </tr>
        <tr>
            <td> Prenom </td>
            <td><input type="text" name="prenom"
            value="<?php if ($leMedecin!=null) echo $leMedecin['prenom']?>"></td>
        </tr>
        <tr>
            <td> Telephone </td>
            <td><input type="text" name="telephone"
            value="<?php if ($leMedecin!=null) echo $leMedecin['telephone']?>"></td>
        </tr>
        <tr>
            <td> Email </td>
            <td><input type="text" name="email"
            value="<?php if ($leMedecin!=null) echo $leMedecin['email']?>"></td>
        </tr>
        <tr>
            <td><input type="reset" name="Annuler"  value="Annuler"></td>
            <td><input type="submit" 
            <?php if($leMedecin != null){
                echo 'name = "Modifier" value = "Modifier"';
            }else{
                echo 'name = "Valider" value = "Valider"';
            }
            ?>
            ></td>
        </tr>
    </table>
    <?php 
        if($leMedecin !=null){
            echo"<input type ='hidden' name='idMedecin' value ='".$leMedecin['idMedecin']."'>";
        }
        ?>
</form>


    </body>
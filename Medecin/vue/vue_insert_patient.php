<link rel="stylesheet" href="page.css"/> 

<body>
<h3> Ajout d'un Patient </h3>

<form method="post">
<table>
        <tr>
            <td> Nom </td>
            <td><input type="text" name="nom"
            value="<?php if ($lePatient!=null) echo $lePatient['nom']?>"></td>
        </tr>
        <tr>
            <td> Prenom </td>
            <td><input type="text" name="prenom"
            value="<?php if ($lePatient!=null) echo $lePatient['prenom']?>"></td>
        </tr>
        <tr>
            <td> Adresse </td>
            <td><input type="text" name="adresse"
            value="<?php if ($lePatient!=null) echo $lePatient['adresse']?>"></td>
        </tr>
        <tr>
            <td> Telephone </td>
            <td><input type="text" name="telephone"
            value="<?php if ($lePatient!=null) echo $lePatient['telephone']?>"></td>
        </tr>
        <tr>
            <td> Email </td>
            <td><input type="text" name="email"
            value="<?php if ($lePatient!=null) echo $lePatient['email']?>"></td>
        </tr>
        <tr>
            <td><input type="reset" name="Annuler"  value="Annuler"></td>
            <td><input type="submit" 
            <?php if($lePatient != null){
                echo 'name = "Modifier" value = "Modifier"';
            }else{
                echo 'name = "Valider" value = "Valider"';
            }
            ?>
            ></td>
        </tr>
    </table>
    <?php 
        if($lePatient !=null){
            echo"<input type ='hidden' name='idPatient' value ='".$lePatient['idPatient']."'>";
        }
        ?>
</form>
</body>
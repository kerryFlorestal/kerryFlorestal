<link rel="stylesheet" href="page.css"/> 

<body>
    <h3> Ajout d'un Rendez-vous </h3>

    <form method="post">
        <table>
            <tr>
                <td> Date RDV </td>
                <td><input type="text" name="dateRDV" value="<?php if ($leRDV!=null) echo $leRDV['dateRDV']?>"></td>
            </tr>
            <tr>
                <td> Description </td>
                <td><input type="text" name="description" value="<?php if ($leRDV!=null) echo $leRDV['description']?>"></td>
            </tr>
            <tr>
                <td> Heure RDV </td>
                <td><input type="text" name="heureRDV" value="<?php if ($leRDV!=null) echo $leRDV['heureRDV']?>"></td>
            </tr>
            <tr>
                <td> Statut </td>
                <td><input type="text" name="statut" value="<?php if ($leRDV!=null) echo $leRDV['statut']?>"></td>
            </tr>
            <tr>
                <td> Patient </td>
                <td>
                    <select name="idpatient">
                        <option selected disabled>Choose</option>
                        <?php
                        if(isset($lesPatients)){
                            foreach($lesPatients as $lePatient){
                                echo '<option value="'.$lePatient['idpatient'].'">'.$lePatient['nom'].'</option>';
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td> Medecin </td>
                <td>
                    <select name="idMedecin">
                        <option selected disabled>Choose</option>
                        <?php
                        if(isset($lesMedecins)){
                            foreach($lesMedecins as $leMedecin){
                                echo '<option value="'.$leMedecin['idMedecin'].'">'.$leMedecin['nom'].'</option>';
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><input type="reset" name="Annuler"  value="Annuler"></td>
                <td><input type="submit"
                    <?php if($leRDV != null){
                        echo 'name="Modifier" value="Modifier"';
                    }else{
                        echo 'name="Valider" value="Valider"';
                    }
                    ?>
                ></td>
            </tr>
        </table>
        <?php 
        if($leRDV !=null){
            echo"<input type='hidden' name='idRDV' value ='".$leRDV['idRDV']."'>";
        }
        ?>
    </form>
</body>

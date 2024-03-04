<?php
    function connexion(){
        $connexion = mysqli_connect("localhost","root","","medical");
        if ($connexion == null){
            echo "Erreur de connexion au serveur Mysql.";
        }
        return $connexion;
    }

    function deconnexion ($connexion){
        mysqli_close($connexion);
    }

    /** Gestion des Patients **/
    function insertPatient ($tab){
        $requete = "INSERT INTO Patient VALUES (null,'"
        .$tab['nom']."', '"
        .$tab['prenom']."', '"
        .$tab['adresse']."', '"
        .$tab['telephone']."', '"
        .$tab['email']."')";

        $con = connexion (); 
        mysqli_query($con, $requete); 
        deconnexion ($con);
    }

    function selectAllPatient(){
        $requete = "select * from patient ;";
        $con = connexion ();
        $lespatients = mysqli_query($con, $requete);
        deconnexion($con);
       // var_dump($lespatients);
        return $lespatients;

    }

    function patientExiste($idpatient) {
        $con = connexion();
        $result = mysqli_query($con, "SELECT idpatient FROM Patient WHERE idpatient = $idpatient");
        $exists = mysqli_num_rows($result) > 0;
        deconnexion($con);
        if ($exists) {
            echo "Le patient existe.";
        } else {
            echo "Le patient n'existe pas.";
        }
    }

    function selectWherePatient($idpatient){
        $requete ="SELECT * FROM Patient WHERE idpatient=".$idpatient;
        $con = connexion ();
        $resultats = mysqli_query($con, $requete);
        $lePatient = mysqli_fetch_assoc($resultats);
        deconnexion ($con);
        return $lePatient;
    }

    function deletePatient($idPatient){
        $con = connexion ();
        $requete = "delete FROM Patient WHERE idpatient=".$idPatient;
        mysqli_query($con, $requete);
        deconnexion ($con);
    }
    

    
    function updatePatient($tab){
        $requete = "UPDATE Patient SET nom='"
        .$tab['nom']."', prenom='"
        .$tab['prenom']."', adresse='"
        .$tab['adresse']."', telephone='"
        .$tab['telephone']."', email='"
        .$tab['email']."' WHERE idpatient="
        .$tab['idPatient'];

        $con = connexion ();
        mysqli_query($con, $requete);
        deconnexion ($con);
    }

    /** Gestion des Medecins **/
    function insertMedecin ($tab){
        $requete = "INSERT INTO Medecin VALUES (null,'"
        .$tab['nom']."', '"
        .$tab['prenom']."', '"
        .$tab['telephone']."', '"
        .$tab['email']."')";

        $con = connexion (); 
        mysqli_query($con, $requete); 
        deconnexion ($con);
    }

    function selectAllMedecin(){
        $requete = "SELECT * FROM Medecin";
        $con = connexion ();
        $lesMedecins = mysqli_query($con, $requete);
        deconnexion($con);
        return $lesMedecins;
    }

    function medecinExiste($idMedecin) {
        $con = connexion();
        $result = mysqli_query($con, "SELECT idMedecin FROM Medecin WHERE idMedecin = $idMedecin");
        $exists = mysqli_num_rows($result) > 0;
        deconnexion($con);
        if ($exists) {
            echo "Le médecin existe.";
        } else {
            echo "Le médecin n'existe pas.";
        }
    }

    function selectWhereMedecin($idMedecin){
        $requete ="SELECT * FROM Medecin WHERE idMedecin=".$idMedecin;
        $con = connexion ();
        $resultats = mysqli_query($con, $requete);
        $leMedecin = mysqli_fetch_assoc($resultats);
        deconnexion ($con);
        return $leMedecin;
    }

    function deleteMedecin($idMedecin){
        $con = connexion ();
        $requete_ordonance = "delete FROM Ordonance WHERE idMedecin=".$idMedecin;
        mysqli_query($con, $requete_ordonance);

        $requete_rdv = "delete FROM RDV WHERE idMedecin=".$idMedecin;
        mysqli_query($con, $requete_rdv);

        $requete_medecin = "delete FROM Medecin WHERE idMedecin=".$idMedecin;
        mysqli_query($con, $requete_medecin);

        deconnexion ($con);
    }

    function updateMedecin($tab){
        $requete = "UPDATE Medecin SET nom='"
        .$tab['nom']."', prenom='"
        .$tab['prenom']."', telephone='"
        .$tab['telephone']."', email='"
        .$tab['email']."'  WHERE idMedecin="
        .$tab['idMedecin'];

        $con = connexion ();
        mysqli_query($con, $requete);
        deconnexion ($con);
    }


    /* Gestion des RDV */
    function insertRDV ($tab){
        $requete = "INSERT INTO RDV VALUES (null,'"
        .$tab['dateRDV']."', '"
        .$tab['description']."', '"
        .$tab['heureRDV']."', '"
        .$tab['statut']."', '"
        .$tab['idpatient']."', '"
        .$tab['idMedecin']."')";

        $con = connexion (); 
        mysqli_query($con, $requete); 
        deconnexion ($con);
    }

    function selectAllRDV(){
        $requete = "SELECT * FROM RDV";
        $con = connexion ();
        $lesRDV = mysqli_query($con, $requete);
        deconnexion($con);
        return $lesRDV;
    }

    function rdvExiste($idRDV) {
        $con = connexion();
        $result = mysqli_query($con, "SELECT idRDV FROM RDV WHERE idRDV = $idRDV");
        $exists = mysqli_num_rows($result) > 0;
        deconnexion($con);
        if ($exists) {
            echo "Le RDV existe.";
        } else {
            echo "Le RDV n'existe pas.";
        }
    }

    function selectWhereRDV($idRDV){
        $requete ="SELECT * FROM RDV WHERE idRDV=".$idRDV;
        $con = connexion ();
        $resultats = mysqli_query($con, $requete);
        $leRDV = mysqli_fetch_assoc($resultats);
        deconnexion ($con);
        return $leRDV;
    }

    function deleteRDV($idRDV){
        $con = connexion ();
        $requete_rdv = "delete FROM RDV WHERE idRDV=".$idRDV;
        mysqli_query($con, $requete_rdv);
        deconnexion ($con);
    }

    function updateRDV($tab){
        $requete = "UPDATE RDV SET dateRDV='"
        .$tab['dateRDV']."', description='"
        .$tab['description']."', heureRDV='"
        .$tab['heureRDV']."', statut='"
        .$tab['statut']."', idpatient='"
        .$tab['idpatient']."', idMedecin='"
        .$tab['idMedecin']."' WHERE idRDV="
        .$tab['idRDV'];

        $con = connexion ();
        mysqli_query($con, $requete);
        deconnexion ($con);
    }

    /** Gestion des Ordonances **/
    function insertOrdonance ($tab){
        $requete = "INSERT INTO Ordonance VALUES (null,'"
        .$tab['dateOrdonance']."', '"
        .$tab['description']."', '"
        .$tab['idMedecin']."')";

        $con = connexion (); 
        mysqli_query($con, $requete); 
        deconnexion ($con);
    }

    function selectAllOrdonance(){
        $requete = "SELECT * FROM Ordonance";
        $con = connexion ();
        $lesOrdonances = mysqli_query($con, $requete);
        deconnexion($con);
        return $lesOrdonances;
    }

    function ordonanceExiste($idordonance) {
        $con = connexion();
        $result = mysqli_query($con, "SELECT idordonance FROM Ordonance WHERE idordonance = $idordonance");
        $exists = mysqli_num_rows($result) > 0;
        deconnexion($con);
        if ($exists) {
            echo "L'ordonnance existe.";
        } else {
            echo "L'ordonnance n'existe pas.";
        }
    }

    function selectWhereOrdonance($idordonance){
        $requete ="SELECT * FROM Ordonance WHERE idordonance=".$idordonance;
        $con = connexion ();
        $resultats = mysqli_query($con, $requete);
        $lordonance = mysqli_fetch_assoc($resultats);
        deconnexion ($con);
        return $lordonance;
    }

    function deleteOrdonance($idordonance){
        $con = connexion ();
        $requete_ordonance = "DELETE FROM Ordonance WHERE idordonance=".$idordonance;
        mysqli_query($con, $requete_ordonance);
        deconnexion ($con);
    }

    function updateOrdonance($tab){
        $requete = "UPDATE Ordonance SET dateordonance='"
        .$tab['dateordonance']."', description='"
        .$tab['description']."', idMedecin='"
        .$tab['idMedecin']."' WHERE idordonance="
        .$tab['idordonance'];

        $con = connexion ();
        mysqli_query($con, $requete);
        deconnexion ($con);
    }

    /** Gestion des Médicaments **/
    function insertMedicament ($tab){
        $requete = "INSERT INTO medicament VALUES (null,'"
        .$tab['nom']."', '"
        .$tab['description']."', '"
        .$tab['utilisation']."', '"
        .$tab['idordonance']."')";

        $con = connexion (); 
        mysqli_query($con, $requete); 
        deconnexion ($con);
    }

    function selectAllMedicament(){
        $requete = "SELECT * FROM medicament";
        $con = connexion ();
        $lesMedicaments = mysqli_query($con, $requete);
        deconnexion($con);
        return $lesMedicaments;
    }

    function medicamentExiste($idMedicament) {
        $con = connexion();
        $result = mysqli_query($con, "SELECT idmedicament FROM medicament WHERE idmedicament = $idMedicament");
        $exists = mysqli_num_rows($result) > 0;
        deconnexion($con);
        if ($exists) {
            echo "Le médicament existe.";
        } else {
            echo "Le médicament n'existe pas.";
        }
    }

    function selectWhereMedicament($idMedicament){
        $requete ="SELECT * FROM medicament WHERE idmedicament=".$idMedicament;
        $con = connexion ();
        $resultats = mysqli_query($con, $requete);
        $leMedicament = mysqli_fetch_assoc($resultats);
        deconnexion ($con);
        return $leMedicament;
    }

    function deleteMedicament($idMedicament){
        $con = connexion ();
        $requete_medicament = "delete FROM medicament WHERE idmedicament=".$idMedicament;
        mysqli_query($con, $requete_medicament);
        deconnexion ($con);
    }

    function updateMedicament($tab){
        $requete = "UPDATE medicament SET nom='"
        .$tab['nom']."', description='"
        .$tab['description']."', utilisation='"
        .$tab['utilisation']."', idordonance='"
        .$tab['idordonance']."' WHERE idmedicament="
        .$tab['idmedicament'];

        $con = connexion ();
        mysqli_query($con, $requete);
        deconnexion ($con);
    }

?>

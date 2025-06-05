<?php
    class event{
        private $bdd;

    function __construct($bdd){
            $this->bdd= $bdd;
    }
    
        public function lesEvenements (){
            $requete = "select * from evenement ;";
            //preparation de la requete
            $select = $this->bdd->prepare ($requete);
            //execution de la requete
            $select->execute ();
            //extraction des données
            $lesEvenements = $select->fetchAll();
            return $lesEvenements;
        }

    

        public function insertEvenement($tab) {
            try {
                $image_name = '';
                if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                    $image_name = $_FILES['image']['name'];
                    move_uploaded_file($_FILES['image']['tmp_name'], 'C:/wamp/www/egw/img/' . $image_name);
                }
        
                $requete = "INSERT INTO evenement (nomEvent, dateEvent, Heure, description, prixBillet, disponible, idCategorieEvent, idLieu, image, imageKey) 
                            VALUES (:nomEvent, :dateEvent, :Heure, :description, :prixBillet, :disponible, :idCategorieEvent, :idLieu, :image, :imageKey)";
                
                $insert = $this->bdd->prepare($requete);
                $insert->execute([
                    ':nomEvent' => $tab['nomEvent'],
                    ':dateEvent' => $tab['dateEvent'],
                    ':Heure' => $tab['Heure'],
                    ':description' => $tab['description'],
                    ':prixBillet' => $tab['prixBillet'],
                    ':disponible' => $tab['disponible'],
                    ':idCategorieEvent' => $tab['idCategorieEvent'],
                    ':idLieu' => $tab['idLieu'],
                    ':image' => $image_name,
                    ':imageKey' => $tab['imageKey']
                ]);
                
                return true;
            } catch (Exception $e) {
                echo "Erreur d'insertion : " . $e->getMessage(); // Ajout pour déboguer
                return false;
            }
        }

        public function deleteEventById($idEvenement){

            $requete = "DELETE FROM Evenement where idEvenement = :idEvenement";

            //preparation de la requete
            $select = $this->bdd->prepare($requete);

            //execution de la requete
            $select->execute([':idEvenement' => $idEvenement]);
        }   
        
       

        public function selectWhereEvenement($idEvenement){
            $requete="select * from evenement where idEvenement=".$idEvenement.";";
            $select = $this->bdd->prepare($requete);
            $select->execute();
            $unEvenement = $select->fetch();
            return $unEvenement;
        }


        public function updateEvenement($tab){
            try {
                // Gérer l'upload d'image si nécessaire
                $image_name = '';
                if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                    $image_name = $_FILES['image']['name'];
                    move_uploaded_file($_FILES['image']['tmp_name'], 'C:/wamp/www/egw/img/' . $image_name);
                } else {
                    // Si pas de nouvelle image, garder l'ancienne
                    $requeteImage = "SELECT image FROM evenement WHERE idEvenement = :id";
                    $selectImage = $this->bdd->prepare($requeteImage);
                    $selectImage->execute([':id' => $tab['idEvenement']]);
                    $result = $selectImage->fetch();
                    $image_name = $result['image'];
                }
                
                $requete = "UPDATE evenement SET 
                            nomEvent = :nomEvent,
                            dateEvent = :dateEvent,
                            Heure = :Heure,
                            description = :description,
                            prixBillet = :prixBillet,
                            disponible = :disponible,
                            idCategorieEvent = :idCategorieEvent,
                            idLieu = :idLieu,
                            image = :image,
                            imageKey = :imageKey
                            WHERE idEvenement = :idEvenement";
                
                $update = $this->bdd->prepare($requete);
                $success = $update->execute([
                    ':nomEvent' => $tab['nomEvent'],
                    ':dateEvent' => $tab['dateEvent'],
                    ':Heure' => $tab['Heure'],
                    ':description' => $tab['description'],
                    ':prixBillet' => $tab['prixBillet'],
                    ':disponible' => $tab['disponible'],
                    ':idCategorieEvent' => $tab['idCategorieEvent'],
                    ':idLieu' => $tab['idLieu'],
                    ':image' => $image_name,
                    ':imageKey' => $tab['imageKey'],
                    ':idEvenement' => $tab['idEvenement']
                ]);
                
                return $success;
            } catch (Exception $e) {
                echo "Erreur de mise à jour : " . $e->getMessage();
                return false;
            }
        }

        

        public function selectLikeEvenement($filtre){
            $requete ="select * from evenement where nomEvent like '%".$filtre."%'
            or dateEvent like '%".$filtre."%' or lieuxEvent like '%".$filtre."%' or imageKey like '%".$filtre."%'; ";
            //preparation de la requete
            $select = $this->bdd->prepare($requete);
            //execution de la requete
            $select->execute();
            //extraction des données
            $lesLieuxEvents = $select->fetchAll();
            return $lesLieuxEvents;
        }

    }
?>    
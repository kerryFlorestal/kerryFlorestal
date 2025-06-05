<?php
    class Lieu{
        private $bdd;

    function __construct($bdd){
            $this->bdd= $bdd;
        }

        public function selectAllLieux(){
            $requete ="select * from lieu; ";
            //preparation de la requete
            $select = $this->bdd->prepare($requete);
            //execution de la requete
            $select->execute();
            //extraction des données
            $lesLieux = $select->fetchAll();
            return $lesLieux;
        }

        public function insertLieu($tab) {
            $requete = "INSERT INTO lieu (idLieu, nom, adresse, capacite, description, lieuKey)
                        VALUES (NULL, :nom, :adresse, :capacite, :description, :lieuKey)";
            $select = $this->bdd->prepare($requete);
            // Exécution avec des paramètres sécurisés
            $select->execute([
                ':nom' => $tab['nom'],
                ':adresse' => $tab['adresse'],
                ':capacite' => $tab['capacite'],
                ':description' => $tab['description'],
                ':lieuKey' => $tab['lieuKey'],
            ]);
        }

        public function deleteEventByLieu($idLieu){
            // Supprimer le lieu
            $requete = "DELETE FROM lieu WHERE idLieu = :idLieu";
            //preparation de la requete
            $select = $this->bdd->prepare($requete);

            //execution de la requete
            $select->execute([':idLieu' => $idLieu]);
        }

        public function selectWhereLieu($idLieu){
            $requete = "SELECT * FROM lieu WHERE idLieu = :idLieu";
            $select = $this->bdd->prepare($requete);
            $select->execute([':idLieu' => $idLieu]);
            $unLieu = $select->fetch();
            return $unLieu;
        }

        public function updateLieu($tab){
            $requete = "UPDATE lieu SET 
                        nom = :nom, 
                        adresse = :adresse, 
                        capacite = :capacite, 
                        description = :description, 
                        lieuKey = :lieuKey 
                        WHERE idLieu = :idLieu";
                        
            $select = $this->bdd->prepare($requete);
            $select->execute([
                ':nom' => $tab['nom'],
                ':adresse' => $tab['adresse'],
                ':capacite' => $tab['capacite'],
                ':description' => $tab['description'],
                ':lieuKey' => $tab['lieuKey'],
                ':idLieu' => $tab['idLieu']
            ]);
        }

        public function selectLikeLieu($filtre){
            $requete = "SELECT * FROM lieu WHERE 
                        nom LIKE :filtre OR 
                        adresse LIKE :filtre OR
                        capacite LIKE :filtre OR 
                        description LIKE :filtre";
                        
            //preparation de la requete
            $select = $this->bdd->prepare($requete);
            //execution de la requete
            $select->execute([':filtre' => '%'.$filtre.'%']);
            //extraction des données
            $lesLieux = $select->fetchAll();
            return $lesLieux;
        }
    }
?>
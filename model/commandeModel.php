<?php
    class commande{
        private $bdd;

    function __construct($bdd){
            $this->bdd= $bdd;
    }

        public function selectAllCommandes(){
            $requete ="select * from commande; ";
            //preparation de la requete
            $select = $this->bdd->prepare($requete);
            //execution de la requete
            $select->execute();
            //extraction des données
            $lesCommandes = $select->fetchAll();
            return $lesCommandes;
        }

        

        public function selectAllCommandesById($idClient) {
            $req = $this->bdd->prepare("
                SELECT 
                    commande.idCommande, 
                    commande.prixBillet, 
                    client.nom AS nom, 
                    evenement.nomEvent AS nomEvent
                FROM commande
                INNER JOIN client ON commande.idClient = client.idClient
                INNER JOIN evenement ON commande.idEvenement = evenement.idEvenement
                WHERE commande.idClient = :idClient;
            ");
        
            $req->bindParam(':idClient', $idClient, PDO::PARAM_INT);
            $req->execute();
            
            return $req->fetchAll(PDO::FETCH_ASSOC);
        }
        
        
        

        public function insertCommande($tab) {
            $requete = "INSERT INTO commande (prixBillet, idClient, idEvenement) 
                        VALUES (:prixBillet, :idClient, :idEvenement)";
            $select = $this->bdd->prepare($requete);
            $select->execute([
                ':prixBillet' => $tab['prixBillet'],
                ':idClient' => $tab['idClient'],
                ':idEvenement' => $tab['idEvenement']
            ]);
        }

        public function deleteCommande($idCommande){
            $requete = "delete from commande where idCommande =".$idCommande.";";
            $select = $this->bdd->prepare($requete);
            //execution de la requete
            $select->execute();
        }

        public function selectWhereCommande($idCommande){
            $requete="select * from commande where idCommande=".$idCommande.";";
            $select = $this->bdd->prepare($requete);
            $select->execute();
            $uneCommande = $select->fetch();
            return $uneCommande;
        }

        public function updateCommande($tab){
            $requete ="update commande set prixBillet='"
                    .$tab['prixBillet']."'idClient='"
                    .$tab['idClient']."',,idEvenement='"
                    .$tab['idEvenement']."' "
                    . " where idCommande=".$tab['idCommande'].";";
            $select = $this->bdd->prepare($requete);
            $select->execute();
        }

        public function selectLikeCommande($filtre){
            $requete ="select * from commande where dateCommande like '%".$filtre."%'
            or totalCommande like '%".$filtre."%'; ";
            //preparation de la requete
            $select = $this->bdd->prepare($requete);
            //execution de la requete
            $select->execute();
            //extraction des données
            $lesCommandes = $select->fetchAll();
            return $lesCommandes;
        }
    }
?>
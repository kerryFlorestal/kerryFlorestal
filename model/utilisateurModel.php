<?php
    class Utilisateur{
        private $bdd;

    function __construct($bdd){

        $this->bdd = $bdd;

        }

        public function selectAllClients(){
            $requete ="select * from client; ";
            //preparation de la requete
            $select = $this->bdd->prepare($requete);
            //execution de la requete
            $select->execute();
            //extraction des données
            $lesClients = $select->fetchAll();
            return $lesClients;
        }

        public function insertClient($tab){
        
            $resultat = $this->getgrainsel();
            $mdp = sha1($tab['mdp'].$resultat['nb']);

            $requete = "insert into client values (null, '"
                    .$tab['nom']."','"
                    .$tab['prenom']."','"
                    .$tab['numeroTel']."','"
                    .$tab['email']."','"
                    .$mdp."','client');";

                // var_dump($requete);
                    //die();        
            $select = $this->bdd->prepare($requete);
            //execution de la requete
            $select->execute();
        }

        public function deleteClient($idClient){
            $requete = "delete from Client where idClient =".$idClient.";";
            $select = $this->bdd->prepare($requete);
            //execution de la requete
            $select->execute();
        }

        public function selectWhereClientByEmail($email){
            $requete = "select * from client where email = :email";
            $select = $this->bdd->prepare($requete);
            $select->bindValue(':email', $email);
            $select->execute();
            $leClient = $select->fetch();
            return $leClient;
        }

        public function selectClientById($idClient){
            $requete = "select * from client where idClient = :idClient";
            $select = $this->bdd->prepare($requete);
            $select->bindValue(':idClient', $idClient);
            $select->execute();
            $leClient = $select->fetch();
            return $leClient;
        }

        public function updateClient($tab){
            $requete ="update client set nom='"
                    .$tab['nom']."',prenom='"
                    .$tab['prenom']."',numeroTel='"
                    .$tab['numeroTel']."',email='"
                    .$tab['email']."'"
                    . " where idClient=".$tab['idClient'].";";
            $select = $this->bdd->prepare($requete);
            $select->execute();
        }

        public function selectLikeClient($filtre){
            $requete ="select * from client where nom like '%".$filtre."%'
            or prenom like '%".$filtre."%' or numeroTel like '%".$filtre."%' or email like'%".$filtre."%'; ";
            //preparation de la requete
            $select = $this->bdd->prepare($requete);
            //execution de la requete
            $select->execute();
            //extraction des données
            $lesClients = $select->fetchAll();
            return $lesClients;
        }

        ///////////CONNEXION////////////

        public function verifConnexion($email,$mdp){
            //$requete="select * from client where email = '".$email."' and mot_de_passe='".$mot_de_passe."' ;";
            $requete ="select * from client where email= :email and mdp = :mdp ;";
            $donnees = array (":email"=>$email, ":mdp"=>$mdp);
            //preparation de la requete
            $select = $this->bdd->prepare ($requete);
            //execution de la requete
            $select->execute ($donnees);
            //extraction des données
            $unClient = $select->fetch();
            return $unClient;

        }

        public function getgrainsel() {
            $requete = "SELECT nb FROM grainsel LIMIT 1";
            $stmt = $this->bdd->prepare($requete);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }
?>
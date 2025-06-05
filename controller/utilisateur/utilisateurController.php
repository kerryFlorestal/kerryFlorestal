<?php
if (!isset($_SESSION)) {
    session_start();
}
include(__DIR__ . '/../../bdd/bdd.php');
include(__DIR__ . '/../../model/utilisateurModel.php');



    if (isset($_POST['action'])) {
        $lesClients = null;
        $action = $_POST['action'];
        $utilisateurController = new UtilisateurController($bdd);

              
        switch ($_POST['action']) {
            case "connexion":
                $utilisateurController->verifConnexion($_POST['email'], $_POST['mdp']); 
                break;
            case "inscription":
                $tab = ['nom' => $_POST['nom'], 'prenom' => $_POST['prenom'], 'numeroTel' => $_POST['numeroTel'], 'email' => $_POST['email'], 'mdp' => $_POST['mdp']];
                $utilisateurController->insertClient($tab); 
                break;
            case "sup":  
                $utilisateurController->deleteClient($_POST['idClient']); 
                break;
            case "edit":
                $tab = ['idClient' => $_POST['idClient'], 'nom' => $_POST['nom'], 'prenom' => $_POST['prenom'], 'numeroTel' => $_POST['numeroTel'], 'email' => $_POST['email']];
                $utilisateurController->updateClient($tab);
                break;
            case "filtre":
                $utilisateurController->selectLikeClient($_POST['filtre']);
                break;
        }
    }
    
    class UtilisateurController{
        //intanciation de la classe modele
        private $unUtilisateurModel;

        public function __construct($bdd){
            $this->unUtilisateurModel = new Utilisateur($bdd);
        }

        
        /* section 1 : select All sur les tables */
        public function insertClient($tab){
            //controle les données avant insertion
            $this->unUtilisateurModel->insertClient($tab);

            header('Location: /');

        }

        public function deleteClient($idClient){
            //on controle la presence de l'enregistrement
            $this->unUtilisateurModel->deleteClient($idClient);
        }

        public function updateClient($tab){
            $this->unUtilisateurModel->updateClient($tab);
        }

        public function selectAllClients(){
            //on controle la presence de l'enregistrement
            return $this->unUtilisateurModel->selectAllClients();
        }

        public function selectClientById($idClient){
            //on controle la presence de l'enregistrement
            return $this->unUtilisateurModel->selectClientById($idClient);
        }

        public function selectWhereClientByEmail($email){
            //on controle la presence de l'enregistrement
            return $this->unUtilisateurModel->selectWhereClientByEmail($email);
        }

        public function selectLikeClient($filtre){
            //on controle la presence de l'enregistrement
            $this->unUtilisateurModel->selectLikeClient($filtre);
            header('Location: http://localhost/egw/index.php?page=user');
        }

        public function verifConnexion($email,$mdp){

            
            //hachage du mot de passe avec la fonction md5
            //$mdp = md5($mdp);

            //hachage du mot de passe avec la fonction sha1
            //$mdp = sha1($mdp);

            //hachage du sha1 avec salage
            $resultat = $this->unUtilisateurModel->getgrainsel ();
            if ($resultat && isset($resultat['nb'])) {
                $mdp = sha1($mdp . $resultat['nb']);
            } else {
                echo "Erreur : impossible de récupérer le grain de sel.";
                return; // ou `exit;`
            }

            $unClient = $this->unUtilisateurModel->verifConnexion($email, $mdp);


            
            //stocker en session $un client


            if ($unClient!=null) {
                // création d'une session
                $_SESSION['idClient'] = $unClient['idClient'];
                $_SESSION['email'] = $unClient['email'];
                $_SESSION['nom'] = $unClient['nom']; 
                $_SESSION['prenom'] = $unClient['prenom']; 
                $_SESSION['numeroTel'] = $unClient['numeroTel'];
                $_SESSION['mdp'] = $unClient['mdp'];
                $_SESSION['role'] = $unClient['role'];

                
                header('Location: /');
            } else {
        
                echo "<br> Veuillez vérifier vos identifiants.";
            }


        }
    }
?>
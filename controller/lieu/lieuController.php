<?php
session_start();
include(__DIR__ .'../../bdd/bdd.php');  // Inclut la connexion à la BDD
include(__DIR__ .'../../model/lieuModel.php');


    if (isset($_POST['action'])) {
        $lesLieux = null;
        $action = $_POST['action'];
        $lieuController = new LieuController($bdd);

              
        switch ($_POST['action']) {
            case "valider":
                $tab = ['nom' => $_POST['nom'], 'adresse' => $_POST['adresse'], 'capacite' => $_POST['capacite'], 'description' => $_POST['description'], 'lieuKey' => $_POST['lieuKey']];  
                $lieuController->insertLieu($tab); 
                break;
            case "supprimer":  
                $idLieu = $_POST['idLieu'];
                $lieuController->deleteEventByLieu($idLieu); 
                break;
            case "edit":
                // Récupérer l'ID du lieu depuis la requête
                $idLieu = $_POST['idLieu'];
                
                // Rediriger vers la page principale avec l'ID du lieu pour édition
                header('Location: http://localhost/egw//index.php?page=lieu&idLieu='.$idLieu);
                exit;
                break;
        }
    }
    
    class LieuController{
        //intanciation de la classe modele
        private $unLieuModel;

        public function __construct($bdd){
            $this->unLieuModel = new Lieu($bdd);
        }

        
        /* section 1 : select All sur les tables */
        public function insertLieu($tab){
            //controle les données avant insertion
            $this->unLieuModel->insertLieu($tab);

            header('Location: http://localhost/egw//index.php?page=lieu');

        }

        public function deleteEventByLieu($idLieu){
            //on controle la presence de l'enregistrement
            $this->unLieuModel->deleteEventByLieu($idLieu);
            
            // Rediriger après la suppression
            header('Location: http://localhost/egw//index.php?page=lieu');
        }

        public function updateLieu($tab){
            $this->unLieuModel->updateLieu($tab);
            
            // Rediriger après la mise à jour
            header('Location: http://localhost/egw//index.php?page=lieu');
        }

        public function selectAllLieux(){
            //on controle la presence de l'enregistrement
            return $this->unLieuModel->selectAllLieux();
        }

        
    }
?>
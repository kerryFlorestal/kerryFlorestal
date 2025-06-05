<?php
session_start();
include(__DIR__ .'/../../bdd/bdd.php');  // Inclut la connexion à la BDD
include(__DIR__ .'/../../model/commandeModel.php');


if (isset($_POST['action'])){
    $lesCommandes = null;
    $action = $_POST['action'];
    $commandeController = new CommandeController($bdd);


    switch ($_POST['action'] ){
        case "confirmer":
            $tab = [
                'prixBillet' => $_POST['prixBillet'],
                'idClient' => $_POST['idClient'],
                'idEvenement' => $_POST['idEvenement']
            ];
            $commandeController->insertCommande($tab);
            break;
        case "sup":  
            $commandeController->deleteCommande($idCategorieEvent); 
            break;  

        }
    }
    
    class CommandeController{
        //intanciation de la classe modele
        private $uneCommandeModel;

        public function __construct($bdd){
            $this->uneCommandeModel = new commande($bdd);
        }

        
        /* section 1 : select All sur les tables */
        public function insertCommande($tab){
            //controle les données avant insertion
            $this->uneCommandeModel->insertCommande($tab);

            header('Location: ../../index.php?page=ticket&idClient=' . $_SESSION['idClient'] .'');

        }

        public function deleteCommande($idCommande){
            //on controle la presence de l'enregistrement
            $this->uneCommandeModel->deleteCommande($idCommande);
        }

        public function updateCommande($tab){
            $this->uneCommandeModel->updateCommande($tab);
        }

        public function selectAllCommandes(){
            //on controle la presence de l'enregistrement
            $this->uneCommandeModel->selectAllCommandes();
        }

        public function selectAllCommandesById($idClient){
            //on controle la presence de l'enregistrement
            $this->uneCommandeModel->selectAllCommandesById($idClient);
        }
    }

?>
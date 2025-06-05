<?php

include(__DIR__ .'/../../bdd/bdd.php');  // Inclut la connexion à la BDD
include(__DIR__ .'/../../model/categorieEventModel.php');


    if (isset($_POST['action'])) {
        $lesCategories = null;
        $action = $_POST['action'];
        $categorieController = new CategorieController($bdd);

              
        switch ($_POST['action']) {
            case "valider":
                $tab = ['nomCategorie' => $_POST['nomCategorie'], 'description' => $_POST['description']];  
                $categorieController->insertCategorieEvent($tab); 
                break;
            case "sup":  
                $categorieController->deleteCategorieEvent($idCategorieEvent); 
                break;  
            case "edit":
                $uneCategorieEvent->selectWhereCategorieEvent($idCategorieEvent);
                break;
        }
    }
    
    class CategorieController{
        //intanciation de la classe modele
        private $uneCategorieModel;

        public function __construct($bdd){
            $this->uneCategorieModel = new Categorie($bdd);
        }

        
        /* section 1 : select All sur les tables */
        public function insertCategorieEvent($tab){
            //controle les données avant insertion
            $this->uneCategorieModel->insertCategorieEvent($tab);

            header('Location: http://localhost/egw/index.php?page=categorie');

        }

        public function deleteCategorieEvent($idCategorieEvent){
            //on controle la presence de l'enregistrement
            $this->uneCategorieModel->deleteCategorieEvent($idCategorieEvent);
        }

        public function updateCategorieEvent($tab){
            $this->uneCategorieModel->updateCategorieEvent($tab);
        }

        public function selectAllCategorieEvents(){
            //on controle la presence de l'enregistrement
            $this->uneCategorieModel->selectAllCategorieEvents();
        }

        
    }
?>

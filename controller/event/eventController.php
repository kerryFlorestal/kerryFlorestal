<?php
session_start();
include(__DIR__ . '/../../bdd/bdd.php');
include(__DIR__ .'/../../model/eventModel.php');


    if (isset($_POST['action'])) {
        $lesEvenements = null;
        $action = $_POST['action'];
        $eventController = new EventController($bdd);

              
        switch ($_POST['action']) {
            case "valider":
                $nomImage = isset($_FILES['image']['name']) ? $_FILES['image']['name'] : null;
                $imageKey = isset($_POST['imageKey']) ? $_POST['imageKey'] : null;
            
                $tab = [
                    'nomEvent' => $_POST['nomEvent'], 
                    'dateEvent' => $_POST['dateEvent'],
                    'Heure' => $_POST['Heure'], 
                    'description' => $_POST['description'], 
                    'prixBillet' => $_POST['prixBillet'], 
                    'disponible' => $_POST['disponible'],
                    'idCategorieEvent' => $_POST['idCategorieEvent'], // Doit être reçu maintenant
                    'idLieu' => $_POST['idLieu'], // Doit être reçu maintenant
                    'image' => $nomImage,
                    'imageKey' => $imageKey
                ];
            

                if ($nomImage === null || $nomImage === '') {
                    echo "⚠️ Aucune image envoyée !";
}



               
                $eventController->insertEvenement($tab); 
                break;
            case "supprimer":  
                $idEvenement = $_POST['idEvenement'];
                $eventController->deleteEventById($idEvenement); // Corrigé pour utiliser idEvenement
                
                break;
                
            case "modifier":
                $tab = [
                    'idEvenement' => $_POST['idEvenement'],
                    'nomEvent' => $_POST['nomEvent'], 
                    'dateEvent' => $_POST['dateEvent'],
                    'Heure' => $_POST['Heure'], 
                    'description' => $_POST['description'], 
                    'prixBillet' => $_POST['prixBillet'], 
                    'disponible' => $_POST['disponible'],
                    'idCategorieEvent' => $_POST['idCategorieEvent'],
                    'idLieu' => $_POST['idLieu'], 
                    'imageKey' => $_POST['imageKey']
                    // Ne pas définir l'image ici, la méthode updateEvenement s'en occupera
                ];
                
                $eventController->updateEvenement($tab);
                break;
                
        }
    }
    
    class EventController{
        //intanciation de la classe modele
        private $unEventModel;

        public function __construct($bdd){
            $this->unEventModel = new Event($bdd);
        }

        
        /* section 1 : select All sur les tables */
        public function insertEvenement($tab){
            // Supprimer le var_dump
            
            if($this->unEventModel->insertEvenement($tab)) {
                 header('Location: /index.php?page=tournois');
                exit(); // Ajoutez exit() après la redirection
            } else {
                // Gérer l'erreur
                echo 'Non';
                exit();
            }
        }


        

        public function deleteEventById($idEvenement){
            // On contrôle la présence de l'enregistrement et on le supprime
            $this->unEventModel->deleteEventById($idEvenement);
            
            
            // Redirection vers la page des événements après suppression
            header('Location: http://localhost/egw/index.php?page=tournois');
            exit();
        }

        public function updateEvenement($tab){
            // Gestion de l'upload d'image si une nouvelle image est fournie
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $image_name = $_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'], 'C:/wamp/www/egw/img/' . $image_name);
                $tab['image'] = $image_name;
            } else if (empty($tab['image'])) {
                // Si aucune nouvelle image n'est fournie, conserver l'ancienne
                $evenement = $this->unEventModel->selectWhereEvenement($tab['idEvenement']);
                $tab['image'] = $evenement['image'];
            }
            
            if($this->unEventModel->updateEvenement($tab)) {
                header('Location: /index.php?page=tournois');
                exit();
                
            } else {
                header('Location: /index.php?page=tournois&error=2');
                exit();
            }
        }

        public function lesEvenements(){
            //on controle la presence de l'enregistrement
            $this->unEventModel->lesEvenements();
        }

        
    }
?>
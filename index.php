<?php
ob_start();
session_start();

// Include database connection and controller
require_once("controller/utilisateur/utilisateurController.php");

$page = isset($_GET['page']) ? $_GET['page'] : 'accueil';

// 🔹 Placer ici la gestion de la déconnexion avant toute sortie HTML
if ($page === 'deconnexion') {
    session_destroy();
    header('Location: /');
    exit();
}

// Instantiate UtilisateurController
$utilisateurController = new UtilisateurController($bdd);

include('view/commun/header.php');

switch ($page) {
    case 'tournois':
        include('view/client/c_evenement.php');
        break;
    case 'reservation':
        include('view/client/c_commande.php');
        break;
    case 'lieu':
        include('view/client/c_lieu.php');
        break;
    case 'categorie':
        include('view/client/c_categorie.php');
        break;
    case 'ticket':
        include('view/client/c_ticket.php');
        break;
    case 'profil':
        // Fetch client data for the logged-in user
        if (isset($_SESSION['idClient'])) {
            $selectClientById = $utilisateurController->selectClientById($_SESSION['idClient']);
            include('view/commun/profil.php');
        } else {
            echo "<p>Erreur : Vous devez être connecté pour voir votre profil.</p>";
            include('view/commun/connexion.php'); // Redirect to login page
        }
        break;
    case 'animation':
        include('view/client/c_animation.php');
        break;
    case 'user':
        include('view/admin/a_user.php');
        break;
    case 'connexion':
        include('view/commun/connexion.php');
        
        break;
    default:
        include('view/commun/accueil.php');
        break;
}

if (isset($_SESSION['idClient'])) {
    include('view/commun/footer.php');
}

ob_end_flush();
?>
<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['idClient'])) {
    // Rediriger vers la page de connexion si non connecté
    header('Location: connexion.php');
    exit();
}

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "event";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer l'ID de l'événement depuis l'URL
$idEvenement = isset($_GET['idEvenement']) ? intval($_GET['idEvenement']) : 0;

if ($idEvenement > 0) {
    // Récupérer les détails de l'événement
    $stmt = $conn->prepare("SELECT * FROM Evenement WHERE idEvenement = ?");
    $stmt->bind_param("i", $idEvenement);
    $stmt->execute();
    $result = $stmt->get_result();
    $event = $result->fetch_assoc();
    $stmt->close();

    if ($event) {
        // Préparer l'insertion de la commande
        $stmt = $conn->prepare("INSERT INTO Commande (idClient, idEvenement, nomEvent, dateCommande, totalCommande, prixBillet) VALUES (?, ?, ?, NOW(), ?, 'En attente')");
        $totalCommande = $event['prixBillet']; // Utiliser le prix du billet comme total de la commande
        $stmt->bind_param("iisi", $_SESSION['idClient'], $idEvenement, $event['nomEvent'], $totalCommande);

        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            // Rediriger vers la page de commande avec un message de succès
            $_SESSION['reservation_success'] = "Réservation effectuée avec succès !";
            header('Location: vue_commande.php');
            exit();
        } else {
            $stmt->close();
            $conn->close();
            // Gérer les erreurs
            $_SESSION['reservation_error'] = "Erreur lors de la réservation.";
            header('Location: vue_evenement.php');
            exit();
        }
    } else {
        $conn->close();
        header('Location: vue_evenement.php');
        exit();
    }
} else {
    $conn->close();
    // Rediriger si pas d'ID d'événement valide
    header('Location: vue_evenement.php');
    exit();
}
?>
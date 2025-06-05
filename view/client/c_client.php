<?php
include ("../../bdd/bdd.php");
?>

<?php
    session_start();
	require_once ("vue/vue_insert_client.php");
    $message = ''; // Initialiser le message d'erreur

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Connexion à la base de données
    $email = $_POST['Email'];

    // Vérifier si l'email existe déjà
    $stmt = $bdd->prepare("SELECT COUNT(*) FROM Client WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        $message = "L'email existe déjà.";
    } else {
        // Insérer ou traiter le formulaire si l'email n'existe pas
        $stmt = $bdd->prepare("INSERT INTO Client (Email) VALUES (:email)");
        $stmt->bindParam(':email', $email);
        if ($stmt->execute()) {
            $message = "Inscription réussie.";
        } else {
            $message = "Une erreur s'est produite.";
        }
    }
}
?>

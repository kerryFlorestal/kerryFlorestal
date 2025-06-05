<!DOCTYPE html>
<html lang="fr">
<head>
    <title>EGW</title>  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
</head>
<body>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;700;900&family=Roboto:wght@300;400;700&display=swap');

    /* Original Body and Layout Styles (Unchanged) */
    html, body {
        height: 100%;
     
        display: flex;
        flex-direction: column;
    }

    body {
        background-color: #0d0d0d;
        font-family: 'Orbitron', sans-serif;
    }

    /* New Header Styles (Neon Theme) */
    header {
        display: flex;
        align-items: center;
        padding: 20px;
        background: transparent;
        position: sticky;
        top: 0;
        z-index: 1000;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        border-bottom: 2px solid transparent;
    }

    header::before {
        content: '';
        position: absolute;
        top: -2px;
        left: -2px;
        right: -2px;
        bottom: -2px;
        background: transparent;
        z-index: -1;
        border-radius: 8px;
        animation: borderAnimation 3s linear infinite;
    }

    @keyframes borderAnimation {
        0% { background-position: 0% 0%; }
        100% { background-position: 300% 0%; }
    }

    header img {
        height: 50px;
        border-radius: 4px;
        border: 2px solid transparent;
        box-shadow: 0 0 10px rgba(0, 255, 255, 0.7);
        transition: all 0.3s ease;
    }

    header img:hover {
        transform: scale(1.05);
        box-shadow: 0 0 15px rgba(0, 255, 255, 0.9);
    }

    nav {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-left: auto;
        padding: 10px;
    }

    nav a {
        text-decoration: none;
    }

    nav button {
        background: transparent;
        color: white;
        border: 1px solid white;
        padding: 8px 16px;
        border-radius: 25px;
        font-family: 'Orbitron', sans-serif;
        font-weight: 700;
        cursor: pointer;
        text-transform: uppercase;
        font-size: 0.9rem;
        letter-spacing: 1px;
        transition: all 0.3s ease;
    }

    nav button.auth-button {
        background: linear-gradient(90deg, #ff0000, #ff6666);
    }

    nav button:hover {
        transform: scale(1.05);
    }

    nav .custom-icon {
        font-size: 24px;
        color: #fff;
        text-shadow: 0 0 5px rgba(0, 255, 255, 0.7);
        transition: all 0.3s ease;
    }

    nav .custom-icon:hover {
        transform: scale(1.1);
        text-shadow: 0 0 10px rgba(0, 255, 255, 0.9);
    }

    /* Original Footer Styles (Unchanged) */
    .footer-container {
        display: flex;
        font-family: 'Orbitron', sans-serif;
        flex-wrap: wrap;
        padding: 20px;
        background: linear-gradient(45deg,black, black, #48195f, black, black);
        color: white;
    }
    
    .footer-section {
        flex: 1;
        min-width: 200px;
        margin: 10px;
    }

    .footer-section h2 {
        font-size: 18px;
        margin-bottom: 15px;
        color: #a073b3;
    }

    .footer-section h4 {
        color: white;
    }

    .footer-section p, .footer-section ul, .footer-section a {
        font-size: 14px;
        color: #ffffff;
        text-decoration: none;
    }

    .footer-section ul {
        list-style: none;
        padding: 0;
    }

    .footer-section ul li {
        margin-bottom: 10px;
    }

    .footer-section a:hover {
        text-decoration: underline;
    }

    .footer-section .social-icons {
        display: flex;
    }

    .footer-section .social-icons a {
        margin-right: 15px;
        font-size: 18px;
        color: #ffffff;
    }

    .footer-section.newsletter form {
        display: flex;
        flex-direction: column;
    }

    .footer-section.newsletter input[type="email"] {
        padding: 10px;
        margin-bottom: 10px;
        border: none;
        border-radius: 5px;
    }

    .footer-section.newsletter button {
        padding: 10px;
        background: linear-gradient(45deg, #9000ff, #48195f);
        border: none;
        border-radius: 5px;
        color: #ffffff;
        cursor: pointer;
    }

    .footer-section.newsletter button:hover {
        background-color: #d4ac0d;
    }

    .footer-bottom {
        text-align: center;
        padding: 10px;
        background-color: black;
    }

    .footer-bottom p {
        margin: 0;
        font-size: 14px;
        color: white;
    }

    /* Responsive Header Styles */
    @media screen and (max-width: 768px) {
        header {
            flex-direction: column;
            align-items: flex-start;
            padding: 15px;
        }

        header img {
            margin-bottom: 10px;
        }

        nav {
            margin-left: 0;
            flex-wrap: wrap;
            justify-content: center;
            gap: 8px;
        }

        nav button {
            padding: 6px 12px;
            font-size: 0.8rem;
        }

        nav .custom-icon {
            font-size: 20px;
        }
    }

    @media screen and (max-width: 480px) {
        header {
            padding: 10px;
        }

        header img {
            height: 40px;
        }

        nav button {
            padding: 5px 10px;
            font-size: 0.75rem;
        }
    }
</style>

<?php ob_start(); ?>
<header>
    <img src="img/logo.png" alt="Logo EGW"/>
    <nav>
        <a href="index.php?page=accueil"><button class="tournament-button">Accueil</button></a>
        <a href="index.php?page=tournois"><button class="tournament-button">Tournois</button></a>
        <?php
        if (isset($_SESSION['email'])) {
            echo '
            <a href="index.php?page=lieu"><button class="tournament-button">Lieu</button></a>
            <a href="index.php?page=ticket&idClient=' . $_SESSION['idClient'] . '"><button class="tournament-button">Tickets</button></a>
            <a href="index.php?page=profil"><button class="tournament-button">Profil</button></a>';
            
            if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
                echo '
                <a href="index.php?page=user"><button class="tournament-button">Utilisateurs</button></a>
                <a href="index.php?page=categorie"><button class="tournament-button">Catégorie</button></a>
                <a href="index.php?page=reservation"><button class="tournament-button">Réservations</button></a>';
            }
            
            echo '<a href="index.php?page=deconnexion"><button class="auth-button">Déconnexion</button></a>';
        } else {
            echo '<a href="index.php?page=connexion"><i class="fa-solid fa-user custom-icon"></i></a>';
        }
        ?>
    </nav>
</header>
<?php ob_end_flush(); ?>

<main>
<!-- Main content placeholder (unchanged) -->
</main>

</body>
</html>
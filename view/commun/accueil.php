<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <title>Prochain tournoi</title>
</head>
<body>
<?php
require_once ("bdd/bdd.php");
?>

<?php

// Connexion à la base de données

// Fonction pour récupérer les événements par clé d'image (déjà définie dans c_evenement.php)
function getEventsByimageKey($bdd, $imageKey) {
    $stmt = $bdd->prepare("SELECT * FROM evenement WHERE imageKey = :imageKey ORDER BY idEvenement DESC LIMIT 1");
    $stmt->execute(['imageKey' => $imageKey]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Récupérer les événements pour chaque catégorie
$events1 = getEventsByimageKey($bdd, '1'); // The Finals
$events2 = getEventsByimageKey($bdd, '2'); // Age of Empires
$events3 = getEventsByimageKey($bdd, '3'); // Warzone
$events4 = getEventsByimageKey($bdd, '4');
$events5 = getEventsByimageKey($bdd, '5');
$events6 = getEventsByimageKey($bdd, '6');
$events7 = getEventsByimageKey($bdd, '7');
$events8 = getEventsByimageKey($bdd, '8');
?>

    <style>
        body {
            background-color: black;
        }

        h1{
            color: white;
            font-family: 'Orbitron', sans-serif;
        }

        p{
            color: white;
            font-family: 'Orbitron', sans-serif;
        }

        .container {
            position: relative;
    width: 800px;
    height: 480px;
    margin: 20px auto;
    transition: all 0.8s ease;
    background: #313131;
    border: 4px solid transparent;
    border-image: linear-gradient(45deg, #ff00ff, #00ffff, #00ff00) 1;
    overflow: hidden;
    animation: neonRotate 3s linear infinite;
        }

        @keyframes neonRotate {
    0% {
        border-image: linear-gradient(45deg, #ff00ff, #00ffff, #00ff00) 1;
    }
    33% {
        border-image: linear-gradient(45deg, #00ffff, #00ff00, #ff00ff) 1;
    }
    66% {
        border-image: linear-gradient(45deg, #00ff00, #ff00ff, #00ffff) 1;
    }
    100% {
        border-image: linear-gradient(45deg, #ff00ff, #00ffff, #00ff00) 1;
    }
}

        .container .slide .item {
            width: 165px;
            height: 250px;
            position: absolute;
            top: 50%;
            transform: translate(0, -50%);
            border-radius: 20px;
            box-shadow: 0 30px 50px #170b41;
            background-position: 50% 50%;
            background-size: cover;
            display: inline-block;
            transition: 0.5s;
        }

        .slide .item:nth-child(1),
        .slide .item:nth-child(2) {
            top: 0;
            left: 0;
            transform: translate(0, 0);
            border-radius: 0;
            width: 100%;
            height: 100%;
        }

        .slide .item:nth-child(3) {
            left: 50%;
        }

        .slide .item:nth-child(4) {
            left: calc(50% + 210px);
        }

        .slide .item:nth-child(5) {
            left: calc(50% + 430px);
        }

        .slide .item:nth-child(n + 6) {
            left: calc(50% + 650px);
            opacity: 0;
        }

        .item .content {
            position: absolute;
            top: 50%;
            left: 100px;
            width: 300px;
            text-align: left;
            color: white;
            transform: translate(0, -50%);
            font-family: 'Orbitron', sans-serif;;
            display: none;
            background: transparent;
        }

        .slide .item:nth-child(2) .content {
            display: block;
        }

        .content .name {
            font-size: 40px;
            text-transform: uppercase;
            font-weight: bold;
            opacity: 0;
            animation: animate 1s ease-in-out 1 forwards;
            -webkit-text-stroke: 1px black; /* Contour blanc pour compatibilité Webkit */
            text-stroke: 1px black; /* Contour blanc standard */
        }

        .content .des {
            font-size: 30px;
            margin-top: 10px;
            margin-bottom: 20px;
            opacity: 0;
            animation: animate 1s ease-in-out 0.3s 1 forwards;
            -webkit-text-stroke: 1px black; /* Contour blanc pour compatibilité Webkit */
            text-stroke: 1px black; /* Contour blanc standard */
        }

        .content button {
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            opacity: 0;
            animation: animate 1s ease-in-out 0.6s 1 forwards;
            color: #000;
        }

        @keyframes animate {
            from {
                opacity: 0;
                transform: translate(0, 100px);
                filter: blur(33px);
            }
            to {
                opacity: 1;
                transform: translate(0);
                filter: blur(0);
            }
        }

        .button {
            width: 100%;
            text-align: center;
            position: absolute;
            bottom: 20px;   
        }

        .button button {
            color: #000;
            width: 40px;
            height: 35px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            margin: 0 5px;
            border: 1px solid #000;
            transition: 0.3s;
        }

        .button button:hover {
            background: #ababab;
            color: black;
        }

        .content a {
            display: inline-block;
            padding: 8px 15px;
            font-size: 14px;
            font-weight: bold;
            color: #000;
            text-decoration: none;
            background-color: #fff;
            border-radius: 20px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .content a:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
        }
    </style>

    <center>
    <div class="content">
    <?php
    if (isset($_SESSION['idClient'])) {
        echo "<h1>Bonjour, " . $_SESSION['prenom'] . " " . $_SESSION['nom'] . "!</h1>";
        echo"<p>Réservez une place pour un tournoi de jeu vidéo! <i class=\"fa-solid fa-gamepad\"></i></p>";
    } else {
        echo "<h1>Bienvenue</h1>";
    }
    ?>
        
    </div>
        
        <div class="container">
            <div class="slide">
                <div class="item" style="background-image: url(img/<?php echo (!empty($events1) && isset($events1[0]['image'])) ? htmlspecialchars($events1[0]['image']) : 'default.jpg'; ?>);">
                <div class="content">
                    <div class="name"><?php echo (!empty($events1) && isset($events1[0]['description'])) ? htmlspecialchars($events1[0]['description']) : ''; ?></div>
                    <a href="index.php?page=tournois&#image1">voir plus</a>
                </div>
                </div>
                <div class="item" style="background-image: url(img/<?php echo (!empty($events2) && isset($events2[0]['image'])) ? htmlspecialchars($events2[0]['image']) : 'default.jpg'; ?>);">
                    <div class="content">
                    <div class="name"><?php echo (!empty($events2) && isset($events2[0]['description'])) ? htmlspecialchars($events2[0]['description']) : ''; ?></div>
                        <a href="index.php?page=tournois&#image2">voir plus</a>
                    </div>
                </div>
                <div class="item" style="background-image: url(img/<?php echo (!empty($events3) && isset($events3[0]['image'])) ? htmlspecialchars($events3[0]['image']) : 'default.jpg'; ?>);">
                    <div class="content">
                    <div class="name"><?php echo (!empty($events3) && isset($events3[0]['description'])) ? htmlspecialchars($events3[0]['description']) : ''; ?></div>
                        <a href="index.php?page=tournois&#image3">voir plus</a>
                    </div>
                </div>
                <div class="item" style="background-image: url(img/<?php echo (!empty($events4) && isset($events4[0]['image'])) ? htmlspecialchars($events4[0]['image']) : 'default.jpg'; ?>);">
                    <div class="content">
                    <div class="name"><?php echo (!empty($events4) && isset($events4[0]['description'])) ? htmlspecialchars($events4[0]['description']) : ''; ?></div>
                        <a href="index.php?page=tournois&#image4">voir plus</a>
                    </div>
                </div>
                <div class="item" style="background-image: url(img/<?php echo (!empty($events5) && isset($events5[0]['image'])) ? htmlspecialchars($events5[0]['image']) : 'default.jpg'; ?>);">
                    <div class="content">
                    <div class="name"><?php echo (!empty($events5) && isset($events5[0]['description'])) ? htmlspecialchars($events5[0]['description']) : ''; ?></div>
                        <a href="index.php?page=tournois&#image5">voir plus</a>
                    </div>
                </div>
                <div class="item" style="background-image: url(img/<?php echo (!empty($events6) && isset($events6[0]['image'])) ? htmlspecialchars($events6[0]['image']) : 'default.jpg'; ?>);">
                    <div class="content">
                    <div class="name"><?php echo (!empty($events6) && isset($events6[0]['description'])) ? htmlspecialchars($events6[0]['description']) : ''; ?></div>
                        <a href="index.php?page=tournois&#image6">voir plus</a>
                    </div>
                </div>
                <div class="item" style="background-image: url(img/<?php echo (!empty($events7) && isset($events7[0]['image'])) ? htmlspecialchars($events7[0]['image']) : 'default.jpg'; ?>);">
                    <div class="content">
                    <div class="name"><?php echo (!empty($events7) && isset($events7[0]['description'])) ? htmlspecialchars($events7[0]['description']) : ''; ?></div>
                        <a href="index.php?page=tournois&#image7">voir plus</a>
                    </div>
                </div>
                <div class="item" style="background-image: url(img/<?php echo (!empty($events8) && isset($events8[0]['image'])) ? htmlspecialchars($events8[0]['image']) : 'default.jpg'; ?>);">
                    <div class="content">
                    <div class="name"><?php echo (!empty($events8) && isset($events8[0]['description'])) ? htmlspecialchars($events8[0]['description']) : ''; ?></div>
                        <a href="index.php?page=tournois&#image8">voir plus</a>
                    </div>
                </div>
            </div>
            <div class="button">
                <button class="prev"><i class="fa-solid fa-arrow-left"></i></button>
                <button class="next"><i class="fa-solid fa-arrow-right"></i></button>
            </div>
        </div>
        <br><br><br><br>
    </center>

    <script>
        const $next = document.querySelector('.next');
        const $prev = document.querySelector('.prev');

        $next.addEventListener('click', () => {
            const items = document.querySelectorAll('.item');
            document.querySelector('.slide').prepend(items[items.length - 1]);
        });

        $prev.addEventListener('click', () => {
            const items = document.querySelectorAll('.item');
            document.querySelector('.slide').appendChild(items[0]);
        });
    </script>

</body>
</html>
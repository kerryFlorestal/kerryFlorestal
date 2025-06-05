<?php
include ("./bdd/bdd.php");
?>

<?php
// Connexion à la base de données

// Fonction pour récupérer les événements par clé d'image
function getEventsByimageKey($bdd, $imageKey) {
    $stmt = $bdd->prepare("
        SELECT 
            e.*,
            ce.nomCategorie AS nomCategorie,  -- Alias pour la catégorie
            l.nom AS nom                      -- Alias pour le lieu
        FROM evenement e
        LEFT JOIN categorieevent ce ON e.idCategorieEvent = ce.idCategorieEvent
        LEFT JOIN lieu l ON e.idLieu = l.idLieu
        WHERE e.imageKey = :imageKey 
        ORDER BY e.idEvenement DESC 
        LIMIT 1
    ");
    $stmt->execute(['imageKey' => $imageKey]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Récupérer les événements pour chaque catégorie
$events1 = getEventsByimageKey($bdd, '1'); 
$events2 = getEventsByimageKey($bdd, '2'); 
$events3 = getEventsByimageKey($bdd, '3');
$events4 = getEventsByimageKey($bdd, '4');
$events5 = getEventsByimageKey($bdd, '5');
$events6 = getEventsByimageKey($bdd, '6');
$events7 = getEventsByimageKey($bdd, '7');
$events8 = getEventsByimageKey($bdd, '8');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Événements</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;700;900&family=Roboto:wght@300;400;700&display=swap');
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background-color: black;
            color: #ffffff;
            font-family: 'Roboto', sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(0, 255, 255, 0.03) 0%, transparent 30%),
                radial-gradient(circle at 90% 80%, rgba(255, 0, 255, 0.03) 0%, transparent 30%);
        }
        
        .page-title {
            font-family: 'Orbitron', sans-serif;
            text-align: center;
            margin-bottom: 40px;
            font-size: 3rem;
            font-weight: 900;
            text-transform: uppercase;
            color: white;
            letter-spacing: 2px;
            background: white;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: titleGlow 4s ease infinite;
        }
        
        
        
        .events-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 30px;
            max-width: 1600px;
            margin: 0 auto;
        }
        
        .event-card {
            position: relative;
            height: 250px;
            background: rgba(20, 20, 20, 0.6);
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.4s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            border: 2px solid transparent;
        }
        
        .event-card::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg, #ff00ff, #00ffff, #00ff00, #ff00ff);
            z-index: -1;
            border-radius: 10px;
            animation: borderAnimation 3s linear infinite;
        }
        
        @keyframes borderAnimation {
            0% { 
                background-position: 0% 0%; 
            }
            100% { 
                background-position: 300% 0%; 
            }
        }
        
        .event-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: all 0.5s ease;
            filter: brightness(0.7);
        }
        
        .event-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.8));
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 20px;
            transition: all 0.5s ease;
        }
        
        .event-title {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            color: #fff;
            
            transition: all 0.3s ease;
        }
        
        .event-info {
            max-height: 0;
            overflow: hidden;
            opacity: 0;
            transition: all 0.5s ease;
        }
        
        .event-info p {
            margin: 5px 0;
            font-size: 0.9rem;
            color: #cccccc;
        }
        
        .event-info p strong {
            color: #00ffff;
            font-weight: 500;
        }
        
        .reserve-btn {
            background: transparent;
            color: white;
            border: 1px solid white;
            padding: 10px 20px;
            border-radius: 25px;
            font-family: 'Orbitron', sans-serif;
            font-weight: 700;
            cursor: pointer;
            margin-top: 15px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            font-size: 0.9rem;
            display: inline-block;
            text-align: center;
            text-decoration: none;
            letter-spacing: 1px;
            opacity: 0;
            transform: translateY(20px);
        }
        
        .reserve-btn:hover {
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.8);
            transform: scale(1.05) translateY(0);
        }
        
        .event-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.5);
            height: 380px;
        }
        
        .event-card:hover .event-img {
            filter: brightness(0.4);
        }
        
        .event-card:hover .event-overlay {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.9));
        }
        
        .event-card:hover .event-info {
            max-height: 200px;
            opacity: 1;
            margin-top: 10px;
        }
        
        .event-card:hover .reserve-btn {
            opacity: 1;
            transform: translateY(0);
        }
        
        .event-category {
            position: absolute;
            top: 15px;
            right: 15px;
            background: linear-gradient(90deg, #ff00ff, #00ffff);
            color: #000;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .event-date {
            position: absolute;
            top: 15px;
            left: 15px;
            background: rgba(0, 0, 0, 0.7);
            color: #00ffff;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 700;
        }
        
        /* Admin section */
        .admin-section {
            margin-top: 60px;
            padding: 20px;
            background: rgba(20, 20, 20, 0.8);
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .admin-section h2 {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.8rem;
            margin-bottom: 20px;
            text-align: center;
            color: #00ffff;
        }
        
        /* Media queries for responsiveness */
        @media screen and (max-width: 768px) {
            .events-grid {
                grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
                gap: 20px;
                padding: 0 10px;
            }
            
            .page-title {
                font-size: 2rem;
            }
            
            .event-card:hover {
                height: 400px;
            }
        }
        
        @media screen and (max-width: 480px) {
            .events-grid {
                grid-template-columns: 1fr;
            }
            
            .page-title {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>
    <br/>
    <h1 class="page-title">Nos Événements</h1>
    <div class="events-grid">
        <!-- Event 1 -->
        <div class="event-card">
            <img src="img/<?php echo (!empty($events1) && isset($events1[0]['image'])) ? htmlspecialchars($events1[0]['image']) : 'default.jpg'; ?>" alt="Event Image" class="event-img">
            <div class="event-overlay">
                <?php if (empty($events1)): ?>
                    <p class="event-title">Aucun événement disponible</p>
                <?php else: ?>
                    <?php foreach ($events1 as $event): ?>
                        <div class="event-date"><?php echo htmlspecialchars($event['dateEvent']); ?></div>
                        <div class="event-category"><?php echo htmlspecialchars($event['nomCategorie']); ?></div>
                        <h2 class="event-title"><?php echo htmlspecialchars($event['nomEvent']); ?></h2>
                        <div class="event-info">
                            <p><strong>Heure :</strong> <?php echo htmlspecialchars($event['Heure']); ?></p>
                            <p><strong>Jeu :</strong> <?php echo htmlspecialchars($event['description']); ?></p>
                            <p><strong>Prix Billet :</strong> <?php echo htmlspecialchars($event['prixBillet']); ?>€</p>
                            <p><strong>Disponible :</strong> <?php echo ($event['disponible'] == 1) ? 'Oui' : 'Non'; ?></p>
                            <p><strong>Adresse :</strong> <?php echo htmlspecialchars($event['nom']); ?></p>
                            <?php if (isset($_SESSION['idClient'])): ?>
                                <a href="index.php?page=reservation&nomEvent=<?php echo urlencode($event['nomEvent']); ?>&dateEvent=<?php echo urlencode($event['dateEvent']); ?>&prixBillet=<?php echo urlencode($event['prixBillet']); ?>&idEvenement=<?php echo urlencode($event['idEvenement']); ?>" class="reserve-btn">Réserver</a>
                            <?php else: ?>
                                <a href="index.php?page=connexion" class="reserve-btn">Se connecter pour réserver</a>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Event 2 -->
        <div class="event-card">
            <img src="img/<?php echo (!empty($events2) && isset($events2[0]['image'])) ? htmlspecialchars($events2[0]['image']) : 'default.jpg'; ?>" alt="Event Image" class="event-img">
            <div class="event-overlay">
                <?php if (empty($events2)): ?>
                    <p class="event-title">Aucun événement disponible</p>
                <?php else: ?>
                    <?php foreach ($events2 as $event): ?>
                        <div class="event-date"><?php echo htmlspecialchars($event['dateEvent']); ?></div>
                        <div class="event-category"><?php echo htmlspecialchars($event['nomCategorie']); ?></div>
                        <h2 class="event-title"><?php echo htmlspecialchars($event['nomEvent']); ?></h2>
                        <div class="event-info">
                            <p><strong>Heure :</strong> <?php echo htmlspecialchars($event['Heure']); ?></p>
                            <p><strong>Jeu :</strong> <?php echo htmlspecialchars($event['description']); ?></p>
                            <p><strong>Prix Billet :</strong> <?php echo htmlspecialchars($event['prixBillet']); ?>€</p>
                            <p><strong>Disponible :</strong> <?php echo ($event['disponible'] == 1) ? 'Oui' : 'Non'; ?></p>
                            <p><strong>Adresse :</strong> <?php echo htmlspecialchars($event['nom']); ?></p>
                            <?php if (isset($_SESSION['idClient'])): ?>
                                <a href="index.php?page=reservation&nomEvent=<?php echo urlencode($event['nomEvent']); ?>&dateEvent=<?php echo urlencode($event['dateEvent']); ?>&prixBillet=<?php echo urlencode($event['prixBillet']); ?>&idEvenement=<?php echo urlencode($event['idEvenement']); ?>" class="reserve-btn">Réserver</a>
                            <?php else: ?>
                                <a href="index.php?page=connexion" class="reserve-btn">Se connecter pour réserver</a>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Event 3 -->
        <div class="event-card">
            <img src="img/<?php echo (!empty($events3) && isset($events3[0]['image'])) ? htmlspecialchars($events3[0]['image']) : 'default.jpg'; ?>" alt="Event Image" class="event-img">
            <div class="event-overlay">
                <?php if (empty($events3)): ?>
                    <p class="event-title">Aucun événement disponible</p>
                <?php else: ?>
                    <?php foreach ($events3 as $event): ?>
                        <div class="event-date"><?php echo htmlspecialchars($event['dateEvent']); ?></div>
                        <div class="event-category"><?php echo htmlspecialchars($event['nomCategorie']); ?></div>
                        <h2 class="event-title"><?php echo htmlspecialchars($event['nomEvent']); ?></h2>
                        <div class="event-info">
                            <p><strong>Heure :</strong> <?php echo htmlspecialchars($event['Heure']); ?></p>
                            <p><strong>Jeu :</strong> <?php echo htmlspecialchars($event['description']); ?></p>
                            <p><strong>Prix Billet :</strong> <?php echo htmlspecialchars($event['prixBillet']); ?>€</p>
                            <p><strong>Disponible :</strong> <?php echo ($event['disponible'] == 1) ? 'Oui' : 'Non'; ?></p>
                            <p><strong>Adresse :</strong> <?php echo htmlspecialchars($event['nom']); ?></p>
                            <?php if (isset($_SESSION['idClient'])): ?>
                                <a href="index.php?page=reservation&nomEvent=<?php echo urlencode($event['nomEvent']); ?>&dateEvent=<?php echo urlencode($event['dateEvent']); ?>&prixBillet=<?php echo urlencode($event['prixBillet']); ?>&idEvenement=<?php echo urlencode($event['idEvenement']); ?>" class="reserve-btn">Réserver</a>
                            <?php else: ?>
                                <a href="index.php?page=connexion" class="reserve-btn">Se connecter pour réserver</a>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Event 4 -->
        <div class="event-card">
            <img src="img/<?php echo (!empty($events4) && isset($events4[0]['image'])) ? htmlspecialchars($events4[0]['image']) : 'default.jpg'; ?>" alt="Event Image" class="event-img">
            <div class="event-overlay">
                <?php if (empty($events4)): ?>
                    <p class="event-title">Aucun événement disponible</p>
                <?php else: ?>
                    <?php foreach ($events4 as $event): ?>
                        <div class="event-date"><?php echo htmlspecialchars($event['dateEvent']); ?></div>
                        <div class="event-category"><?php echo htmlspecialchars($event['nomCategorie']); ?></div>
                        <h2 class="event-title"><?php echo htmlspecialchars($event['nomEvent']); ?></h2>
                        <div class="event-info">
                            <p><strong>Heure :</strong> <?php echo htmlspecialchars($event['Heure']); ?></p>
                            <p><strong>Jeu :</strong> <?php echo htmlspecialchars($event['description']); ?></p>
                            <p><strong>Prix Billet :</strong> <?php echo htmlspecialchars($event['prixBillet']); ?>€</p>
                            <p><strong>Disponible :</strong> <?php echo ($event['disponible'] == 1) ? 'Oui' : 'Non'; ?></p>
                            <p><strong>Adresse :</strong> <?php echo htmlspecialchars($event['nom']); ?></p>
                            <?php if (isset($_SESSION['idClient'])): ?>
                                <a href="index.php?page=reservation&nomEvent=<?php echo urlencode($event['nomEvent']); ?>&dateEvent=<?php echo urlencode($event['dateEvent']); ?>&prixBillet=<?php echo urlencode($event['prixBillet']); ?>&idEvenement=<?php echo urlencode($event['idEvenement']); ?>" class="reserve-btn">Réserver</a>
                            <?php else: ?>
                                <a href="index.php?page=connexion" class="reserve-btn">Se connecter pour réserver</a>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Event 5 -->
        <div class="event-card">
            <img src="img/<?php echo (!empty($events5) && isset($events5[0]['image'])) ? htmlspecialchars($events5[0]['image']) : 'default.jpg'; ?>" alt="Event Image" class="event-img">
            <div class="event-overlay">
                <?php if (empty($events5)): ?>
                    <p class="event-title">Aucun événement disponible</p>
                <?php else: ?>
                    <?php foreach ($events5 as $event): ?>
                        <div class="event-date"><?php echo htmlspecialchars($event['dateEvent']); ?></div>
                        <div class="event-category"><?php echo htmlspecialchars($event['nomCategorie']); ?></div>
                        <h2 class="event-title"><?php echo htmlspecialchars($event['nomEvent']); ?></h2>
                        <div class="event-info">
                            <p><strong>Heure :</strong> <?php echo htmlspecialchars($event['Heure']); ?></p>
                            <p><strong>Jeu :</strong> <?php echo htmlspecialchars($event['description']); ?></p>
                            <p><strong>Prix Billet :</strong> <?php echo htmlspecialchars($event['prixBillet']); ?>€</p>
                            <p><strong>Disponible :</strong> <?php echo ($event['disponible'] == 1) ? 'Oui' : 'Non'; ?></p>
                            <p><strong>Adresse :</strong> <?php echo htmlspecialchars($event['nom']); ?></p>
                            <?php if (isset($_SESSION['idClient'])): ?>
                                <a href="index.php?page=reservation&nomEvent=<?php echo urlencode($event['nomEvent']); ?>&dateEvent=<?php echo urlencode($event['dateEvent']); ?>&prixBillet=<?php echo urlencode($event['prixBillet']); ?>&idEvenement=<?php echo urlencode($event['idEvenement']); ?>" class="reserve-btn">Réserver</a>
                            <?php else: ?>
                                <a href="index.php?page=connexion" class="reserve-btn">Se connecter pour réserver</a>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Event 6 -->
        <div class="event-card">
            <img src="img/<?php echo (!empty($events6) && isset($events6[0]['image'])) ? htmlspecialchars($events6[0]['image']) : 'default.jpg'; ?>" alt="Event Image" class="event-img">
            <div class="event-overlay">
                <?php if (empty($events6)): ?>
                    <p class="event-title">Aucun événement disponible</p>
                <?php else: ?>
                    <?php foreach ($events6 as $event): ?>
                        <div class="event-date"><?php echo htmlspecialchars($event['dateEvent']); ?></div>
                        <div class="event-category"><?php echo htmlspecialchars($event['nomCategorie']); ?></div>
                        <h2 class="event-title"><?php echo htmlspecialchars($event['nomEvent']); ?></h2>
                        <div class="event-info">
                            <p><strong>Heure :</strong> <?php echo htmlspecialchars($event['Heure']); ?></p>
                            <p><strong>Jeu :</strong> <?php echo htmlspecialchars($event['description']); ?></p>
                            <p><strong>Prix Billet :</strong> <?php echo htmlspecialchars($event['prixBillet']); ?>€</p>
                            <p><strong>Disponible :</strong> <?php echo ($event['disponible'] == 1) ? 'Oui' : 'Non'; ?></p>
                            <p><strong>Adresse :</strong> <?php echo htmlspecialchars($event['nom']); ?></p>
                            <?php if (isset($_SESSION['idClient'])): ?>
                                <a href="index.php?page=reservation&nomEvent=<?php echo urlencode($event['nomEvent']); ?>&dateEvent=<?php echo urlencode($event['dateEvent']); ?>&prixBillet=<?php echo urlencode($event['prixBillet']); ?>&idEvenement=<?php echo urlencode($event['idEvenement']); ?>" class="reserve-btn">Réserver</a>
                            <?php else: ?>
                                <a href="index.php?page=connexion" class="reserve-btn">Se connecter pour réserver</a>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="event-card">
            <img src="img/<?php echo (!empty($events7) && isset($events7[0]['image'])) ? htmlspecialchars($events7[0]['image']) : 'default.jpg'; ?>" alt="Event Image" class="event-img">
            <div class="event-overlay">
                <?php if (empty($events7)): ?>
                    <p class="event-title">Aucun événement disponible</p>
                <?php else: ?>
                    <?php foreach ($events7 as $event): ?>
                        <div class="event-date"><?php echo htmlspecialchars($event['dateEvent']); ?></div>
                        <div class="event-category"><?php echo htmlspecialchars($event['nomCategorie']); ?></div>
                        <h2 class="event-title"><?php echo htmlspecialchars($event['nomEvent']); ?></h2>
                        <div class="event-info">
                            <p><strong>Heure :</strong> <?php echo htmlspecialchars($event['Heure']); ?></p>
                            <p><strong>Jeu :</strong> <?php echo htmlspecialchars($event['description']); ?></p>
                            <p><strong>Prix Billet :</strong> <?php echo htmlspecialchars($event['prixBillet']); ?>€</p>
                            <p><strong>Disponible :</strong> <?php echo ($event['disponible'] == 1) ? 'Oui' : 'Non'; ?></p>
                            <p><strong>Adresse :</strong> <?php echo htmlspecialchars($event['nom']); ?></p>
                            <?php if (isset($_SESSION['idClient'])): ?>
                                <a href="index.php?page=reservation&nomEvent=<?php echo urlencode($event['nomEvent']); ?>&dateEvent=<?php echo urlencode($event['dateEvent']); ?>&prixBillet=<?php echo urlencode($event['prixBillet']); ?>&idEvenement=<?php echo urlencode($event['idEvenement']); ?>" class="reserve-btn">Réserver</a>
                            <?php else: ?>
                                <a href="index.php?page=connexion" class="reserve-btn">Se connecter pour réserver</a>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        

        <div class="event-card">
            <img src="img/<?php echo (!empty($events8) && isset($events8[0]['image'])) ? htmlspecialchars($events8[0]['image']) : 'default.jpg'; ?>" alt="Event Image" class="event-img">
            <div class="event-overlay">
                <?php if (empty($events8)): ?>
                    <p class="event-title">Aucun événement disponible</p>
                <?php else: ?>
                    <?php foreach ($events8 as $event): ?>
                        <div class="event-date"><?php echo htmlspecialchars($event['dateEvent']); ?></div>
                        <div class="event-category"><?php echo htmlspecialchars($event['nomCategorie']); ?></div>
                        <h2 class="event-title"><?php echo htmlspecialchars($event['nomEvent']); ?></h2>
                        <div class="event-info">
                            <p><strong>Heure :</strong> <?php echo htmlspecialchars($event['Heure']); ?></p>
                            <p><strong>Jeu :</strong> <?php echo htmlspecialchars($event['description']); ?></p>
                            <p><strong>Prix Billet :</strong> <?php echo htmlspecialchars($event['prixBillet']); ?>€</p>
                            <p><strong>Disponible :</strong> <?php echo ($event['disponible'] == 1) ? 'Oui' : 'Non'; ?></p>
                            <p><strong>Adresse :</strong> <?php echo htmlspecialchars($event['nom']); ?></p>
                            <?php if (isset($_SESSION['idClient'])): ?>
                                <a href="index.php?page=reservation&nomEvent=<?php echo urlencode($event['nomEvent']); ?>&dateEvent=<?php echo urlencode($event['dateEvent']); ?>&prixBillet=<?php echo urlencode($event['prixBillet']); ?>&idEvenement=<?php echo urlencode($event['idEvenement']); ?>" class="reserve-btn">Réserver</a>
                            <?php else: ?>
                                <a href="index.php?page=connexion" class="reserve-btn">Se connecter pour réserver</a>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    
    </div>
<br/><br/><br/><br/>
    

    <?php
    if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
        echo '<div class="admin-section">';
        require_once('view/admin/a_evenement.php');
        echo '</div>';
    }
    ?>
</body>
</html> 
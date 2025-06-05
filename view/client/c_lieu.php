<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lieu</title>
</head>
<body>
    

<?php
include ("./bdd/bdd.php");
?>
<?php
// Connexion à la base de données
    

    // Fonction pour récupérer les événements par clé d'image
    function getEventsBylieuKey($bdd, $lieuKey) {
        $stmt = $bdd->prepare("SELECT * FROM lieu WHERE lieuKey = :lieuKey ORDER BY idLieu DESC limit 1");
        $stmt->execute(['lieuKey' => $lieuKey]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer les événements pour chaque catégorie
    $lieu1 = getEventsBylieuKey($bdd, '1'); 
    $lieu2 = getEventsBylieuKey($bdd, '2'); 
    $lieu3 = getEventsBylieuKey($bdd, '3'); 

    ?>

    <style>
        body {
          color: white;
          background-color: black;
          font-family: 'Orbitron', sans-serif;
        }

        h2 {
        margin-top: 30px;
        color: #e74c3c;
        }

        p {
            color: #bdc3c7;
            margin-top: 20px;
        }

        .section {
            display: flex;
            justify-content: space-around; 
            align-items: flex-start; 
            
        }
        .section section {
            text-align: center;
            border: 3px solid white;
            box-shadow: 0 10px 30px blue;
        }
    </style>

<center>
<br><br>
    <div class="section">
        <section>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4992.188728702932!2d2.375895376304516!3d48.838603771329474!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e6721743fa0af9%3A0x989bfc2771543869!2sAccor%20Arena!5e1!3m2!1sfr!2sfr!4v1733739408325!5m2!1sfr!2sfr" 
                width="300" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
            </iframe>
            <?php if (empty($lieu1)): ?>
                <p>Aucun lieu disponible</p>
            <?php else: ?>
                <?php foreach ($lieu1 as $lieu): ?>
                    <div class="lieu">
                        
                        <h2><?php echo htmlspecialchars($lieu['nom']); ?></h2>
                        <p><strong></strong> <?php echo htmlspecialchars($lieu['adresse']); ?></p>
                        <p><strong>Capacité :</strong> <?php echo htmlspecialchars($lieu['capacite']); ?></p>
                        <p><strong>description :</strong> <?php echo htmlspecialchars($lieu['description']); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </section>

        <section>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2493.24963174984!2d2.227051076307976!3d48.89566577133724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e664f93278928d%3A0xc749b6b4e73d3630!2sParis%20La%20Défense%20Arena!5e1!3m2!1sfr!2sfr!4v1733739463212!5m2!1sfr!2sfr" 
                width="300" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
            </iframe>
            <?php if (empty($lieu2)): ?>
                <p> Aucun lieu disponible </p>
            <?php else:?>
                <?php foreach ($lieu2 as $lieu): ?>
                    <div class="lieu">
                        <h2><?php echo htmlspecialchars($lieu['nom']); ?></h2>
                        <p><strong></strong> <?php echo htmlspecialchars($lieu['adresse']); ?></p>
                        <p><strong>capacite :</strong> <?php echo htmlspecialchars($lieu['capacite']); ?></p>
                        <p><strong>description :</strong> <?php echo htmlspecialchars($lieu['description']); ?></p>
                    </div>
                <?php endforeach; ?>
                <?php endif; ?>
            </section>

            <section>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2493.0539411840064!2d2.3580304763082096!3d48.89958927133777!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66f4ad69f595b%3A0x65adb63f1d724a5a!2sAdidas%20Arena!5e1!3m2!1sfr!2sfr!4v1733739443908!5m2!1sfr!2sfr" 
                    width="300" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                </iframe>
                <?php if (empty($lieu3)): ?>
                    <p> Aucun lieu disponible </p>
                <?php else:?>
                    <?php foreach ($lieu3 as $lieu): ?>
                        <div class="lieu"><h2><?php echo htmlspecialchars($lieu['nom']); ?></h2>
                                    <p><strong></strong> <?php echo htmlspecialchars($lieu['adresse']); ?></p>
                                    <p><strong>capacite :</strong> <?php echo htmlspecialchars($lieu['capacite']); ?></p>
                                    <p><strong>description :</strong> <?php echo htmlspecialchars($lieu['description']); ?></p>
                        </div>
                    <?php endforeach; ?>
                    <?php endif; ?>
            </section>
        </div>
        <br/>
        <br/>
        <br/>
        <?php
            if($_SESSION['role'] == 'admin'){
                require_once('view/admin/a_lieu.php');
        }
    ?>
</center>


</body>
</html>
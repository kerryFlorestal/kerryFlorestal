<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil Client</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;700;900&family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <br><br><br><br>
    <style>
        body {
            background-color: #111;
            margin: 0;
            padding: 0;
            font-family: 'Roboto', sans-serif;
        }

        .profile-card {
            background: rgba(20, 20, 20, 0.85);
            padding: 40px;
            border-radius: 16px;
            max-width: 600px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.6);
            position: relative;
            border: 2px solid white;
            color: #ccc;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .profile-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 35px rgba(0, 255, 255, 0.4);
        }

        .profile-card::before {
            content: '';
            position: absolute;
            top: -2px; left: -2px; right: -2px; bottom: -2px;   
            z-index: -1;
            border-radius: 18px;
            background-size: 400%;
            animation: borderAnimation 5s linear infinite;
        }

        @keyframes borderAnimation {
            0% { background-position: 0% 0%; }
            100% { background-position: 400% 0%; }
        }

        .profile-header {
            font-family: 'Orbitron', sans-serif;
            color:rgb(255, 255, 255);
            font-size: 1.8rem;
            text-align: center;
            margin-bottom: 25px;
            text-shadow: 0 0 8px rgba(0, 255, 255, 0.7);
        }

        .profile-info {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .profile-row {
            display: flex;
            justify-content: space-between;
            border-bottom: 1px solid rgba(0, 255, 255, 0.15);
            padding-bottom: 10px;
        }

        .profile-label {
            font-weight: 700;
            color: #00ccff;
            text-transform: uppercase;
            font-size: 0.9rem;
            width: 40%;
        }

        .profile-value {
            font-size: 1rem;
            text-align: right;
            width: 60%;
        }

        .profile-actions {
            margin-top: 30px;
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .profile-actions a img {
            height: 45px;
            width: 45px;
            border-radius: 10px;
            transition: all 0.4s ease;
            padding: 5px;
            box-shadow: 0 0 12px rgba(0, 255, 255, 0.5);
        }

        .profile-actions a img:hover {
            transform: scale(1.2) rotate(5deg);
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.9), 0 0 30px rgba(255, 0, 255, 0.7);
            background: linear-gradient(45deg, #e600e6, #00ccff);
        }

        @media screen and (max-width: 600px) {
            .profile-card {
                padding: 25px;
            }

            .profile-label, .profile-value {
                font-size: 0.85rem;
            }

            .profile-header {
                font-size: 1.4rem;
            }

            .profile-actions a img {
                height: 40px;
                width: 40px;
            }
        }
    </style>
</head>
<body>



<?php
// Exemple de données pour démonstration
// À remplacer par votre propre récupération de données en BDD
if (!empty($selectClientById)) {
?>
<center>
<div class="profile-card">
    <div class="profile-header">Profil Client</div>
    <div class="profile-info">
        <div class="profile-row">
            <div class="profile-label">Nom</div>
            <div class="profile-value"><?= htmlspecialchars($selectClientById['nom']) ?></div>
        </div>
        <div class="profile-row">
            <div class="profile-label">Prénom</div>
            <div class="profile-value"><?= htmlspecialchars($selectClientById['prenom']) ?></div>
        </div>
        <div class="profile-row">
            <div class="profile-label">Téléphone</div>
            <div class="profile-value"><?= htmlspecialchars($selectClientById['numeroTel']) ?></div>
        </div>
        <div class="profile-row">
            <div class="profile-label">Email</div>
            <div class="profile-value"><?= htmlspecialchars($selectClientById['email']) ?></div>
        </div>
        <div class="profile-row">
            <div class="profile-label">Mot de Passe</div>
            <div class="profile-value"><?= htmlspecialchars($selectClientById['mdp']) ?></div>
        </div>
    </div>
    <div class="profile-actions">
        <a href="index.php?page=9&action=edit&idClient=<?= $selectClientById['idClient'] ?>"><i class="fa-solid fa-pen-to-square"></i></a>
        <a href="index.php?page=9&action=sup&idClient=<?= $selectClientById['idClient'] ?>"><i class="fa-solid fa-trash-alt"></i></a>
    </div>
</div>
<br><br><br><br>
<?php
} else {
    echo "<div style='text-align:center; color:red; font-family:Orbitron,sans-serif; padding:50px;'>Aucun client trouvé.</div>";
}
?>
</center>
</body>
</html>

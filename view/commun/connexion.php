<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire Connexion et Inscription</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            margin: 0;
        }
        
        .form-container {
            display: none;
            max-width: 500px;
            margin: 0 auto;
            padding: 30px;
            border: 1px solid white;
            border-radius: 30px;
            box-shadow: 0 20px 50px #48195f;
            transition: all 0.3s ease;
        }
        
        .form-container.active {
            display: block;
            animation: fadeIn 0.5s;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h1 {
            color: white;
            text-align: center;
            margin-bottom: 20px;
            font-size: 1.8em;
        }

        p {
            color: white;
            text-align: center;
            margin-top: 20px;
        }
        
        a {
            color: #a384b3;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s;
        }
        
        a:hover {
            color: white;
            text-decoration: underline;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        table {
            width: 100%;
            margin-bottom: 20px;    
        }

        table td {
            padding: 8px;
            vertical-align: middle;
            color: white;
        }

        input[type="text"], 
        input[type="password"], 
        input[type="int"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
            background-color: transparent;
            color: white;
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        
        input[type="text"]:focus, 
        input[type="password"]:focus, 
        input[type="int"]:focus {
            outline: none;
            border-color: white;
            box-shadow: 0 0 5px rgba(255,255,255,0.5);
        }

        input[type="submit"], 
        input[type="reset"] {
            background-color: transparent;
            color: white;
            border: 1px solid white;
            padding: 12px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s ease;
            margin-top: 5px;
        }

        input[type="submit"]:hover, 
        input[type="reset"]:hover {
            background-color: white;
            color: black;
            transform: translateY(-2px);
        }
        
        input[type="submit"]:active, 
        input[type="reset"]:active {
            transform: translateY(0);
        }

        .hidden {
            display: none;
        }
        
        .buttons-row {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        @media (max-width: 600px) {
            .form-container {
                padding: 20px;
                width: 90%;
                margin: 0 auto;
            }

            table td {
                display: block;
                width: 100%;
            }
            
            .buttons-row {
                flex-direction: column;
            }
            
            input[type="submit"], 
            input[type="reset"] {
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>

<br/><br/><br/>
    <div id="connexionForm" class="form-container active">
        <h1>Se connecter</h1>
        <form action="controller/utilisateur/utilisateurController.php" method="post">
            <table>
                <tr>
                    <td>Email :</td>
                    <td><input type="text" name="email" placeholder="Votre adresse email" required></td>
                </tr>
                <tr>
                    <td>Mot de passe :</td>
                    <td><input type="password" name="mdp" placeholder="Votre mot de passe" required></td>
                </tr>
            </table>
            <div class="buttons-row">
                <input type="reset" value="Annuler">
                <input type="hidden" name="action" value="connexion">
                <input type="submit" name="SeConnecter" value="Se Connecter">
            </div>
        </form>
        <p>Vous n'avez pas de compte ? <a href="#" onclick="switchToSignup()">S'inscrire</a></p>
    </div>

    <div id="inscriptionForm" class="form-container">
        <h1>S'inscrire</h1>
        <form action="controller/utilisateur/utilisateurController.php" method="post">
            <table>
                <tr>
                    <td>Nom :</td>
                    <td><input type="text" name="nom" placeholder="Votre nom" required
                         value="<?php if(isset($leClient)) echo htmlspecialchars($leClient['nom']); ?>"></td>
                </tr>
                <tr>
                    <td>Prénom :</td>
                    <td><input type="text" name="prenom" placeholder="Votre prénom" required
                         value="<?php if(isset($leClient)) echo htmlspecialchars($leClient['prenom']); ?>"></td>
                </tr>
                <tr>
                    <td>Téléphone :</td>
                    <td><input type="text" name="numeroTel" placeholder="Votre numéro de téléphone" required
                         value="<?php if(isset($leClient)) echo htmlspecialchars($leClient['numeroTel']); ?>"></td>
                </tr>
                <tr>
                    <td>Email :</td>
                    <td><input type="text" name="email" placeholder="Votre adresse email" required
                         value="<?php if(isset($leClient)) echo htmlspecialchars($leClient['email']); ?>"></td>
                </tr>
                <tr>
                    <td>Mot de passe :</td>
                    <td><input type="password" name="mdp" placeholder="Votre mot de passe" required
                         value="<?php if(isset($leClient)) echo htmlspecialchars($leClient['mdp']); ?>"></td>
                </tr>
            </table>
            
            <input type="hidden" name="action" value="inscription">
            <?php if(isset($leClient)) {
                echo "<input type='hidden' name='idClient' value='".htmlspecialchars($leClient['idClient'])."'>";
            } ?>
            
            <div class="buttons-row">
                <input type="reset" value="Annuler">
                <input type="submit" value="Valider">
            </div>
        </form>
        <p>Déjà un compte ? <a href="#" onclick="switchToLogin()">Se connecter</a></p>
    </div>

    <script>
        function switchToSignup() {
            document.getElementById('connexionForm').classList.remove('active');
            document.getElementById('inscriptionForm').classList.add('active');
        }

        function switchToLogin() {
            document.getElementById('inscriptionForm').classList.remove('active');
            document.getElementById('connexionForm').classList.add('active');
        }
    </script>
</body>
</html>
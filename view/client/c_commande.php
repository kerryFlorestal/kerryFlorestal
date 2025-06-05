<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation Réservation</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;700;900&family=Roboto:wght@300;400;700&display=swap');

        /* General Styles */
        body {
            background: #0a0a0a;
            font-family: 'Roboto', sans-serif;
            color: #cccccc;
            display: flex;
            
            min-height: 100vh;
          
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(0, 255, 255, 0.03) 0%, transparent 30%),
                radial-gradient(circle at 90% 80%, rgba(255, 0, 255, 0.03) 0%, transparent 30%);
        }

        h1 {
            font-family: 'Orbitron', sans-serif;
            font-size: 2.2rem;
            color: #fff;
            text-align: center;
            text-transform: uppercase;
            margin-bottom: 20px;
        }

        /* Card Container */
        .bozo {
            background: black;
            padding: 30px;
            border-radius: 12px;
            width: 100%;
            margin-left: 500px;
            max-width: 500px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
            position: relative;
            border: 2px solid white;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: opacity 0.5s ease-in-out;
        }

        .bozo::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: transparent;
            z-index: -1;
            border-radius: 14px;
            animation: borderAnimation 4s linear infinite;
        }

        @keyframes borderAnimation {
            0% { background-position: 0% 0%; }
            100% { background-position: 400% 0%; }
        }

        /* Form Styles */
        form {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        .form-group label {
            font-family: 'Orbitron', sans-serif;
            font-size: 1rem;
            font-weight: 700;
            color: white;
            margin-bottom: 5px;
        }

        .form-group input {
            padding: 10px;
            border: 1px solid rgba(0, 255, 255, 0.3);
            border-radius: 5px;
            background: rgba(255, 255, 255, 0.05);
            color: #fff;
            font-family: 'Roboto', sans-serif;
            font-size: 0.9rem;
            box-shadow: 0 0 5px rgba(0, 255, 255, 0.3);
            width: 100%;
            box-sizing: border-box;
        }

        .form-group input[readonly] {
            background: rgba(255, 255, 255, 0.1);
            cursor: default;
            border: 2px solid white;
        }

        .form-group input[type="hidden"] {
            display: none;
        }

        /* Submit Button */
        input[type="submit"][name="Réserver"] {
            background: transparent;    
            color: #fff;
            border: none;
            padding: 12px 24px;
            border-radius: 25px;
            font-family: 'Orbitron', sans-serif;
            font-size: 1rem;
            font-weight: 700;
            text-transform: uppercase;
            cursor: pointer;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 255, 255, 0.5);
            transition: all 0.4s ease;
            align-self: center;
        }

        input[type="submit"][name="Réserver"]:hover {
            background: black;  
            transform: scale(1.1) rotate(3deg);
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.9), 0 0 30px rgba(255, 0, 255, 0.7);
        }

        /* Validation Animation */
        .hidden {
            display: none;
        }

        .checkmark {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 4px solid #00ccff;
            background: rgba(20, 20, 20, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 20px auto;
            opacity: 0;
            transform: scale(0);
            animation: fadeInScale 0.5s forwards ease-in-out;
            box-shadow: 0 0 15px rgba(0, 255, 255, 0.7);
        }

        .checkmark:after {
            content: "✔";
            font-size: 50px;
            color: #00ccff;
            text-shadow: 0 0 10px rgba(0, 255, 255, 0.9);
        }

        @keyframes fadeInScale {
            0% { opacity: 0; transform: scale(0); }
            100% { opacity: 1; transform: scale(1); }
        }

        .message {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.2rem;
            color: #fff;
            text-shadow: 0 0 10px rgba(0, 255, 255, 0.7);
            text-align: center;
            opacity: 0;
            animation: fadeIn 1s forwards 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        /* Responsive Design */
        @media screen and (max-width: 768px) {
            .bozo {
                padding: 20px;
                max-width: 90%;
            }

            h1 {
                font-size: 1.8rem;
            }

            .form-group label {
                font-size: 0.9rem;
            }

            .form-group input {
                font-size: 0.85rem;
                padding: 8px;
            }

            input[type="submit"][name="Réserver"] {
                padding: 10px 20px;
                font-size: 0.9rem;
            }
        }

        @media screen and (max-width: 480px) {
            .bozo {
                padding: 15px;
            }

            h1 {
                font-size: 1.5rem;
            }

            .form-group label {
                font-size: 0.85rem;
            }

            .form-group input {
                font-size: 0.8rem;
                padding: 7px;
            }

            input[type="submit"][name="Réserver"] {
                padding: 8px 16px;
                font-size: 0.85rem;
            }

            .checkmark {
                width: 60px;
                height: 60px;
            }

            .checkmark:after {
                font-size: 40px;
            }
        }
    </style>
</head>
<body>

<?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'client'): ?>
    <div class="container">
    <br/><br/>  
        <h1>Confirmation de Réservation</h1>
        <br/><br/>
        <div class="bozo" id="formContainer">
            <form id="reservationForm" action="controller/commande/commandeController.php" method="post" onsubmit="return confirmerReservation(event)">
                <div class="form-group">
                    <label for="client">Client</label>
                    <input type="hidden" name="idClient" value="<?php echo htmlspecialchars($_SESSION['idClient'], ENT_QUOTES, 'UTF-8'); ?>">
                    <input type="text" id="client" value="<?php echo htmlspecialchars($_SESSION['nom'], ENT_QUOTES, 'UTF-8'); ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="evenement">Événement</label>
                    <input type="hidden" name="idEvenement" value="<?php echo htmlspecialchars($_GET['idEvenement'], ENT_QUOTES, 'UTF-8'); ?>">
                    <input type="text" id="evenement" value="<?php 
                        echo isset($LaCommande) ? htmlspecialchars($LaCommande['idEvenement'], ENT_QUOTES, 'UTF-8') : '';
                        echo (isset($_POST['Réserver']) || isset($_GET['nomEvent'])) ? 
                            ' ' . htmlspecialchars(
                                isset($_GET['nomEvent']) ? $_GET['nomEvent'] : (isset($_POST['nomEvent']) ? $_POST['nomEvent'] : ''), 
                                ENT_QUOTES, 'UTF-8'
                            ) : ''; 
                    ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="prixBillet">Prix Billet</label>
                    <input type="text" id="prixBillet" name="prixBillet" value="<?php 
                        echo isset($_GET['prixBillet']) ? htmlspecialchars($_GET['prixBillet'], ENT_QUOTES, 'UTF-8') : 
                            (isset($_POST['prixBillet']) ? htmlspecialchars($_POST['prixBillet'], ENT_QUOTES, 'UTF-8') : '');
                    ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="dateEvent">Date de l'Événement</label>
                    <input type="text" id="dateEvent" name="dateEvent" value="<?php 
                        echo isset($_GET['dateEvent']) ? htmlspecialchars($_GET['dateEvent'], ENT_QUOTES, 'UTF-8') : 
                            (isset($_POST['dateEvent']) ? htmlspecialchars($_POST['dateEvent'], ENT_QUOTES, 'UTF-8') : '');
                    ?>" readonly>
                </div>
                <input type="hidden" name="action" value="confirmer">
                <input type="submit" name="Réserver" value="Confirmer la réservation">
            </form>
        </div>
    </div>
    <script>
        function confirmerReservation(event) {
            event.preventDefault(); // Prevent immediate submission

            console.log("Début de la capture...");
            // Step 1: Capture the form screenshot
            html2canvas(document.getElementById("formContainer"), {
                logging: true,
                useCORS: true,
                allowTaint: true,
                scale: 1,
                backgroundColor: '#ffffff'
            }).then(canvas => {
                let imageData = canvas.toDataURL("image/png");
                console.log("Données de l'image générée (50 premiers caractères) :", imageData.substring(0, 50) + "...");
                console.log("Taille de l'image générée :", imageData.length, "caractères");

                // Verify if the image is valid
                if (imageData.startsWith("data:image/png;base64,")) {
                    try {
                        localStorage.setItem("screenshot", imageData);
                        console.log("Capture réussie, stockée dans localStorage");
                    } catch (e) {
                        console.warn("Échec du stockage dans localStorage, mais la capture est valide :", e);
                    }

                    // Step 2: Show success alerts
                    alert("La réservation a été confirmée avec succès !");
                    alert("Dirigez-vous vers la page Ticket pour voir votre ticket !");
                    window.location.href = "index.php?page=tournois";

                    // Step 3: Submit the form
                    document.getElementById("reservationForm").submit();
                } else {
                    console.error("Image générée invalide :", imageData);
                    alert("Erreur : la capture n’a pas pu être générée correctement. La réservation sera quand même confirmée.");
                    document.getElementById("reservationForm").submit();
                }
            }).catch(error => {
                console.error("Erreur lors de la capture : ", error);
                if (imageData && imageData.startsWith("data:image/png;base64,")) {
                    console.warn("Capture partielle réussie malgré l’erreur :", error);
                    try {
                        localStorage.setItem("screenshot", imageData);
                        console.log("Capture partielle stockée dans localStorage");
                    } catch (e) {
                        console.warn("Échec du stockage de la capture partielle :", e);
                    }
                    alert("La réservation a été confirmée avec succès !");
                    document.getElementById("reservationForm").submit();
                } else {
                    alert("Erreur : la capture n’a pas pu être réalisée. La réservation sera quand même confirmée.");
                    document.getElementById("reservationForm").submit();
                }
            });

            return false; // Prevent default submission
        }
    </script>

<br/><br/><br/><br/>
<?php endif; ?>

<?php
if($_SESSION['role'] == 'admin'){
    require_once('view/admin/a_commande.php');
}
?>

</body>
</html>
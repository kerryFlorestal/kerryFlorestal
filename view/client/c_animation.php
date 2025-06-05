<script>
function confirmerReservation(event) {
            event.preventDefault(); // Empêche la soumission immédiate

            console.log("Début de la capture...");
            // Étape 1 : Capturer l’écran du formulaire
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

                // Vérifier si l'image est valide (commence par data:image/png;base64)
                if (imageData.startsWith("data:image/png;base64,")) {
                    // Tentative de stockage dans localStorage
                    try {
                        localStorage.setItem("screenshot", imageData);
                        console.log("Capture réussie, stockée dans localStorage");
                    } catch (e) {
                        console.warn("Échec du stockage dans localStorage, mais la capture est valide :", e);
                        // Pas d’alerte ici, car la capture a réussi
                    }

                    // Étape 2 : Afficher une alerte de succès
                    alert("La réservation a été confirmée avec succès !");
                    alert("Dirigez vous vers la page Ticket pour voir votre ticket !");
                    window.location.href = "index.php?page=tournois";

                    // Étape 3 : Soumettre le formulaire au serveur
                    document.getElementById("reservationForm").submit();
                } else {
                    console.error("Image générée invalide :", imageData);
                    alert("Erreur : la capture n’a pas pu être générée correctement. La réservation sera quand même confirmée.");
                    document.getElementById("reservationForm").submit();
                }
            }).catch(error => {
                console.error("Erreur lors de la capture : ", error);
                // Vérifier si une image partielle existe malgré l’erreur
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

            return false; // Empêche la soumission par défaut
        }
        </script>
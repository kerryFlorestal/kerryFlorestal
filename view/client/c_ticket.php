
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;700;900&family=Roboto:wght@300;400;700&display=swap');
        
        
        
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
            text-shadow: 0 0 10px rgba(255, 0, 255, 0.7), 0 0 20px rgba(0, 255, 255, 0.5);
            letter-spacing: 2px;
            background: linear-gradient(90deg, #ff00ff 0%, #00ffff 50%, #00ff00 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: titleGlow 4s ease infinite;
        }
        
        @keyframes titleGlow {
            0%, 100% { text-shadow: 0 0 10px rgba(255, 0, 255, 0.7), 0 0 20px rgba(0, 255, 255, 0.5); }
            50% { text-shadow: 0 0 15px rgba(0, 255, 255, 0.7), 0 0 30px rgba(255, 0, 255, 0.5); }
        }
        
        .ticket-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 30px;
            max-width: 1600px;
            margin: 0 auto;
        }
        
        .ticket-card {
            position: relative;
            width: 300px;
            height: 200px;
            background: rgba(20, 20, 20, 0.6);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            border: 2px solid transparent;
            transition: transform 0.4s ease;
        }
        
        .ticket-card::before {
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
            0% { background-position: 0% 0%; }
            100% { background-position: 300% 0%; }
        }
        
        .ticket-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: brightness(0.7);
            display: block;
        }
        
        .ticket-img-fallback {
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, #333, #555);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #cccccc;
            font-size: 0.9rem;
            text-align: center;
            filter: brightness(0.7);
        }
        
        .ticket-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.7));
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 15px;
            text-align: center;
        }
        
        .ticket-title {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 6px;
            color: #fff;
            text-shadow: 0 0 5px rgba(0, 255, 255, 0.7);
        }
        
        .ticket-info {
            opacity: 1;
            max-height: none;
            font-size: 0.8rem;
            color: #cccccc;
        }
        
        .ticket-info p {
            margin: 3px 0;
            line-height: 1.2;
        }
        
        .ticket-info p strong {
            color: #00ffff;
            font-weight: 500;
        }
        
        .download-btn {
            background: linear-gradient(90deg, #ff00ff, #00ffff);
            color: #000;
            border: none;
            padding: 6px 14px;
            border-radius: 25px;
            font-family: 'Orbitron', sans-serif;
            font-weight: 700;
            cursor: pointer;
            margin-top: 8px;
            text-transform: uppercase;
            font-size: 0.75rem;
            display: inline-block;
            text-align: center;
            text-decoration: none;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }
        
        .download-btn:hover {
            box-shadow: 0 0 15px rgba(0, 255, 255, 0.8);
            transform: scale(1.05);
        }
        
        .ticket-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.5);
        }
        
        .ticket-card:hover .ticket-img,
        .ticket-card:hover .ticket-img-fallback {
            filter: brightness(0.5);
        }
        
        .ticket-card:hover .ticket-overlay {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.8));
        }
        
        /* Media queries for responsiveness */
        @media screen and (max-width: 768px) {
            .ticket-grid {
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
                gap: 20px;
                padding: 0 10px;
            }
            
            .page-title {
                font-size: 2rem;
            }
            
            .ticket-card {
                width: 280px;
                height: 180px;
            }
            
            .ticket-title {
                font-size: 1.1rem;
            }
            
            .ticket-info {
                font-size: 0.75rem;
            }
        }
        
        @media screen and (max-width: 480px) {
            .ticket-grid {
                grid-template-columns: 1fr;
            }
            
            .page-title {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>
    <h1 class="page-title">Vos Tickets</h1>
    <div class="ticket-grid">
        <?php
        require_once('controller/commande/selectById.php');
        
        if (!empty($selectAllCommandesById)) {
            foreach ($selectAllCommandesById as $uneCommande) {
                // Check if the image file exists
                $imagePath = 'img/ticket-bg.jpg'; // Adjust the path based on your directory structure
                $imageExists = file_exists($imagePath);
                
                echo "<div class='ticket-card' id='ticket-" . htmlspecialchars($uneCommande['idCommande']) . "'>";
                if ($imageExists) {
                    echo "<img src='$imagePath' alt='Ticket Background' class='ticket-img' onload='this.dataset.loaded = true'>";
                } else {
                    echo "<div class='ticket-img-fallback'></div>";
                }
                echo "<div class='ticket-overlay'>";
                echo "<h2 class='ticket-title'>" . htmlspecialchars($uneCommande['nomEvent']) . "</h2>";
                echo "<div class='ticket-info'>";
                echo "<p><strong>Client :</strong> " . htmlspecialchars($uneCommande['nom']) . "</p>";
                echo "<p><strong>Prix :</strong> " . htmlspecialchars($uneCommande['prixBillet']) . " €</p>";
                // Add additional event details if available
                if (!empty($uneCommande['dateEvent'])) {
                    echo "<p><strong>Date :</strong> " . htmlspecialchars($uneCommande['dateEvent']) . "</p>";
                }
                if (!empty($uneCommande['Heure'])) {
                    echo "<p><strong>Heure :</strong> " . htmlspecialchars($uneCommande['Heure']) . "</p>";
                }
                if (!empty($uneCommande['nomCategorie'])) {
                    echo "<p><strong>Catégorie :</strong> " . htmlspecialchars($uneCommande['nomCategorie']) . "</p>";
                }
                if (!empty($uneCommande['nomLieu'])) {
                    echo "<p><strong>Lieu :</strong> " . htmlspecialchars($uneCommande['nomLieu']) . "</p>";
                }
                echo "<button class='download-btn' onclick='downloadTicket(\"ticket-" . htmlspecialchars($uneCommande['idCommande']) . "\")'>Télécharger</button>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p class='ticket-title'>Aucune commande trouvée</p>";
        }
        ?>
    </div>
    <br/><br/><br/><br/><br/><br/><br/><br/>

    <script>
        function downloadTicket(ticketId) {
            const ticket = document.getElementById(ticketId);
            const img = ticket.querySelector('.ticket-img');
            
            // Function to capture the ticket
            const captureTicket = () => {
                html2canvas(ticket, {
                    scale: 2,
                    useCORS: true,
                    backgroundColor: null,
                    logging: false,
                    windowWidth: ticket.offsetWidth,
                    windowHeight: ticket.offsetHeight
                }).then(canvas => {
                    const imgData = canvas.toDataURL('image/png', 1.0);
                    const { jsPDF } = window.jspdf;
                    const pdf = new jsPDF({
                        orientation: 'landscape',
                        unit: 'mm',
                        format: [100, 60]
                    });
                    pdf.addImage(imgData, 'PNG', 5, 5, 90, 50);
                    pdf.save(`ticket-${ticketId}.pdf`);
                }).catch(error => {
                    console.error('Error capturing ticket:', error);
                    alert('Une erreur est survenue lors de la capture du ticket.');
                });
            };
            
            // Check if image is loaded
            if (img && !img.dataset.loaded) {
                img.addEventListener('load', captureTicket);
                img.addEventListener('error', () => {
                    console.warn('Image failed to load, proceeding with capture.');
                    captureTicket();
                });
            } else {
                captureTicket();
            }
        }
    </script>
</body>
</html>



<footer>
    <div class="footer-container">
        <div class="footer-section about">
            <h2>À propos d'EGW</h2>
            <h4>Esport Gaming World (EGW) est une plateforme dédiée aux passionnés de jeux vidéo et aux compétitions eSports. Rejoignez-nous pour les dernières nouvelles, tournois et événements.</h4>
        </div>
        <div class="footer-section links">
            <h2>Liens Utiles</h2>
            <ul>
                <li><a href="index.php?page=1">Accueil</a></li>
                <li><a href="index.php?page=2">Tournois</a></li>
            <ul>
                <?php if (isset($_SESSION['email'])): ?>
                    <li><a href="index.php?page=3">Réservation</a></li>
                    <li><a href="index.php?page=4">Lieu</a></li>
                <?php else: ?>
                    <li><a href="index.php?page=9">Réservation</a></li>
                    <li><a href="index.php?page=9">Lieu</a></li>
                <?php endif; ?>
            </ul>
        </div>
        <div class="footer-section contact">
            <h2>Contactez-nous</h2>
            <ul>
                <li>Email: <a href="mailto:contact@egw.com">contact@egw.com</a></li>
                <li>Téléphone: <a href="tel:+33123456789">+33 1 23 45 67 89</a></li>
                <li>Adresse: 123 Rue de Gaming, 75000 Paris, France</li>
            </ul>
        </div>
        <div class="footer-section social">
            <h2>Suivez-nous</h2>
                <div class="social-icons">
                    <a href="https://www.facebook.com/groups/esptoday" aria-label="Facebook"><i class="fa-brands fa-facebook"></i></a>
                    <a href="https://x.com/i/flow/login?redirect_after_login=%2FEgamersworld" aria-label="Twitter"><i class="fa-brands fa-twitter"></i></a>
                    <a href="https://www.instagram.com/egamersworld_com/" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                </div>
        </div>
        
    </div>
    <div class="footer-bottom">
        <p>&copy;2024 EGW. Tous droits réservés.</p>
    </div>
</footer>
</body>
</html>

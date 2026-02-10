<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style-footer.css">
    <title>Footer - KINO67</title>
</head>
<body>
    <footer class="footer" id="footer">
        <div class="footer-container">

            <div class="footer-section">
                <a href="index.php" class="footer-logo">KINO<span>67</span></a>
                <p class="footer-description">
                    Najlepsze kino w mieście! Oferujemy najnowsze hity filmowe, wygodne fotele 
                    oraz niezapomniane wrażenia kinowe. Do zobaczenia na seansie!
                </p>
                <div class="social-icons">
                    <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-youtube"></i></a>
                </div>
            </div>

            <div class="footer-section">
                <h3 class="footer-heading">Szybkie linki</h3>
                <ul class="footer-links">
                    <li><a href="index.php"><i class="fas fa-chevron-right"></i> Strona główna</a></li>
                    <li><a href="movies.php"><i class="fas fa-chevron-right"></i> Repertuar</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h3 class="footer-heading">Kontakt</h3>
                <div class="contact-info">
                    <p><i class="fas fa-map-marker-alt"></i> ul. Filmowa 67, 00-001 Warszawa</p>
                    <p><i class="fas fa-phone"></i> +48 123 456 789</p>
                    <p><i class="fas fa-envelope"></i> info@kino67.pl</p>
                    <p><i class="fas fa-clock"></i> Otwarte: 10:00 - 24:00</p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
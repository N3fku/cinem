<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinema</title>
    <link rel="stylesheet" href="style-index.css">
</head>
<body>
    <?php 
    include 'header.php'; 
    ?>

    <section class="hero">
        <h1>Doświadcz Magii Kina</h1>
        <p>Najnowsze premiery, komfortowe sale i niezapomniane wrażenia. Zarezerwuj bilety online już teraz!</p>
        <a href="movies.php" class="btn btn-primary">Zobacz repertuar</a>
    </section>

    <section class="movies-carousel-section">
        <div class="container">
            <h2>Najnowsze premiery</h2>
            <p>Obejrzyj zwiastuny i zarezerwuj bilety już teraz!</p>
            
            <?php
            // Połączenie z bazą danych
            include 'conn.php';
            
            // Pobierz filmy z bazy danych
            $sql = "SELECT tytul, zdjecie, opis FROM filmy ORDER BY id_filmu DESC LIMIT 10";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0): ?>
                <div class="carousel-container">
                    <div class="carousel-track" id="movieCarousel">
                        <?php 
                        // Pętla przez filmy - dodajemy podwójnie dla płynnego przejścia
                        $movies = [];
                        while($row = $result->fetch_assoc()) {
                            $movies[] = $row;
                        }
                        
                        // Dodajemy filmy dwa razy dla płynnego przejścia
                        for ($i = 0; $i < 2; $i++):
                            foreach($movies as $movie): 
                        ?>
                            <div class="carousel-slide">
                                <div class="movie-card">
                                    <?php if(!empty($movie['zdjecie'])): ?>
                                        <img src="<?php echo htmlspecialchars($movie['zdjecie']); ?>" 
                                             alt="<?php echo htmlspecialchars($movie['tytul']); ?>" 
                                             class="movie-image">
                                    <?php else: ?>
                                        <div class="movie-image placeholder">Brak zdjęcia</div>
                                    <?php endif; ?>
                                    <div class="movie-info">
                                        <h3><?php echo htmlspecialchars($movie['tytul']); ?></h3>
                                        <p class="movie-description"><?php 
                                            echo strlen($movie['opis']) > 100 
                                                ? substr($movie['opis'], 0, 100) . '...' 
                                                : $movie['opis']; 
                                        ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php 
                            endforeach;
                        endfor; 
                        ?>
                    </div>
                    
                    <div class="carousel-controls">
                        <button class="carousel-btn prev-btn" onclick="moveCarousel(1)">‹</button>
                        <button class="carousel-btn next-btn" onclick="moveCarousel(-1)">›</button>
                    </div>
                </div>
            <?php else: ?>
                <p class="no-movies">Brak filmów do wyświetlenia</p>
            <?php endif; 
            $conn->close();
            ?>
        </div>
    </section>

    <script>
        // Skrypt dla karuzeli
        let currentPosition = 0;
        let slideWidth = 320; // Szerokość jednego slajdu + margines
        let autoScrollInterval;
        const carouselTrack = document.getElementById('movieCarousel');
        
        function moveCarousel(direction) {
            // Zatrzymaj autoscroll podczas manualnego użytkowania
            stopAutoScroll();
            
            // Oblicz maksymalną pozycję
            const maxPosition = -slideWidth * (carouselTrack.children.length / 2);
            
            // Aktualizuj pozycję
            currentPosition += direction * slideWidth;
            
            // Jeśli doszliśmy do końca, wróć na początek
            if (currentPosition > 0) {
                currentPosition = maxPosition;
            }
            
            // Jeśli cofnęliśmy się za początek, idź do końca
            if (currentPosition < maxPosition) {
                currentPosition = 0;
            }
            
            // Zastosuj transformację
            carouselTrack.style.transform = `translateX(${currentPosition}px)`;
            
            // Wznów autoscroll po 5 sekundach
            setTimeout(startAutoScroll, 5000);
        }
        
        function startAutoScroll() {
            if (autoScrollInterval) clearInterval(autoScrollInterval);
            autoScrollInterval = setInterval(() => {
                moveCarousel(-1);
            }, 3000); // Przesuń co 3 sekundy
        }
        
        function stopAutoScroll() {
            if (autoScrollInterval) {
                clearInterval(autoScrollInterval);
                autoScrollInterval = null;
            }
        }
        
        // Rozpocznij autoscroll po załadowaniu strony
        document.addEventListener('DOMContentLoaded', () => {
            startAutoScroll();
            
            // Zatrzymaj autoscroll przy najechaniu myszką
            carouselTrack.addEventListener('mouseenter', stopAutoScroll);
            carouselTrack.addEventListener('mouseleave', startAutoScroll);
        });
    </script>
</body>
</html>
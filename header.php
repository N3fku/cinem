<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style-header.css">
    <title>header</title>
</head>
<body>
     <div class="container">
        <nav>
            <a href="index.php" class="logo">KINO<span>67</span></a>
            <ul class="nav-links">
                <li><a href="index.php"><i class="fas fa-home"></i> Strona główna</a></li>
                <li><a href="movies.php"><i class="fas fa-film"></i> Repertuar</a></li>
                
        
                <?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
                <li><a href="my_reservations.php"><i class="fas fa-calendar-check"></i> Moje rezerwacje</a></li>
                <?php endif; ?>
                
                <?php if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1): ?>
                <li><a href="admin.php"><i class="fas fa-cog"></i> Panel admina</a></li>
                <?php endif; ?>
                
                <li><a href="#kontakt"><i class="fas fa-phone"></i> Kontakt</a></li>
            </ul>
      <div class="auth-buttons">
    <?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
        <span class="">
            <i class=""></i> 
            <?php echo htmlspecialchars($_SESSION['username']); ?>
        </span>
        <a href="logout.php" class="">
            <i class=""></i> Wyloguj
        </a>
    <?php else: ?>
        <a href="login.php" class="">
            <i class=""></i> Zaloguj
        </a>
        <a href="register.php" class="">
            <i class=""></i> Zarejestruj
        </a>
    <?php endif; ?>
</div>
            </div>
        </nav>
    </div>
</body>
</html>
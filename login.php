<?php 
session_start();
include 'conn.php';

if (isset($_SESSION["logged_in"]) && $_SESSION['logged_in'] === true) {
    if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
        header("Location: admin.php");
    } else {
        header("Location: index.php");
    }
    exit;
}

$error = "";
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    $sql = "SELECT * FROM `users` WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        if(password_verify($password, $user["password"])) {
            $_SESSION["logged_in"] = true;
            $_SESSION["username"] = $user['username'];
            $_SESSION["user_id"] = $user['id'];
            $_SESSION["email"] = $user['email'];
            $_SESSION["admin"] = $user['admin'];
            
            
            if($user["admin"] == 1) {
                header("Location: admin.php");
            } else {
                header("Location: index.php");
            }
            exit;
        } else {
            $error = "Hasło niepoprawne";
        }
    } else {
        $error = "Nie znaleziono użytkownika o podanej nazwie";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie - Kino 67ent</title>
    <link rel="stylesheet" href="style-login.css">
</head>
<body>
    <?php 
    include 'header.php'; 
    ?>

        <div class="auth-container">
        <div class="auth-card">
            <h1><i class="fas fa-sign-in-alt"></i> Logowanie</h1>
            
            <?php if(!empty($error)): ?>
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
                </div>
            <?php endif; ?>
            
            <form action="" method="POST">
                <div class="form-group">
                    <label for="username"><i class="fas fa-user"></i> Nazwa użytkownika</label>
                    <input type="text" name="username" id="username" required>
                </div>
                
                <div class="form-group">
                    <label for="password"><i class="fas fa-lock"></i> Hasło</label>
                    <input type="password" name="password" id="password" required>
                </div>
                
                <button type="submit" class="btn btn-primary" style="width: 100%; padding: 0.9rem;">
                    <i class="fas fa-sign-in-alt"></i> Zaloguj się
                </button>
            </form>
            
            <div class="auth-links">
                <p>Nie masz konta? <a href="register.php">Zarejestruj się</a></p>
                <p><a href="index.php"><i class="fas fa-arrow-left"></i> Powrót do strony głównej</a></p>
            </div>
        </div>
    </div>
</body>
</html>
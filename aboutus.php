<?php
session_start();
include 'db_connect.php';


if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Review</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .logo {
            max-width: 100px;
            height: auto;
        }
    </style>

<header class="header p-3 d-flex justify-content-between align-items-center">
        <a href="index.php"><img src="logoPixelrated.png" alt="Logo" class="logo"></a>

        

        <div class="header-icons">
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="logout.php" class="btn btn-outline-light btn-sm">Logout </a>
                <a href="favourite_games.php" class="text-white mr-3">&nbsp;Favourite Games</a>
            <?php else: ?>
        <a href="LOGINPAGE.php" class="text-white mr-3"><i class="fa fa-user-circle fa-2x">Login</i></a>
                
            <?php endif; ?>
        </div>
    </header>
<div class="about-us container text-center">
    <h1>About Us</h1>
    <p>Welcome to PixelRated, your ultimate gaming hub for reviews and recommendations.</p>
    <h2>Our Mission</h2>
    <p>To empower gamers with a reliable platform for sharing insights and making informed choices.</p>
    <h2>Our Story</h2>
    <p>PixelRated began as a small project among friends who loved gaming. Today, it’s a trusted platform for gamers worldwide.</p>
    <h2>Meet the Team</h2>
    <p>We’re a group of passionate gamers and developers committed to creating the best experience for you.</p>
    <h2>Contact Us</h2>
    <p>Email: support@pixelrated.com</p>
   
</div>

<footer class="footer py-3 text-center">
        <div class="social-icons d-inline-block mx-3">
            <a href="#" class="text-dark"><i class="fa fa-facebook"></i></a>
            <span>|</span>
            <a href="#" class="text-dark"><i class="fa fa-instagram"></i></a>
        </div>
        <a href="createpage.php" class="footer-link mx-3">Sign up</a>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

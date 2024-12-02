<?php
session_start();
include 'db_connect.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Please log in to view your favorite games.");
}

$user_id = $_SESSION['user_id'];

// Fetch favorite games
$fav_games_query = $conn->prepare("
    SELECT g.* 
    FROM favourites f 
    JOIN games g ON f.game_id = g.id 
    WHERE f.user_id = ?
");
$fav_games_query->bind_param("i", $user_id);
$fav_games_query->execute();
$fav_games_result = $fav_games_query->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Favourite Games</title>
    <link rel="stylesheet" href="styles.css?v=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<style >
.logo {
    width: 100px; 
    height: auto; 
    max-width: 100%; 
    display: block; 
}
</style>
<body>
    <!-- Header -->
    <header class="header p-3 d-flex justify-content-between align-items-center">
        <a href="index.php" class="navbar-brand text-white"><img src="logoPixelrated.png" alt="Logo" class="logo"></a>
        <div class="header-icons">
            <?php if (isset($_SESSION['user_id'])): ?>
                
            <?php else: ?>
                <a href="LOGINPAGE.php" class="text-white mr-3"><i class="fa fa-user-circle fa-2x">Login</i></a>
            <?php endif; ?>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container">
        <h2 class="text-center my-4">Your Favourite Games</h2>
        <div class="row">
            <?php if ($fav_games_result->num_rows > 0): ?>
                <?php while ($fav_game = $fav_games_result->fetch_assoc()): ?>
                    <div class="col-md-2 col-lg-2 mb-3">
                        <div class="card game-tile">
                            <a href="game.php?id=<?php echo $fav_game['id']; ?>">
                                <img src="<?php echo htmlspecialchars($fav_game['image_url']); ?>" class="card-img-top img-fluid" alt="<?php echo htmlspecialchars($fav_game['title']); ?>">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title text-center"><?php echo htmlspecialchars($fav_game['title']); ?></h5>
                                <p class="text-center">Rating: 
    <?php 
    for ($i = 1; $i <= 5; $i++) {
        echo $i <= $fav_game['rating'] ? '★' : '☆';
    }
    ?></p>
                                <a href="game.php?id=<?php echo $fav_game['id']; ?>" class="btn btn-primary btn-block">View Details</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="text-center">You have no favorite games yet. Go ahead and add some!</p>
            <?php endif; ?>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer py-3 text-center">
        <a href="aboutus.php" class="footer-link mx-3">About Us</a>
        <div class="social-icons d-inline-block">
            <a href="#" class="mx-2"><i class="fa fa-facebook"></i></a>
            <a href="#" class="mx-2"><i class="fa fa-instagram"></i></a>
        </div>
    </footer>
</body>
</html>

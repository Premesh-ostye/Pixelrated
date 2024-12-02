<?php
session_start();
include 'db_connect.php'; // Ensure this file establishes the database connection ($conn)

// Check if game ID is provided
if (!isset($_GET['id'])) {
    die("Game ID is required.");
}

$game_id = intval($_GET['id']);



// Fetch game details
$query = $conn->prepare("SELECT * FROM games WHERE id = ?");
$query->bind_param("i", $game_id);
$query->execute();
$result = $query->get_result();
$game = $result->fetch_assoc();

if (!$game) {
    die("Game not found.");
}

// Fetch reviews
$reviews_query = $conn->prepare("SELECT * FROM reviews WHERE game_id = ? ORDER BY created_at DESC");
$reviews_query->bind_param("i", $game_id);
$reviews_query->execute();
$reviews_result = $reviews_query->get_result();

// Fetch popular games
$popular_games_query = $conn->prepare("SELECT * FROM games ORDER BY rating DESC LIMIT 5");
$popular_games_query->execute();
$popular_games_result = $popular_games_query->get_result();
$is_favorite = false;
if (isset($_SESSION['user_id'])) {
    $favorite_check_query = $conn->prepare("SELECT * FROM favourites WHERE user_id = ? AND game_id = ?");
    $favorite_check_query->bind_param("ii", $_SESSION['user_id'], $game_id);
    $favorite_check_query->execute();
    $favorite_result = $favorite_check_query->get_result();
    $is_favorite = $favorite_result->num_rows > 0;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($game['title']); ?> - PixelRated</title>
    <link rel="stylesheet" href="styles.css?v=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>


    <!-- Header -->
    <header class="header p-3 d-flex justify-content-between align-items-center">
        <a href="index.php"><img src="logoPixelrated.png" alt="Logo" class="logo"></a>
        <div class="header-icons">
    <?php if (isset($_SESSION['user_id'])): ?>
        <a href="favourite_games.php" class="text-white mr-3">Favourite Games</a>
        <a href="logout.php" class="btn btn-outline-light btn-sm">Logout</a>
    <?php else: ?>
        <a href="LOGINPAGE.php" class="text-white mr-3"><i class="fa fa-user-circle fa-2x">Login</i></a>
    <?php endif; ?>
</div>
    </header>

    <!-- Main Content -->
    <main class="container">
        <!-- Game Information Section -->
        <div class="game-info d-flex align-items-center p-3">
            <span class="game-image mr-auto-2">
                <img src="<?php echo htmlspecialchars($game['image_url']); ?>" alt="<?php echo htmlspecialchars($game['title']); ?>">
    </span>
            
            <div class="game-details ml-auto">
                <h1 style="text-decoration: underline; text-align:center;">
                <?php echo htmlspecialchars($game['title']); ?></h1>
                <p style="text-decoration: ; text-align:center"><?php echo htmlspecialchars($game['description']); ?></p>
                <p>Category: <?php echo htmlspecialchars($game['category']); ?></p>
                <div class="rating">
                    <p>Rating: 
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                             <?php echo $i <= $game['rating'] ? '★' : '☆'; ?>
                        <?php endfor; ?>
                    </p>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <form action="rate_game.php" method="post">
                            <input type="hidden" name="game_id" value="<?php echo $game_id; ?>">
                            <label for="rating">Rate this game:</label>
                            <input type="number" name="rating" min="1" max="5" required>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    <?php else: ?>
                        <p><a href="LOGINPAGE.php">Log in</a> to rate this game.</p>
                    <?php endif; ?>
                </div>
                <?php if (isset($_SESSION['user_id'])): ?>
    <form action="<?php echo $is_favorite ? 'remove_favourite.php' : 'add_favourite.php'; ?>" method="post">
        <input type="hidden" name="game_id" value="<?php echo $game_id; ?>">
        <button type="submit" class="btn btn-link text-<?php echo $is_favorite ? 'secondary' : 'danger'; ?>" style="font-size: 1.5rem;">
            <i class="fa fa-heart<?php echo $is_favorite ? '-o' : ''; ?>"></i>
            <?php echo $is_favorite ? 'Remove from Favourite' : 'Add to Favourite'; ?>
        </button>
    </form>
<?php else: ?>
    <p><a href="LOGINPAGE.php" class="text-danger"><i class="fa fa-heart"></i> Log in</a> to manage your favourites.</p>
<?php endif; ?>

            </div>
        </div>

        <div class="reviews mt-5">
    <h2 class="text-center">Reviews</h2>

    <?php while ($review = $reviews_result->fetch_assoc()): ?>
        <div class="review text-center mb-4">
            <p><strong><?php echo htmlspecialchars($review['username']); ?>:</strong></p>
            <p><?php echo htmlspecialchars($review['comment']); ?></p>
            <p><small><?php echo htmlspecialchars($review['created_at']); ?></small></p>
            <hr>
        </div>
    <?php endwhile; ?>

   


    <?php if (isset($_SESSION['user_id'])): ?>
        <form action="add_review.php" method="post" class="text-center mt-4">
            <input type="hidden" name="game_id" value="<?php echo $game_id; ?>">
            <textarea name="comment" placeholder="Add a comment" rows="4" class="form-control w-50 mx-auto mb-3" required></textarea>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    <?php else: ?>
        <p class="text-center"><a href="LOGINPAGE.php">Log in</a> to leave a review.</p>
    <?php endif; ?>
</div>



<hr>
        <!-- Popular Games Section -->
        <div class="popular-games mt-5">
            <h2>Popular Games</h2>
            <div class="row">
                <?php while ($popular_game = $popular_games_result->fetch_assoc()): ?>
                    <div class="col-md-2 col-lg-2 mb-4">
                        <div class="card">
                            <a href="game.php?id=<?php echo $popular_game['id']; ?>">
                                <img src="<?php echo htmlspecialchars($popular_game['image_url']); ?>" alt="<?php echo htmlspecialchars($popular_game['title']); ?>" class="img-fluid">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($popular_game['title']); ?></h5>
                                <p>
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                         <?php echo $i <= $popular_game['rating'] ? '★' : '☆'; ?>
                                    <?php endfor; ?>
                                </p>
                                <a href="game.php?id=<?php echo $popular_game['id']; ?>" class="btn btn-primary btn-block">View Details</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
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

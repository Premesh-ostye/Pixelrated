<?php
session_start();

// Database connection
include 'db_connect.php';



if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to display games
function display_games($conn, $category_name) {
    echo '<div class="category mb-6">';
    echo '<h2 class="text-center">' . htmlspecialchars($category_name) . '</h2>';
    echo '<div class="row">';

    $stmt = $conn->prepare("SELECT * FROM games WHERE category = ?");
    if (!$stmt) {
        die("Failed to prepare statement: " . $conn->error);
    }

    $stmt->bind_param("s", $category_name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="col-md-2 mb-3">';
            echo '<a href="game.php?id=' . htmlspecialchars($row['id']) . '" class="text-decoration-none text-reset game-link">';
            echo '<div class="card">';
            echo '<img src="' . htmlspecialchars($row['image_url']) . '" class="card-img-top img-fluid" alt="' . htmlspecialchars($row['title']) . '">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . htmlspecialchars($row['title']) . '</h5>';
            echo '<div class="rating">';
            for ($i = 0; $i < 5; $i++) {
                echo $i < $row['rating'] ? '★' : '☆';
            }
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</a>';
            echo '</div>';
        }
    } else {
        echo "<p class='col-12 text-center'>No games available in this category.</p>";
    }

    echo '</div></div><hr><hr>';
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
    <script>
        const isLoggedIn = <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>;
        function handleGameClick(gameId) {
            if (isLoggedIn) {
                window.location.href = "game.php?id=" + gameId;
            } else {
                alert("Please log in to view the game details.");
                window.location.href = "LOGINPAGE.php";
            }
        }
    </script>
</head>
<body>
    <!-- Header -->
    <header class="header p-3 d-flex justify-content-between align-items-center">
        <a href="index.php"><img src="logoPixelrated.png" alt="Logo" class="logo"></a>

        <!-- Search and Filter Form -->
        <form class="form-inline mx-auto" action="index.php" method="GET">
            <input class="form-control mr-sm-1" type="search" placeholder="Search" aria-label="Search" name="query">
            <button class="btn btn-outline-light my-2 my-sm-0" type="submit"><i class="fa fa-search"></i></button>
            <div class="ml-3 d-flex align-items-center">
    <div class="dropdown">
        <button class="btn btn-outline-light dropdown-toggle" type="button" id="categoryDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Categories
        </button>
        <div class="dropdown-menu" aria-labelledby="categoryDropdown">
            <form class="px-3" method="GET" action="index.php">
                <?php
                $categories = ["Popular Games", "Featured Games", "New Releases", "Arcade Games", "PVP Games"];
                foreach ($categories as $category) {
                    $checked = isset($_GET['categories']) && in_array($category, $_GET['categories']) ? 'checked' : '';
                    echo "
                    <div class='form-check'>
                        <input class='form-check-input' type='checkbox' name='categories[]' value='" . htmlspecialchars($category) . "' $checked id='$category'>
                        <label class='form-check-label' for='$category'>
                            $category
                        </label>
                    </div>";
                }
                ?>
                <button class="btn btn-primary btn-sm mt-2" type="submit">Apply</button>
            </form>
        </div>
    </div>
</div>

                
            </div>
            
        </form>

        <div class="header-icons">
    <?php if (isset($_SESSION['user_id'])): ?>
    <a  href="favourite_games.php">Favourite Games</a>
        <div class="dropdown">
            <button class="btn btn-outline-light dropdown-toggle" type="button" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php echo htmlspecialchars($_SESSION['firstname']); ?>'s
                Account
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                
                <a class="dropdown-item text-dark" href="change_password.php">Change Password</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-danger" href="logout.php">Logout</a>
            </div>
        </div>
    <?php else: ?>
        <a href="LOGINPAGE.php" class="text-white mr-3"><i class="fa fa-user-circle fa-2x">Login</i></a>
    <?php endif; ?>
</div>

    </header>

    <main class="container">
        <!-- Banner -->
        <div class="winning-banner text-center mb-5">
            <img src="Banner.png" alt="You Win Banner" class="img-fluid">
        </div>

        <!-- Search Results -->
        <?php
        if (isset($_GET['query']) && !empty(trim($_GET['query']))) {
            $search_query = '%' . trim($_GET['query']) . '%';

            echo '<div class="category mb-6">';
            echo '<h2 class="text-center">Search Results</h2>';
            echo '<div class="row">';

            $stmt = $conn->prepare("SELECT * FROM games WHERE title LIKE ? OR category LIKE ?");
            if (!$stmt) {
                die("Failed to prepare statement: " . $conn->error);
            }

            $stmt->bind_param("ss", $search_query, $search_query);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-md-2 mb-3">';
                    echo '<a href="game.php?id=' . htmlspecialchars($row['id']) . '" class="text-decoration-none text-reset game-link">';
                    echo '<div class="card">';
                    echo '<img src="' . htmlspecialchars($row['image_url']) . '" class="card-img-top img-fluid" alt="' . htmlspecialchars($row['title']) . '">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . htmlspecialchars($row['title']) . '</h5>';
                    echo '<div class="rating">';
                    for ($i = 0; $i < 5; $i++) {
                        echo $i < $row['rating'] ? '★' : '☆';
                    }
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</a>';
                    echo '</div>';
                }
            } else {
                echo "<p class='col-12 text-center'>No games match your Keyword.</p>";
            }

            echo '</div><hr></div>';
        } else {
            // Filtered Game Display
            if (isset($_GET['categories']) && !empty($_GET['categories'])) {
                $allowed_categories = ["Popular Games", "Featured Games", "New Releases", "Arcade Games", "PVP Games"];
                foreach ($_GET['categories'] as $category) {
                    if (in_array($category, $allowed_categories)) {
                        display_games($conn, htmlspecialchars($category));
                    }
                }
            } else {
                display_games($conn, "Popular Games");
                display_games($conn, "Featured Games");
                display_games($conn, "New Releases");
                display_games($conn, "Arcade Games");
                display_games($conn, "PVP Games");
            }
        }

        $conn->close();
        ?>
    </main>

    <!-- Footer -->
    <footer class="footer py-3 text-center">
        <a href="aboutus.php" class="footer-link mx-3">About us</a>
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

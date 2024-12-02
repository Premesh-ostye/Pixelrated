<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to leave a review.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $game_id = intval($_POST['game_id']);
    $user_id = $_SESSION['user_id'];
    $firstname = $_SESSION['firstname'] ?? 'Anonymous'; 
    $lastname = $_SESSION['lastname'] ?? '';            
    $comment = htmlspecialchars($_POST['comment'], ENT_QUOTES, 'UTF-8');

    $full_name = trim("$firstname $lastname");

    $stmt = $conn->prepare("INSERT INTO reviews (game_id, user_id, username, comment) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $game_id, $user_id, $full_name, $comment);

    if ($stmt->execute()) {
        header("Location: game.php?id=$game_id");
        exit();
    } else {
        die("Error adding review: " . $stmt->error);
    }
}
?>

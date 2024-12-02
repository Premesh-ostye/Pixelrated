<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to rate a game.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $game_id = intval($_POST['game_id']);
    $rating = floatval($_POST['rating']);

    if ($rating < 1 || $rating > 5) {
        die("Invalid rating.");
    }

    $query = $conn->prepare("INSERT INTO ratings (game_id, user_id, rating) VALUES (?, ?, ?)
        ON DUPLICATE KEY UPDATE rating = VALUES(rating)");
    $query->bind_param("iid", $game_id, $_SESSION['user_id'], $rating);
    $query->execute();

    // Update average rating in games table
    $update_query = $conn->prepare("
        UPDATE games 
        SET rating = (SELECT AVG(rating) FROM ratings WHERE game_id = ?)
        WHERE id = ?");
    $update_query->bind_param("ii", $game_id, $game_id);
    $update_query->execute();

    header("Location: game.php?id=$game_id");
    exit();
}
?>

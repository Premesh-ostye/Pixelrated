<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to add a game to your favourites.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $game_id = intval($_POST['game_id']);

    $query = $conn->prepare("INSERT INTO favourites (user_id, game_id) VALUES (?, ?)");
    $query->bind_param("ii", $_SESSION['user_id'], $game_id);
    $query->execute();

    header("Location: game.php?id=$game_id");
    exit();
}
?>
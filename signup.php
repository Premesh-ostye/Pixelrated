<?php

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "mydatabase"; 


$conn = new mysqli("sql310.infinityfree.com", "if0_37807076", "y9LWy5cmE2QLAyg", "if0_37807076_mydatabase");



if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $firstname = $conn->real_escape_string($_POST['firstname']);
    $lastname = $conn->real_escape_string($_POST['lastname']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

   
    if ($password !== $confirm_password) {
        echo "Passwords do not match.";
        exit;
    }

    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    
    $sql = "INSERT INTO users (firstname, lastname, email, password) VALUES ('$firstname', '$lastname', '$email', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        echo "New account created successfully!";
        header("Location: LOGINPAGE.php"); 
        exit;
    } else {
        if ($conn->errno === 1062) {
            echo "This email is already registered.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}


$conn->close();
?>

<?php

$servername = "localhost"; 
$username = "root";        
$password = "";            
$dbname = "mydatabase";    

$conn = new mysqli("localhost", "root", "", "mydatabase");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8");
?>
<?php


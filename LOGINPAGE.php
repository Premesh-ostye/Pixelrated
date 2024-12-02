<!DOCTYPE html>

<html lang="en">
     
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Review</title>
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
    <!-- PHP -->
    <?php


session_start();

include 'db_connect.php';
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['firstname'] = $row['firstname'];
            header("Location: index.php"); 
            exit;
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No account found with that email.";
    }
}

$conn->close();
?>


<!-- PHP End -->

    <header class="header  p-3 d-flex justify-content-between align-items-center">
        <a href="index.php" class="navbar-brand text-white"><img src="logoPixelrated.png" alt="logo" class="logo"></a>
      
        <div class="header-icons">
          
        </div>
    </header>

    
    <main class="container my-5">
       
        <div class="text-center mb-4">
            <img src="Banner.png" alt="You Win Banner" class="img-fluid">
        </div>

       
        <div class="row justify-content-center">
            
            <div class="col-md-4 text-center mb-4">
                <img src="left.png" alt="Left" class="img-fluid">
            </div>

            
            <div class="col-md-4">
                <div class=" card p-4">
                    <h2 class="text-center">Login Here</h2>
                    <form action="LOGINPAGE.php" method="POST">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Continue</button>
                    </form>
                    <p class="text-center mt-4">Don’t have an account? <a href="createpage.php">Sign up here</a></p>
                    <div style="text-align: right;">&copy;Premesh</div></div>
                </div>
            </div>
        </div>
    </main>

    
    <footer class="footer  py-3 text-center text-white">
        <a href="aboutus.php" class="footer-link text-white mx-3">About us</a>
        <div class="social-icons d-inline-block mx-3">
            <a href="#" class="text-white"><i class="fa fa-facebook"></i></a>
            <span class="mx-2">|</span>
            <a href="#" class="text-white"><i class="fa fa-instagram"></i></a>
        </div>
        <a href="createpage.php" class=" mb-2">Sign Up</a>
    </footer>

   
</body>
</html>
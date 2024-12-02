<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link rel="stylesheet" href="styles.css?v=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    
    <?php
    include 'db_connect.php';
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

<!-- PHP End -->

    <!-- Header Section -->
    <header class="header text-white d-flex justify-content-between align-items-center p-3">
        <div class="logo font-weight-bold"><a href="index.php" class="text-white"><img src="logoPixelrated.png" alt="logo" class="logo"></a></div>
        <div class="header-icons">
        </div>
    </header>
    <style >
.logo {
    width: 100px; 
    height: auto; 
    max-width: 100%; 
    display: block; 
}
</style>

    <!-- Main Content -->
    <main class="container my-5">
        <div class="text-center mb-4">
            <!-- Banner -->
            <div class="winning-banner">
                <img src="banner2.png" alt="You Win Banner" class="img-fluid">
            </div>
        </div>
        
        <!-- Sign-Up Section -->
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-4">
                    <h2 class="text-center">Create a New Account</h2>
                    <form action="createpage.php" method="POST">
                        <div class="form-group">
                            <label for="Firstname">First Name</label>
                            <input type="text" id="Firstname" name="firstname" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="Lastname">Last Name</label>
                            <input type="text" id="Lastname" name="lastname" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="ConfirmPassword">Confirm Password</label>
                            <input type="password" id="ConfirmPassword" name="confirm_password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Continue</button>
                    </form>
                    <p class="text-center mt-3">Already have an account? <a href="LOGINPAGE.php">Login here</a></p>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer Section -->
    <footer class="footer text-white py-3 text-center">
        <a href="aboutus.php" class="footer-link text-white mx-3">About us</a>
        <div class="social-icons d-inline-block mx-3">
            <a href="#" class="text-white mr-2"><i class="fa fa-facebook fa-lg"></i></a>
            <span>|</span>
            <a href="#" class="text-white ml-2"><i class="fa fa-instagram fa-lg"></i></a>
        </div>
        <a href="createpage.php" class="footer-link text-white mx-3">Sign up</a>
    </footer>

    <!-- Bootstrap and Font Awesome -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

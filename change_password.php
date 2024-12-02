<?php
session_start();

// Include database connection
include 'db_connect.php';

// Handle Change Password Logic
if (isset($_POST['change_password'])) {
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Ensure user is logged in
    if (!isset($_SESSION['user_id'])) {
        echo "<p class='text-danger text-center'>You must be logged in to change your password.</p>";
        return;
    }

    $user_id = $_SESSION['user_id'];

    // Fetch current password hash from database
    $stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $current_hashed_password = $row['password'];

        // Verify old password
        if (password_verify($old_password, $current_hashed_password)) {
            // Check if new password matches confirmation
            if ($new_password === $confirm_password) {
                // Hash the new password
                $new_hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

                // Update password in the database
                $update_stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
                $update_stmt->bind_param("si", $new_hashed_password, $user_id);

                if ($update_stmt->execute()) {
                    echo "<p class='text-success text-center'>Password successfully changed!</p>";
                } else {
                    echo "<p class='text-danger text-center'>Error updating password. Please try again later.</p>";
                }

                $update_stmt->close();
            } else {
                echo "<p class='text-danger text-center'>New password and confirm password do not match.</p>";
            }
        } else {
            echo "<p class='text-danger text-center'>Old password is incorrect.</p>";
        }
    } else {
        echo "<p class='text-danger text-center'>User not found.</p>";
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .change-password {
            max-width: 500px;
            margin: 50px auto;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<header class="header  p-3 d-flex justify-content-between align-items-center">
        <a href="index.php" class="navbar-brand text-white"><img src="logoPixelrated.png" alt="logo" class="logo"></a>
      
       
    </header>
      <?php if (isset($_SESSION['user_id'])): ?>
                
                       <h3 class="text-center">Welcome! <?php echo htmlspecialchars($_SESSION['firstname']); ?>, You can change your password here</h3>

                       
            <?php endif; ?>
<body>
<div class="winning-banner">
                <img src="banner2.png" alt="You Win Banner" class="img-fluid">
            </div>
        </div>
    <div class="change-password">
        <h3 class="text-center">Change Password</h3>
        <form method="POST" action="">
            <div class="form-group">
                <label for="old_password">Old Password</label>
                <input type="password" class="form-control" id="old_password" name="old_password" required>
            </div>
            <div class="form-group">
                <label for="new_password">New Password</label>
                <input type="password" class="form-control" id="new_password" name="new_password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm New Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" name="change_password" class="btn btn-primary btn-block">Change Password</button>
        </form>
        <a href="index.php" class="btn btn-secondary btn-block mt-3">Go Back</a>
    </div>
    <footer class="footer  py-3 text-center text-white">
        <a href="aboutus.php" class="footer-link text-white mx-3">About us</a>
        <div class="social-icons d-inline-block mx-3">
            <a href="#" class="text-white"><i class="fa fa-facebook"></i></a>
            <span class="mx-2">|</span>
            <a href="#" class="text-white"><i class="fa fa-instagram"></i></a>
        </div>
    </footer>
</body>
</html>
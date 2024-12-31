<?php
require 'dbconnect.php'; // Include the database connection file

session_start(); // Start the session to manage logged-in state

// Initialize variables
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($databaseConnection, $_POST['username']);
    $password = mysqli_real_escape_string($databaseConnection, $_POST['password']);

    // Validate input
    if (!empty($username) && !empty($password)) {
        // Query to check the username and password
        $sql = "SELECT * FROM AdminUsers WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($databaseConnection, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            // Login successful, set session variables
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $username;

            // Redirect to the dashboard
            header('Location: Dashboard.php');
            exit();
        } else {
            // Login failed
            $error = 'Invalid username or password.';
        }
    } else {
        $error = 'All fields are required.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- Login Form -->
    <div class="container mt-5">
        <h2 class="text-center">Admin Login</h2>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form action="Login.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>

    <!-- Footer -->
    <footer class="text-center mt-5 py-3 bg-dark text-white">
        All rights reserved by CSE, RUET @2024
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

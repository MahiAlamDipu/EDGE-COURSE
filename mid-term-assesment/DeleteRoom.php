<?php
require 'dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $id = $_POST['deleteRoomId'];

    if (!empty($id)) {
        

        $sql = "DELETE FROM Rooms WHERE id = '$id'";

        
        if (mysqli_query($databaseConnection, $sql)) {
            echo "<script>alert('Room deleted successfully!');</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($databaseConnection) . "');</script>";
        }
    } else {
        echo "<script>alert('Room ID is required for deletion!');</script>";
    }

    mysqli_close($databaseConnection);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Room</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="Dashboard.php">Hotel Admin Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="Dashboard.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="AddRoom.php">Add Room</a></li>
                    <li class="nav-item"><a class="nav-link" href="UpdateRoom.php">Update Room</a></li>
                    <li class="nav-item"><a class="nav-link active" href="DeleteRoom.php">Delete Room</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Delete Room Page -->
    <div class="container mt-5">
        <h2>Delete Room</h2>
        <form action="DeleteRoom.php" method="POST">
            <div class="mb-3">
                <label for="deleteRoomId" class="form-label">Room ID</label>
                <input type="text" class="form-control" id="deleteRoomId" name="deleteRoomId" placeholder="Enter room ID to delete" required>
            </div>
            <button type="submit" class="btn btn-danger">Delete Room</button>
        </form>
    </div>

    <!-- Footer -->
    <footer class="text-center mt-5 py-3 bg-dark text-white">
        All rights reserved by CSE, RUET @2024
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

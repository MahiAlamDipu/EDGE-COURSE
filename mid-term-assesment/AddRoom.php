<?php
require 'dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $type = $_POST['roomtype'];
    $price = $_POST['price'];
    $status = $_POST['status'];

    // Prepare the SQL query
    $sql = "INSERT INTO Rooms ( type, price, status) 
            VALUES ('$type', '$price', '$status')";

    // Execute the query and handle the response
    if (mysqli_query($databaseConnection, $sql)) {
        echo "<script>alert('Room added successfully!');</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($databaseConnection) . "');</script>";
    }

    // Close the database connection
    mysqli_close($databaseConnection);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Room</title>
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
                    <li class="nav-item"><a class="nav-link active" href="AddRoom.php">Add Room</a></li>
                    <li class="nav-item"><a class="nav-link" href="UpdateRoom.php">Update Room</a></li>
                    <li class="nav-item"><a class="nav-link" href="DeleteRoom.php">Delete Room</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Add Room Form -->
    <div class="container mt-5">
        <h2>Add Room</h2>
        <form action="AddRoom.php" method="POST">
            
            <div class="mb-3">
                <label for="roomtype" class="form-label">Room Type</label>
                <input type="text" class="form-control" id="roomtype" name="roomtype" placeholder="Enter room type" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" name="price" placeholder="Enter room price" step="0.01" required>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status" required>
                    <option value="Available">Available</option>
                    <option value="Occupied">Occupied</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Add Room</button>
        </form>
    </div>

    <!-- Footer -->
    <footer class="text-center mt-5 py-3 bg-dark text-white">
        All rights reserved by CSE, RUET @2024
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

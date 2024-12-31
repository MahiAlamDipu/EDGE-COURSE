<?php
require 'dbconnect.php';

// Check for form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $roomId = $_POST['updateRoomId'];
    $roomType = $_POST['updateRoomType'];
    $roomPrice = $_POST['updateRoomPrice'];
    $roomStatus = $_POST['updateRoomStatus'];

    // Check if Room ID is provided
    if (!empty($roomId)) {
        // Build the update query dynamically
        $updates = [];
        if (!empty($roomType)) {
            $updates[] = "type = '$roomType'";
        }
        if (!empty($roomPrice)) {
            $updates[] = "price = $roomPrice";
        }
        if (!empty($roomStatus)) {
            $updates[] = "status = '$roomStatus'";
        }

        if (!empty($updates)) {
            // Combine updates into a single query
            $sql = "UPDATE Rooms SET " . implode(", ", $updates) . " WHERE id = '$roomId'";

            // Execute the query and provide feedback
            if (mysqli_query($databaseConnection, $sql)) {
                echo "<script>alert('Room updated successfully!');</script>";
            } else {
                echo "<script>alert('Error: " . mysqli_error($databaseConnection) . "');</script>";
            }
        } else {
            echo "<script>alert('No changes provided for the update!');</script>";
        }
    } else {
        echo "<script>alert('Room ID is required for updating!');</script>";
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
    <title>Update Room</title>
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
                    <li class="nav-item"><a class="nav-link active" href="UpdateRoom.php">Update Room</a></li>
                    <li class="nav-item"><a class="nav-link" href="DeleteRoom.php">Delete Room</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Update Room Page -->
    <div class="container mt-5">
        <h2>Update Room</h2>
        <form action="UpdateRoom.php" method="POST">
            <div class="mb-3">
                <label for="updateRoomId" class="form-label">Room ID</label>
                <input type="text" class="form-control" id="updateRoomId" name="updateRoomId" placeholder="Enter room ID to update" required>
            </div>
            <div class="mb-3">
                <label for="updateRoomType" class="form-label">Room Type</label>
                <input type="text" class="form-control" id="updateRoomType" name="updateRoomType" placeholder="Enter new room type">
            </div>
            <div class="mb-3">
                <label for="updateRoomPrice" class="form-label">Price</label>
                <input type="number" class="form-control" id="updateRoomPrice" name="updateRoomPrice" placeholder="Enter new price">
            </div>
            <div class="mb-3">
                <label for="updateRoomStatus" class="form-label">Status</label>
                <select class="form-select" id="updateRoomStatus" name="updateRoomStatus">
                    <option value="">Select status</option>
                    <option value="Available">Available</option>
                    <option value="Occupied">Occupied</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Room</button>
        </form>
    </div>

    <!-- Footer -->
    <footer class="text-center mt-5 py-3 bg-dark text-white">
        All rights reserved by CSE, RUET @2024
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

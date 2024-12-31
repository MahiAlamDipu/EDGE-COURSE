<?php
// Include the database connection file
require 'dbconnect.php';

// Get the room ID from the query string
$id = $_GET['id'] ?? '';

// Initialize variables to hold the room details
$type = '';
$price = '';
$status = '';

// Fetch existing room data from the database if the room ID is provided
if ($id) {
    $sql = "SELECT * FROM Rooms WHERE id = '$id'";
    $result = mysqli_query($databaseConnection, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch the room data
        $row = mysqli_fetch_assoc($result);
        $type = $row['type'];
        $price = $row['price'];
        $status = $row['status'];
    } else {
        echo "<p>Room not found.</p>";
    }
}

// Handle form submission to update the room data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['roomid'];
    $type = $_POST['roomtype'];
    $price = $_POST['price'];
    $status = $_POST['status'];

    // Update the room in the database
    $sql = "UPDATE Rooms
            SET 
            type = '$type', 
            price = '$price', 
            status = '$status'  WHERE id = '$id'";

    if (mysqli_query($databaseConnection, $sql)) {
        echo "<p>Room updated successfully!</p>";
    } else {
        echo "<p>Error: " . mysqli_error($databaseConnection) . "</p>";
    }
    mysqli_close($databaseConnection);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Room</title>
</head>

<body>
    <h1>Edit Room</h1>
    <form action="" method="POST">

        <label for='roomid'>Room ID:</label>
        <input type="number" id='roomid' name='roomid' value="<?php echo htmlspecialchars($id); ?>" readonly>
        <br><br>

        <label for="roomtype">Room Type:</label>
        <select id="roomtype" name="roomtype" required>
            <option value="Single" <?php echo ($type == 'Single') ? 'selected' : ''; ?>>Single</option>
            <option value="Double" <?php echo ($type == 'Double') ? 'selected' : ''; ?>>Double</option>
        </select>
        <br><br>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" value="<?php echo htmlspecialchars($price); ?>" step="1000" required>
        <br><br>

        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="Available" <?php echo ($status == 'Available') ? 'selected' : ''; ?>>Available</option>
            <option value="Occupied" <?php echo ($status == 'Occupied') ? 'selected' : ''; ?>>Occupied</option>
        </select>
        <br><br>

        <button type="submit">Update Room</button>
    </form>
</body>

</html>

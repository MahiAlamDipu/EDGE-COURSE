<?php

require 'dbconnect.php';


$id = '';
$type = '';
$price = '';
$status = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $id = $_POST['roomid'];
    $type = $_POST['roomtype'];
    $price = $_POST['price'];
    $status = $_POST['status'];


    $sql = "INSERT INTO Rooms (id, type, price, status) 
    VALUES ('$id', '$type', '$price', '$status')";


    if (mysqli_query($databaseConnection, $sql)) {
        echo "<p>Room added successfully!</p>";
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
    <title>Add Room</title>
</head>

<body>
    <h1>Add New Room</h1>
    <form action="" method="POST">

        <label for='roomid'>Room ID:</label>
        <input type="number" id='roomid' name='roomid' placeholder="Enter a room ID" required>
        <br><br>

        <label for="roomtype">Room Type:</label>
        <select id="roomtype" name="roomtype" required>
            <option value="Single">Single</option>
            <option value="Double">Double</option>
        </select>
        <br><br>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" placeholder="Enter room price" step="1000" required>
        <br><br>

        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="Available">Available</option>
            <option value="Occupied">Occupied</option>
        </select>
        <br><br>

        <button type="submit">Add Room</button>
    </form>
</body>

</html>

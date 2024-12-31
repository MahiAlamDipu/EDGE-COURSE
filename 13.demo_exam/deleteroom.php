<?php
// Include the database connection file
require 'dbconnect.php';

// Get the room ID from the query string
$id = $_GET['id'] ?? '';

// If ID is provided, proceed with the deletion
if ($id) {

    $sql = "DELETE FROM Rooms 
    WHERE id = '$id'";

    // Execute the query and handle errors
    if (mysqli_query($databaseConnection, $sql)) {
        // Redirect to the rooms list after deletion (or show a success message)
        echo "<p>Room deleted successfully!</p>";
        echo "<a href='dashboard.php'>Go back to the rooms list</a>";
    } else {
        echo "<p>Error: " . mysqli_error($databaseConnection) . "</p>";
    }

    // Close the database connection
    mysqli_close($databaseConnection);
} else {
    // If no room ID is provided, show an error
    echo "<p>No room ID provided for deletion.</p>";
}
?>

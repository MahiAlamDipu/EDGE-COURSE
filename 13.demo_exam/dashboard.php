<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Details</title>
</head>
<body>
    
    <?php
    // Include the database connection file
    require 'dbconnect.php';

    // Query to fetch data from the Rooms table
    $sql = "SELECT * FROM Rooms";

    // Execute the query and handle errors
    $result = mysqli_query($databaseConnection, $sql) 
        or die("Query failed: " . mysqli_error($databaseConnection));
    ?>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Room ID</th>
                <th>Room Type</th>
                <th>Price</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {
                // Fetch and display rows
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "
                    <tr>
                        <td>{$row['id']}</td>
                        <td>{$row['type']}</td>
                        <td>{$row['price']}</td>
                        <td>{$row['status']}</td>
                        <td>
                            <a href='/EDGE-RUET-CSE-RUETCSEB0101/13.demo_exam/editroom.php?id={$row['id']}'>
                                <button>Edit</button>
                            </a>
                            <a href='/EDGE-RUET-CSE-RUETCSEB0101/13.demo_exam/deleteroom.php?id={$row['id']}'>
                                <button>Delete</button>
                            </a>
                        </td>
                    </tr>";
                }
            } else {
                // Display a message if no records are found
                echo "<tr><td colspan='5'>No records found</td></tr>";
            }

            // Close the database connection
            mysqli_close($databaseConnection);
            ?>
        </tbody>
    </table>

</body>
</html>

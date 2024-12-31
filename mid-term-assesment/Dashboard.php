<!-- Dashboard.html -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="Dashboard.html">Hotel Admin Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="Dashboard.php">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="AddRoom.php">Add Room</a></li>
                    <li class="nav-item"><a class="nav-link" href="UpdateRoom.php">Update Room</a></li>
                    <li class="nav-item"><a class="nav-link" href="DeleteRoom.php">Delete Room</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Dashboard Page -->
    <div class="container mt-5">
        <h2>Dashboard</h2>

        <?php
        require "dbconnect.php";

        $sql = "SELECT * FROM Rooms";


        $result = mysqli_query($databaseConnection, $sql)
            or die("Query failed: " . mysqli_error($databaseConnection));

        ?>
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Room ID</th>
                    <th>Room Type</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="roomTable">
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
                            <a href='UpdateRoom.php?id={$row['id']}' class='btn btn-warning btn-sm'>Update</a>
                            <a href='DeleteRoom.php?id={$row['id']}' class='btn btn-danger btn-sm'>Delete</a>
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
    </div>

    <!-- Footer -->
    <footer class="text-center mt-5 py-3 bg-dark text-white">
        All rights reserved by CSE, RUET @2024
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
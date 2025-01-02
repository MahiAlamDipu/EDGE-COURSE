<?php
require 'dbconnect.php';

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$databaseName", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected Successfully <br>";
} catch (PDOException $e) {
    die("Connection Failed: " . $e->getMessage());
}

// Pagination variables
$recordsPerPage = 2;

// Get total records
$stmt = $pdo->query("SELECT COUNT(*) AS total_records FROM rooms");
$totalRecords = $stmt->fetch()['total_records'];
$totalPages = ceil($totalRecords / $recordsPerPage);

// Get current page and sanitize
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$currentPage = max(1, min($currentPage, $totalPages)); // Ensure valid page
$offset = ($currentPage - 1) * $recordsPerPage;

// Sorting
$allowedColumns = ['id', 'type'];
$allowedOrders = ['asc', 'desc'];

$sortColumn = isset($_GET['sort']) && in_array($_GET['sort'], $allowedColumns) ? $_GET['sort'] : 'id';
$sortOrder = isset($_GET['order']) && in_array($_GET['order'], $allowedOrders) ? $_GET['order'] : 'asc';

// Fetch paginated records
$stmt = $pdo->prepare("SELECT * FROM rooms ORDER BY $sortColumn $sortOrder LIMIT :offset, :limit");
$stmt->bindValue(':limit', $recordsPerPage, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagination Example</title>
    <style>
        .pagination {
            text-align: center;
            margin-top: 20px;
        }
        .pagination a {
            margin: 0 5px;
            text-decoration: none;
            padding: 5px 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            color: #333;
        }
        .pagination a:hover {
            background-color: #f0f0f0;
        }
        .pagination a.active {
            background-color: #007bff;
            color: white;
            font-weight: bold;
            pointer-events: none;
        }
        .pagination a.disabled {
            color: #ccc;
            pointer-events: none;
        }
        .sorting-links {
            margin-bottom: 20px;
        }
        .sorting-links a {
            margin-right: 10px;
            text-decoration: none;
            color: #007bff;
        }
        .sorting-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Rooms</h1>

    <div class="sorting-links">
        <strong>Sort By:</strong>
        <a href="?sort=name&order=asc&page=<?= $currentPage ?>">Name Asc</a>
        <a href="?sort=name&order=desc&page=<?= $currentPage ?>">Name Desc</a>
        <a href="?sort=description&order=asc&page=<?= $currentPage ?>">Description Asc</a>
        <a href="?sort=description&order=desc&page=<?= $currentPage ?>">Description Desc</a>
    </div>

    <?php
    // Display fetched records
    if (empty($projects)) {
        echo "<p>No records found.</p>";
    } else {
        foreach ($projects as $project) {
            echo "<h3>ROOM ID: {$project['id']}</h3>";
            echo "<p>ROOM TYPE: {$project['type']}</p>";
            echo "<hr>";
        }
    }
    ?>

    <div class="pagination">
        <?php
        // Display "Previous" button
        if ($currentPage > 1) {
            echo "<a href='?page=" . ($currentPage - 1) . "&sort=$sortColumn&order=$sortOrder'>Previous</a>";
        } else {
            echo "<a class='disabled'>Previous</a>";
        }

        // Display page links
        for ($i = 1; $i <= $totalPages; $i++) {
            $active = $i == $currentPage ? "active" : "";
            echo "<a href='?page=$i&sort=$sortColumn&order=$sortOrder' class='$active'>Page $i</a>";
        }

        // Display "Next" button
        if ($currentPage < $totalPages) {
            echo "<a href='?page=" . ($currentPage + 1) . "&sort=$sortColumn&order=$sortOrder'>Next</a>";
        } else {
            echo "<a class='disabled'>Next</a>";
        }
        ?>
    </div>
</body>
</html>

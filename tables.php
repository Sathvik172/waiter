<?php
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tables</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Table Management</h1>
    <table border="1">
        <tr><th>Table No.</th><th>Status</th></tr>
        <?php
        // Fetch and display all tables with their statuses
        $result = $conn->query("SELECT * FROM tables");
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>Table {$row['table_number']}</td><td>{$row['status']}</td></tr>";
        }
        ?>
    </table>
</body>
</html>

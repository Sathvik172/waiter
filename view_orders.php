<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Orders</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Order List</h1>
    <table>
        <tr><th>Order ID</th><th>Table</th><th>Menu Item</th><th>Quantity</th><th>Status</th></tr>
        <?php
        $result = $conn->query("SELECT orders.*, menu.name 
                                FROM orders JOIN menu ON orders.menu_id = menu.menu_id");
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>{$row['order_id']}</td><td>{$row['table_id']}</td><td>{$row['name']}</td><td>{$row['quantity']}</td><td>{$row['status']}</td></tr>";
        }
        ?>
    </table>
</body>
</html>

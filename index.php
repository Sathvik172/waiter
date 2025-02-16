<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Waiter Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Waiter Dashboard</h1>
    
    <h2>Available Tables</h2>
    <table>
        <tr><th>Table No.</th><th>Status</th></tr>
        <?php
        $result = $conn->query("SELECT * FROM tables");
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>{$row['table_number']}</td><td>{$row['status']}</td></tr>";
        }
        ?>
    </table>

    <h2>Pending Orders</h2>
    <table>
        <tr><th>Order ID</th><th>Table</th><th>Status</th></tr>
        <?php
        $result = $conn->query("SELECT * FROM orders WHERE status='pending'");
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>{$row['order_id']}</td><td>{$row['table_id']}</td><td>{$row['status']}</td></tr>";
        }
        ?>
    </table>

    <a href="take_order.php">Take New Order</a>
    <a href="view_orders.php">View All Orders</a>
    <a href="tables.php">Manage Tables</a>
</body>
</html>

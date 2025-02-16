<?php
include 'db.php';

// Check if the form is submitted
if (isset($_POST['place_order'])) {
    $table_id = $_POST['table_id'];
    $menu_id = $_POST['menu_id'];
    $quantity = $_POST['quantity'];
    $special_request = $_POST['special_request'];

    // Step 1: Insert the order into the orders table
    $sql = "INSERT INTO orders (table_id, menu_id, quantity, special_request, status) 
            VALUES ('$table_id', '$menu_id', '$quantity', '$special_request', 'pending')";
    
    if ($conn->query($sql)) {
        // Step 2: Update the table status to 'occupied'
        $update_table_sql = "UPDATE tables SET status = 'occupied' WHERE table_id = '$table_id'";
        $conn->query($update_table_sql);

        echo "Order placed successfully! The table is now marked as occupied.";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Take Order</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Take Order</h1>
    <form method="post">
        <label>Table Number:</label>
        <select name="table_id" required>
            <?php
            // Fetch available tables to display in the dropdown
            $tables = $conn->query("SELECT * FROM tables WHERE status='available'");
            while ($row = $tables->fetch_assoc()) {
                echo "<option value='{$row['table_id']}'>Table {$row['table_number']}</option>";
            }
            ?>
        </select><br>

        <label>Menu Item:</label>
        <select name="menu_id" required>
            <?php
            // Fetch menu items to display in the dropdown
            $menu = $conn->query("SELECT * FROM menu");
            while ($row = $menu->fetch_assoc()) {
                echo "<option value='{$row['menu_id']}'>{$row['name']} - Rs.{$row['price']}</option>";
            }
            ?>
        </select><br>

        <label>Quantity:</label>
        <input type="number" name="quantity" required><br>

        <label>Special Request:</label>
        <input type="text" name="special_request"><br>

        <button type="submit" name="place_order">Place Order</button>
    </form>
</body>
</html>

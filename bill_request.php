<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bill Request</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Request Bill</h1>
    <form method="post">
        <label>Table Number:</label>
        <input type="number" name="table_id" required><br>
        <button type="submit" name="request_bill">Request Bill</button>
    </form>

    <?php
    if (isset($_POST['request_bill'])) {
        echo "Bill request sent for Table ID: " . $_POST['table_id'];
    }
    ?>
</body>
</html>

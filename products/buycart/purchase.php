<?php
require_once '../config.php';

// Example: Fetch user_id from a parameter, query string, or any other source
$user_id = 1; // Replace with your logic to fetch the user ID

$query = "SELECT * FROM purchases 
          INNER JOIN products ON purchases.product_id = products.product_id 
          INNER JOIN payments ON purchases.payment_id = payments.payment_id";

$stmt = $pdo->prepare($query);
$stmt->execute();
$purchases = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all rows from the result set
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchases</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <h1>Purchases</h1>
    <a href="../productdash.php" class="btn btn-primary mb-3">Go to Product Dashboard</a>
    <table>
        <tr>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Total Price</th>
            <th>Date</th>
            <th>Customer Name</th>
            <th>Email</th>
        </tr>
        <?php foreach ($purchases as $purchase): ?>
        <tr>
            <td><?php echo htmlspecialchars($purchase['product_name']); ?></td>
            <td><?php echo htmlspecialchars($purchase['purchase_quantity']); ?></td>
            <td><?php echo htmlspecialchars($purchase['product_price'] * $purchase['purchase_quantity']); ?></td>
            <td><?php echo htmlspecialchars($purchase['purchase_date']); ?></td>
            <td><?php echo htmlspecialchars($purchase['payment_firstname'] . ' ' . $purchase['payment_lastname']); ?></td>
            <td><?php echo htmlspecialchars($purchase['payment_email']); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>

<?php
// Include config file
require_once "../config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $number = $_POST['number'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    try {
        // Check if product_id exists in products table
        $product_check_query = "SELECT product_id FROM products WHERE product_id = ?";
        $stmt = $pdo->prepare($product_check_query);
        $stmt->execute([$product_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            // Insert payment details
            $query = "INSERT INTO payments (payment_firstname, payment_lastname, payment_email, payment_address, payment_number) VALUES (?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$firstname, $lastname, $email, $address, $number]);
            $payment_id = $pdo->lastInsertId();

            // Insert purchase details
            $query = "INSERT INTO purchases (product_id, payment_id, purchase_quantity) VALUES (?, ?, ?)";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$product_id, $payment_id, $quantity]);

            header('Location: http://localhost/laspona-pdo-crud/products/buycart/purchase.php');
            exit; // Ensure script stops executing after redirect
        } else {
            echo "Invalid product ID.";
        }
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Payment</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styles */
        .form-group {
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <h1>Submit Payment</h1>
            <p>Required fields are followed by *</p>
            <h2>Payment Information</h2>
            <div class="form-group">
                <label for="firstname">First Name: *</label>
                <input type="text" name="firstname" id="firstname" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="lastname">Last Name: *</label>
                <input type="text" name="lastname" id="lastname" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email: *</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="address">Address: *</label>
                <textarea name="address" id="address" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="number">Number: *</label>
                <input type="text" name="number" id="number" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity: *</label>
                <input type="number" name="quantity" id="quantity" class="form-control" required>
            </div>
            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($_GET['product_id'] ?? ''); ?>">
            <button type="submit" class="btn btn-primary">Submit Payment</button>
        </form>
    </div>
</body>
</html>

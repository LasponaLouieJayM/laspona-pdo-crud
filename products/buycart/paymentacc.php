<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Address</title>
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
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <h1>Payment Address</h1>
            <p>Required fields are followed by *</p>
            <h2>Address Information</h2>
            <div class="form-group">
                <label for="payment_name">First Name: *</label>
                <input type="text" name="payment_name" id="payment_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="payment_lastname">Last Name:</label>
                <input type="text" name="payment_lastname" id="payment_lastname" class="form-control">
            </div>
            <div class="form-group">
                <label for="payment_email">Email: *</label>
                <input type="email" name="payment_email" id="payment_email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="payment_address">Address: *</label>
                <input type="text" name="payment_address" id="payment_address" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="payment_phone">Phone No: *</label>
                <input type="tel" name="payment_phone" id="payment_phone" class="form-control" required>
            </div>
          <a href="http://localhost/laspona-pdo-crud/products/buycart/purchase.php" class="btn btn-primary">Proceed to Purchase</a>

        </form>
    </div>
</body>
</html>

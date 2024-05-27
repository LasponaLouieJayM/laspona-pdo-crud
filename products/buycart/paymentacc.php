<?php
// Include config file
require_once "../config.php";
 
// Define variables and initialize with empty values
$payment_name = $payment_address = $payment_number = "";
$payment_name_err = $payment_address_err = $payment_number_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate payment name
    $input_payment_name = trim($_POST["payment_name"]);
    if(empty($input_payment_name)){
        $payment_name_err = "Please enter a payment name.";
    } else{
        $payment_name = $input_payment_name;
    }
    
    // Validate payment address
    $input_payment_address = trim($_POST["payment_address"]);
    if(empty($input_payment_address)){
        $payment_address_err = "Please enter a payment address.";     
    } else{
        $payment_address = $input_payment_address;
    }
    
    // Validate payment number
    $input_payment_number = trim($_POST["payment_number"]);
    if(empty($input_payment_number)){
        $payment_number_err = "Please enter the payment number.";     
    } elseif(!ctype_digit($input_payment_number)){
        $payment_number_err = "Please enter a positive integer value.";
    } else{
        $payment_number = $input_payment_number;
    }
    
    // Check input errors before inserting in database
    if(empty($payment_name_err) && empty($payment_address_err) && empty($payment_number_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO payment_address (payment_name, payment_address, payment_number) VALUES (:payment_name, :payment_address, :payment_number)";
 
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":payment_name", $param_payment_name);
            $stmt->bindParam(":payment_address", $param_payment_address);
            $stmt->bindParam(":payment_number", $param_payment_number);
            
            // Set parameters
            $param_payment_name = $payment_name;
            $param_payment_address = $payment_address;
            $param_payment_number = $payment_number;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        unset($stmt);
    }
    
    // Close connection
    unset($pdo);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Address</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h1>Payment Address</h1>
        <p>Required fields are followed by *</p>
        <h2>Address Information</h2>
        <p>First Name: *<input type="text" name="payment_name" required></p>
        <p>Last Name: <input type="text" name="payment_lastname"></p>
        <p>Email: * <input type="email" name="payment_email" required></p>
        <p>Address: * <input type="text" name="payment_address" required></p>
        <p>Phone No:  *<input type="tel" name="payment_phone" required></p>
        <button type="submit" class="btn btn-primary" onclick="submitFormAndRedirect()">Proceed to Purchase</button>
    </form>
</div>
</body>
</html>

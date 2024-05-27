<?php
// Include config file
require_once "../config.php";
 
// Define variables and initialize with empty values
$purchase_name = $purchase_price = $purchase_quantity = $purchase_date_added = $payment_id = "";
$purchase_name_err = $purchase_price_err = $purchase_quantity_err = $purchase_date_added_err = $payment_id_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate purchase name
    $input_purchase_name = trim($_POST["purchase_name"]);
    if(empty($input_purchase_name)){
        $purchase_name_err = "Please enter a purchase name.";
    } else{
        $purchase_name = $input_purchase_name;
    }
    
    // Validate purchase price
    $input_purchase_price = trim($_POST["purchase_price"]);
    if(empty($input_purchase_price)){
        $purchase_price_err = "Please enter the purchase price.";     
    } elseif(!ctype_digit($input_purchase_price)){
        $purchase_price_err = "Please enter a positive integer value.";
    } else{
        $purchase_price = $input_purchase_price;
    }
    
    // Validate purchase quantity
    $input_purchase_quantity = trim($_POST["purchase_quantity"]);
    if(empty($input_purchase_quantity)){
        $purchase_quantity_err = "Please enter the purchase quantity.";     
    } elseif(!ctype_digit($input_purchase_quantity)){
        $purchase_quantity_err = "Please enter a positive integer value.";
    } else{
        $purchase_quantity = $input_purchase_quantity;
    }
    
    // Validate purchase date added
    $input_purchase_date_added = trim($_POST["purchase_date_added"]);
    if(empty($input_purchase_date_added)){
        $purchase_date_added_err = "Please enter the purchase date added.";     
    } else{
        $purchase_date_added = $input_purchase_date_added;
    }
    
    // Validate payment id
    $input_payment_id = trim($_POST["payment_id"]);
    if(empty($input_payment_id)){
        $payment_id_err = "Please enter the payment id.";     
    } elseif(!ctype_digit($input_payment_id)){
        $payment_id_err = "Please enter a positive integer value.";
    } else{
        $payment_id = $input_payment_id;
    }
    
    // Check input errors before inserting in database
    if(empty($purchase_name_err) && empty($purchase_price_err) && empty($purchase_quantity_err) && empty($purchase_date_added_err) && empty($payment_id_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO purchase (purchase_name, purchase_price, purchase_quantity, purchase_date_added, payment_id) VALUES (:purchase_name, :purchase_price, :purchase_quantity, :purchase_date_added, :payment_id)";
 
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":purchase_name", $param_purchase_name);
            $stmt->bindParam(":purchase_price", $param_purchase_price);
            $stmt->bindParam(":purchase_quantity", $param_purchase_quantity);
            $stmt->bindParam(":purchase_date_added", $param_purchase_date_added);
            $stmt->bindParam(":payment_id", $param_payment_id);
            
            // Set parameters
            $param_purchase_name = $purchase_name;
            $param_purchase_price = $purchase_price;
            $param_purchase_quantity = $purchase_quantity;
            $param_purchase_date_added = $purchase_date_added;
            $param_payment_id = $payment_id;
            
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
    <title>Create Purchase Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Create Purchase Record</h2>
                    <p>Please fill this form and submit to add a purchase record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Purchase Name</label>
                            <input type="text" name="purchase_name" class="form-control <?php echo (!empty($purchase_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $purchase_name; ?>">
                            <span class="invalid-feedback"><?php echo $purchase_name_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Purchase Price</label>
                            <input type="text" name="purchase_price" class="form-control <?php echo (!empty($purchase_price_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $purchase_price; ?>">
                            <span class="invalid-feedback"><?php echo $purchase_price_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Purchase Quantity</label>
                            <input type="text" name="purchase_quantity" class="form-control <?php echo (!empty($purchase_quantity_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $purchase_quantity; ?>">
                            <span class="invalid-feedback"><?php echo $purchase_quantity_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Purchase Date Added</label>
                            <input type="text" name="purchase_date_added" class="form-control <?php echo (!empty($purchase_date_added_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $purchase_date_added; ?>">
                            <span class="invalid-feedback"><?php echo $purchase_date_added_err; ?></span>
                        </div>

                        <input type="submit" class="btn btn-primary" onclick="submit()" value="Submit">
                        <a  class="btn btn-secondary ml-2" onclick="cancel()">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
<script>
function cancel() {

		if (confirm("Are you sure you want to Cancel?")) {
            location.href = "http://localhost/laspona-pdo-crud/index.php";
		} else {
            location.href = "";
        }
    }

    function submit() {

if (confirm("Are you Sure You Want to Purchase?")) {
    location.href = "http://localhost/laspona-pdo-crud/index.php";
} else {
    location.href = "";
}
}  
</script>
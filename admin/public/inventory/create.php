<?php
// Include config file
require_once "../../db/config.php";
 
// Define variables and initialize with empty values
$name = $description = $price = $retailprice = $quantity = $image ="";
$name_err = $description_err = $price = $retailprice_err = $quantity_err = $image_err ="";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }
    
    // Validate Description
    $input_description = trim($_POST["description"]);
    if(empty($input_description)){
        $description_err = "Please enter an description.";     
    } else{
        $description = $input_description;
    }

     // Validate price
     $input_price = trim($_POST["price"]);
     if (empty($input_price)) {
         $price_err = "Please enter the price.";
     } elseif (!is_numeric($input_price)) {
         $price_err = "Please enter a valid price.";
     } else {
         $price = $input_price;
     }

    // Validate retailprice
    $input_retailprice = trim($_POST["retailprice"]);
    if(empty($input_retailprice)){
        $retailprice_err = "Please enter the retail price.";     
    } elseif(!ctype_digit($input_retailprice)){
        $salary_err = "Please enter a positive integer value.";
    } else{
        $retailprice = $input_retailprice;
    }

      // Validate quantity
      $input_quantity = trim($_POST["quantity"]);
      if (empty($input_quantity)) {
          $quantity_err = "Please enter the quantity.";
      } elseif (!ctype_digit($input_quantity)) {
          $quantity_err = "Please enter a positive integer value for quantity.";
      } else {
          $quantity = $input_quantity;
      }

        // Validate image
    $input_image = trim($_POST["image"]);
    if (empty($input_image)) {
        $image_err = "Please enter the image URL.";
    } else {
        $image = $input_image;
    }
  
    // Check input errors before inserting in database
    if(empty($name_err) && empty($description_err) && empty($retailprice_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO products (product_name, product_description, product_price, product_retail_price, product_quantity, product_image) VALUES (:name, :description, :price, :retailprice, :quantity, :image)";
 
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":name", $param_name);
            $stmt->bindParam(":description", $param_description);
            $stmt->bindParam(":price", $param_price);
            $stmt->bindParam(":retailprice", $param_retailprice);
            $stmt->bindParam(":quantity", $param_quantity);
            $stmt->bindParam(":image", $param_image);
            
            // Set parameters
            $param_name = $name;
            $param_description = $description;
            $param_price = $price;
            $param_retailprice = $retailprice;
            $param_image = $image;
            $param_quantity = $quantity;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records created successfully. Redirect to landing page
                header("location: ./user/dashboard.php");
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
    <title>Create Record</title>
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
                    <h2 class="mt-5">Create Record</h2>
                    <p>Please fill this form and submit to add products record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Name a Product</label>
                            <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control <?php echo (!empty($description_err)) ? 'is-invalid' : ''; ?>"><?php echo $description; ?></textarea>
                            <span class="invalid-feedback"><?php echo $description_err;?></span>
                        </div>
                        <div class="form-group">
                        <label>Price</label>
                        <input type="text" name="price" class="form-control <?php echo (!empty($price_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $price; ?>">
                        <span class="invalid-feedback"><?php echo $price_err; ?></span>
                    </div>
                        <div class="form-group">
                            <label>Retail Price</label>
                            <input type="text" name="retailprice" class="form-control <?php echo (!empty($retailprice_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $retailprice; ?>">
                            <span class="invalid-feedback"><?php echo $retailprice_err;?></span>
                        </div>
                        <div class="form-group">
                        <label>Quantity</label>
                        <input type="text" name="quantity" class="form-control <?php echo (!empty($quantity_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $quantity; ?>">
                        <span class="invalid-feedback"><?php echo $quantity_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Image URL</label>
                        <input type="text" name="image" class="form-control <?php echo (!empty($image_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $image; ?>">
                        <span class="invalid-feedback"><?php echo $image_err; ?></span>
                    </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="../dashboard.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
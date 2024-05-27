<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Font Awesome CSS -->
    <style>
        body {
            background-image: url('https://i.pinimg.com/564x/1e/78/f2/1e78f264870dcec4ed55233b7ecd4663.jpg');
            background-size: cover; /* Cover the entire background */
            background-position: center; /* Center the background image */
            background-repeat: no-repeat; /* Prevent repeating of background image */
            min-height: 100vh; /* Set minimum height to fill the viewport */
            margin: 0; /* Remove default margin */
            padding: 0; /* Remove default padding */
        }
        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;
            width: 80%;
            margin: auto; /* Center align content */
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background for readability */
            border-radius: 10px; /* Rounded corners for card grid */
            padding-bottom: 40px; /* Add padding at the bottom for better spacing */
        }
        .card {
            width: 100%;
            border: 3px solid black; /* Add border around each card */
            padding: 10px; /* Optional padding inside the card */
            position: relative;
            overflow: hidden;
            color: white;
            background-color: gray; /* Semi-transparent white background for readability */
            border-radius: 10px; /* Rounded corners for cards */
        }
        .card-img-top {
            width: 100%; /* Ensure the image takes full width of its container */
            height: 250px; /* Set a fixed height for consistency */
            object-fit: contain; /* Ensure the entire image fits within the container without cropping */
        }
        #cartContainer {
            position: fixed;
            top: 4em;
            right: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 10px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            z-index: 999;
        }
        .navbar-brand img {
            width: 30px; /* Set the width of the logo */
            height: 30px; /* Set the height of the logo */
            margin-right: 10px; /* Optional margin for spacing */
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">
        <img src="https://i.pinimg.com/564x/6a/19/6b/6a196b1d143d0f0a1d3ddf1fd79c560e.jpg" class="d-inline-block align-top" alt="">
        Potion's Store
    </a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
        
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <a class="btn btn-danger ml-3" href="index.php" type="submit">Sign Out of Your Account</a>
        </form>
    </div>
</nav>
<div id="productsDisplay" class="card-grid"></div>
<div id="cartContainer"></div>

<!-- Add to Cart Modal -->
<div class="modal fade" id="addToCartModal" tabindex="-1" role="dialog" aria-labelledby="addToCartModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addToCartModalLabel">Add to Cart</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Content dynamically inserted via JavaScript -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="addToCartButton">Add to Cart</button>
            </div>
        </div>
    </div>
</div>

<script>
    fetch('../products/products-api.php')
        .then(response => {
            if (!response.ok) {
                return response.json().then(error => {
                    throw new Error(error.error);
                });
            }
            return response.json();
        })
        .then(data => {
            const productsContainer = document.getElementById('productsDisplay');
            data.forEach(product => {
                const cardHTML = `
                    <div class="card">
                        <img class="card-img-top" src="${product.product_image}">
                        <div class="card-body">
                            <h5 class="card-title">${product.product_name}</h5>
                            <p class="card-text">Price: ₱${product.product_retail_price}</p>
                            <p class="card-text">${product.product_description}</p>
                            <p class="card-text">Quantity: ${product.product_quantity}</p>
                            <button class="btn btn-success" onclick="openAddToCartModal(${product.product_id}, ${product.product_quantity})">
                                <i class="fas fa-cart-plus"></i> Add to Cart
                            </button>
                            <hr>
                            <button class="btn btn-danger" onclick="buyProduct(${product.product_id})">
                                <i class="fas fa-shopping-bag"></i> Buy
                            </button>
                        </div>
                    </div>
                `;
                productsContainer.innerHTML += cardHTML;
            });
        })
        .catch(error => console.error('Error:', error));

    let cart = {};

    function openAddToCartModal(productId, quantityInCart) {
        // Clear previous modal content
        const modalBody = document.querySelector('#addToCartModal .modal-body');
        modalBody.innerHTML = `
            <p>Product ID: ${productId}</p>
            <label for="quantityInput">Quantity:</label>
            <input type="number" id="quantityInput" min="1" value="quantityInput}" class="form-control">
        `;
        // Show modal
        $('#addToCartModal').modal('show');
        // Handle Add to Cart button click
        document.querySelector('#addToCartButton').addEventListener('click', function() {
            const quantity = document.querySelector('#quantityInput').value;
            addToCart(productId, quantity);
            $('#addToCartModal').modal('hide');
        });
    }

    function addToCart(productId, quantity) {
        quantity = parseInt(quantity);
        if (cart[productId]) {
            cart[productId] += quantity;
        } else {
            cart[productId] = quantity;
        }
        displayCart();
    }

    function displayCart() {
        const cartContainer = document.getElementById('cartContainer');
        let cartHTML = '<h3>Cart</h3>';
        for (const [productId, quantity] of Object.entries(cart)) {
            cartHTML += `
                <div>
                    <p>Product ID: ${productId}, Quantity: ${quantity}</p>
                    <button class="btn btn-danger" onclick="buyProduct(${productId})">
                        <i class="fas fa-shopping-bag"></i> Buy
                    </button>
                </div>
            `;
        }
        cartContainer.innerHTML = cartHTML;
    }

    function buyProduct(productId) {
        // Prepare URL with cart details if any
        let url = `./buycart/paymentacc.php?product_id=${productId}`;
        if (cart[productId]) {
            url += `&quantity=${cart[productId]}`;
        }
        window.location.href = url;
    }
</script>

<!-- Bootstrap JavaScript libraries -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

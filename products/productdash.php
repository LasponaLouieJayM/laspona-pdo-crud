<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Font Awesome CSS -->
    <style>
        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;
            width: 80%;
        }
        .card {
            width: 100%;
        }
        .card-img-top {
            width: 100%;
            height: auto;
            object-fit: cover;
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
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">
        <img src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" width="30" height="30" class="d-inline-block align-top" alt="">
        Bootstrap
    </a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>
<div id="productsDisplay" class="card-grid"></div>
<div id="cartContainer"></div>

<script>
    fetch('./products/products-api.php')
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
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="${product.product_image}">
                        <div class="card-body">
                            <h5 class="card-title">${product.product_name}</h5>
                            <p class="card-text">Price: ₱${product.product_retail_price}</p>
                            <p class="card-text">${product.product_description}</p>
                            <p class="card-text">Quantity: ${product.product_quantity}</p>
                            <button class="btn btn-success" onclick="addToCart(${product.product_id})">
                                <i class="fas fa-cart-plus"></i> Add to Cart
                            </button>
                            <button class="btn btn-success" onclick="buyProduct(${product.product_id})">
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

    function addToCart(productId) {
        if (cart[productId]) {
            cart[productId]++;
        } else {
            cart[productId] = 1;
        }
        displayCart();
    }

    function displayCart() {
        const cartContainer = document.getElementById('cartContainer');
        let cartHTML = '<h3>Cart</h3>';
        for (const [productId, quantity] of Object.entries(cart)) {
            cartHTML += `<p>Product ID: ${productId}, Quantity: ${quantity}</p>`;
        }
        cartContainer.innerHTML = cartHTML;
    }

    function buyProduct(productId) {
        window.location.href = `products/buycart/paymentacc.php?product_id=${productId}`;
    }
</script>
</body> 
</html>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Order Now | R.R. Business</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
    }

    header {
      background-color: #a83232;
      color: white;
      padding: 20px;
      text-align: center;
    }

    .order-form {
      max-width: 600px;
      margin: 40px auto;
      padding: 30px;
      background-color: #ffffff;
      box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
      border-radius: 10px;
    }

    .order-form h2 {
      text-align: center;
      color: #a83232;
      margin-bottom: 20px;
    }

    .order-form input, 
    .order-form textarea {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 16px;
    }

    .order-form button {
      background-color: #a83232;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
      width: 100%;
    }

    .order-form button:hover {
      background-color: #8a1f1f;
    }

    nav {
      background-color: #d94c4c;
      padding: 12px;
      text-align: center;
    }

    nav a {
      color: white;
      margin: 0 15px;
      text-decoration: none;
      font-weight: bold;
    }

    footer {
      background-color: #333;
      color: white;
      text-align: center;
      padding: 15px;
      position: fixed;
      width: 100%;
      bottom: 0;
    }

    header img {
      height: 100px;
      margin-right: 15px;
      float: left;
    }

    header h1, header p {
      margin: 0;
    }

    h1 {
      margin-right: 160px;
    }

    p {
      margin-right: 160px;
    }
  </style>
</head>
<body>

<header>
  <img src="images/Logo.png" alt="R.R. Business Logo">
  <h1>R.R. Business</h1>
  <p>Quality Spices Delivered to Your Doorstep</p>
</header>

<!-- Navbar -->
<nav>
  <a href="index.php">Home</a>
  <a href="products.php">Products</a>
  <a href="about.php">About US</a>
  <a href="contact.php">Contact US</a>
  <a href="order.php">Order Now/ Buy Online</a>
  <a href="gallery.php">Gallery/ Blogs</a>
  <a href="recipes.php">Recipes</a>
</nav>

<div class="order-form">
  <h2>Place Your Order</h2>
  <form action="submit_order.php" method="post">
    <input type="text" name="customer_name" placeholder="Customer Name" required>
    <input type="email" name="email" placeholder="Email Address" required>
    <input type="text" name="phone" placeholder="Mobile No" required>
    <input type="text" name="product_name" placeholder="Product Name" required>
    <input type="number" name="quantity" placeholder="Quantity (Pcs)" required>
    <textarea name="address" placeholder="Delivery Address" required></textarea>
    <button type="submit">Submit Order</button>
  </form>
</div>

<footer>
  &copy; <?= date("Y") ?> R.R. Business. All rights reserved.
</footer>

</body>
</html>

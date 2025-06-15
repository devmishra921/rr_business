<?php
$products = [
  [
    'name' => 'Haldi Powder',
    'image' => 'images/haldi.jpg',
    'description' => 'Shuddh aur khushboo daar haldi.',
    'price' => '₹70 per 100g'
  ],
  [
    'name' => 'Dhaniya Powder',
    'image' => 'images/mixsabji_masala1.png',
    'description' => 'Taaza pisa hua dhaniya.',
    'price' => '₹60 per 100g'
  ],
  [
    'name' => 'Garam Masala',
    'image' => 'images/garam_masala1.png',
    'description' => 'Special blend of Indian spices.',
    'price' => '₹90 per 100g'
  ],
  [
    'name' => 'Haldi Powder',
    'image' => 'images/chicken_masala1.png',
    'description' => 'Shuddh aur khushboo daar haldi.',
    'price' => '₹70 per 100g'
  ],
  [
    'name' => 'Dhaniya Powder',
    'image' => 'images/panir_masala.jpg',
    'description' => 'Taaza pisa hua dhaniya.',
    'price' => '₹60 per 100g'
  ],
  [
    'name' => 'Garam Masala',
    'image' => 'images/chicken_masalapf.png',
    'description' => 'Special blend of Indian spices.',
    'price' => '₹90 per 100g'
  ]
];
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Products | R.R. Business</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f9f9f9;
    }
    header {
      background: #a83232;
      padding: 15px;
      color: white;
      text-align: center;
      font-size: 24px;
    }
    nav {
      background: #eee;
      padding: 10px;
      text-align: center;
    }
    nav a {
      margin: 0 15px;
      color: #a83232;
      text-decoration: none;
      font-weight: bold;
    }
    h1 {
      text-align: center;
      margin-top: 30px;
      margin-left: 350px;
      color:rgb(245, 242, 242);
    }
    h5 {
      text-align: center;
      margin-top: 30px;
      margin-left: 350px;
      color:rgb(245, 242, 242);
    }
    h2 {
      text-align: center;
    }
    .products {
      display: flex;
      justify-content: center;
      gap: 30px;
      flex-wrap: wrap;
      padding: 40px 20px;
    }
    .product {
      border: 1px solid #ddd;
      padding: 15px;
      width: 250px;
      text-align: center;
      background: white;
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      transition: transform 0.3s ease;
    }
    .product:hover {
      transform: translateY(-5px);
    }
    .product img {
      width: 100%;
      height: 180px;
      object-fit: cover;
      border-radius: 6px;
    }
    .product h3 {
      color: #333;
    }
    .product p {
      font-size: 14px;
      color: #555;
    }
    .product strong {
      color: green;
      font-size: 16px;
    }
    footer {
      text-align:center;
      background:#a83232;
      color:white;
      padding:10px;
      margin-top:40px;
    }
  </style>
</head>
<body>

 <header style="display: flex; align-items: center; justify-content: space-between;">
  <div style="display: flex; align-items: center;">
    <img src="images/Logo.png" alt="R.R. Business Logo" style="height: 150px; margin-right: 15px;">
    <div>
      <h1 class="main-heading">Welcome to R.R. Business</h1>
      <h5 class="main-p">100% Shuddh Desi Masale</h5>
    </div>
  </div>
</header>
<nav>
    <a href="index.php">Home</a>
    <a href="products.php">Products</a>
    <a href="about.php">About US</a>
    <a href="contact.php">Contact US</a>
    <a href="order.php">Order Now/ Buy Online</a>
    <a href="gallery.php">Gallery/ Blogs</a>
    <a href="recipes.php">Recipes</a>
  </nav>

<h2>Our Products</h2>
<div class="products">
  <?php foreach ($products as $p): ?>
    <div class="product">
      <img src="<?= $p['image'] ?>" alt="<?= $p['name'] ?>">
      <h3><?= $p['name'] ?></h3>
      <p><?= $p['description'] ?></p>
      <strong><?= $p['price'] ?></strong>
    </div>
  <?php endforeach; ?>
</div>

<footer>
  &copy; <?= date('Y') ?> R.R. Business. All rights reserved.
</footer>

</body>
</html>

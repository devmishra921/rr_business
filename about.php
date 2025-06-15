<!DOCTYPE html>
<html>
<head>
  <title>About Us | R.R. Business</title>
  <style>
    .about-section {
      max-width: 800px;
      margin: 40px auto;
      padding: 20px;
      line-height: 1.8;
    }
    header {
      background-color: #a83232;
      color: white;
      padding: 20px;
      text-align: center;
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
  </style>
</head>
<body>
  <header>
   <img src="images/Logo.png" alt="R.R. Business Logo" style="height: 100px; margin-right: 15px; float:left;">
  <h1>R.R. Business</h1>
  <p>Quality Spices Delivered to Your Doorstep</p>
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
  <div class="about-section">
    <h1>About R.R. Business</h1>
    <p>R.R. Business ek trusted brand hai jo 100% shuddh masalon ko ghar ghar tak pahunchata hai.</p>
    <p>Hamare masale bina milawat ke, manually select kiye jaate hain, aur hygienic packaging me bheje jaate hain.</p>
    <p>Goal hai har Indian kitchen me asli swaad aur sehat pahuchana.</p>
  </div>
  <footer>
  &copy; <?= date("Y") ?> R.R. Business. All rights reserved.
</footer>
</body>
</html>
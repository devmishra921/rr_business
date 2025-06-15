<!DOCTYPE html>
<html>
<head>
  <title>Gallery | R.R. Business</title>
  <style>
    .gallery {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
      padding: 20px;
    }
    .gallery img {
      width: 250px;
      height: 200px;
      object-fit: cover;
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
    header {
      background-color: #a83232;
      padding: 20px 40px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      color: white;
    }
    header img {
      height: 80px;
      margin-right: 20px;
    }
    header .title {
      font-size: 24px;
    }
     footer {
      background-color: #a83232;
      color: white;
      text-align: center;
      padding: 20px;
    }
  </style>
</head>
<body>
  <!-- Header -->
  <header>
    <div style="display: flex; align-items: center;">
      <img src="images/Logo.png" alt="R.R. Business Logo">
      <div>
        <div class="title">R.R. Business</div>
        <small>100% Shuddh Desi Masale</small>
      </div>
    </div>
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
  <h1 style="text-align:center;">Our Product Gallery</h1>
  <div class="gallery">
    <img src="images/haldi.jpg" alt="Haldi">
    <img src="images/dhaniya.jpg" alt="Dhaniya">
    <img src="images/garammasala.jpg" alt="Garam Masala">
  </div>
  <!-- Footer -->
  <footer>
    &copy; 2024 R.R. Business | All Rights Reserved | WhatsApp: <a style="color:#fff;" href="https://wa.me/917678853017">Click to Chat</a>
  </footer>
</body>
</html>
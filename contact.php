<!DOCTYPE html>
<html>
<head>
  <title>Contact Us | R.R. Business</title>
  <style>
    .contact-form {
      max-width: 600px;
      margin: 40px auto;
      padding: 20px;
    }
    input, textarea {
      width: 100%;
      padding: 10px;
      margin: 8px 0;
      border-radius: 5px;
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
  <div class="contact-form">
    <h1>Contact Us</h1>
    <form action="send_message.php" method="post">
  <label>Name:</label>
  <input type="text" name="name" required>

  <label>Email:</label>
  <input type="email" name="email" required>

  <label>Phone:</label>             <!-- ➕ add this -->
  <input type="text" name="phone" required>

  <label>Message:</label>
  <textarea name="message" rows="5" required></textarea>

  <button type="submit">Send Message</button>
</form>

  </div>
   <!-- Footer -->
  <footer>
    &copy; 2024 R.R. Business | All Rights Reserved | WhatsApp: <a style="color:#fff;" href="https://wa.me/917678853017">Click to Chat</a>
  </footer>

</body>
</html>
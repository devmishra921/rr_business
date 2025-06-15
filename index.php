<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>R.R. Business | Shuddh Masale</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: #fff8f0;
      color: #333;
    }
    header {
      background: #a83232;
      padding: 15px;
      color: white;
      text-align: center;
      font-size: 24px;
    }
    header img {
      height: 80px;
      margin-right: 20px;
    }
    header .title {
      font-size: 24px;
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
    h1 {
      text-align: center;
      margin-top: 30px;
      color:rgb(245, 242, 242);
    }
    h5 {
      text-align: center;
    }
    .hero {
      background: url('images/hero.jpg') center center/cover no-repeat;
      height: 400px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 2em;
      text-shadow: 2px 2px 5px #000;
    }
    .section {
      padding: 60px 30px;
      text-align: center;
    }
    .section h2 {
      color: #a83232;
      margin-bottom: 20px;
    }
    .info-boxes {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 30px;
      margin-top: 30px;
    }
    .box {
      background-color: white;
      border: 1px solid #ddd;
      border-radius: 10px;
      padding: 25px;
      width: 250px;
      box-shadow: 2px 2px 10px rgba(0,0,0,0.1);
    }
    .box h3 {
      color: #a83232;
    }
    .box p {
      font-size: 14px;
    }
    .box a {
      display: inline-block;
      margin-top: 10px;
      padding: 8px 16px;
      background-color: #a83232;
      color: white;
      text-decoration: none;
      border-radius: 5px;
    }
    footer {
      background-color: #a83232;
      color: white;
      text-align: center;
      padding: 20px;
    }
    @media (max-width: 768px) {
  header {
    flex-direction: column;
    align-items: center;
    text-align: center;
  }
  header img {
    margin-right: 0;
    margin-bottom: 10px;
  }
  nav a {
    display: block;
    margin: 8px 0;
  }
  .info-boxes {
    flex-direction: column;
    gap: 20px;
  }
  .box {
    width: 90%;
  }
  .banner-slider img {
    height: 200px; /* reduce for smaller screen */
  }
  .banner-text {
    font-size: 1.2em;
  }
  .section {
    padding: 30px 15px;
  }
  .section div[style*="display:flex"] {
    flex-direction: column;
    align-items: center;
  }
  .section img {
    width: 100%;
    max-width: 300px;
  }
}
  </style>
</head>
<body>

  <!-- Header -->
 <header style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between;">
  <div style="display: flex; align-items: center;">
    <img src="images/Logo.png" alt="R.R. Business Logo" style="height: 150px; margin-right: 15px;">
    <div>
      <h1 class="main-heading">Welcome to R.R. Business</h1>
      <h5>100% Shuddh Desi Masale</h5>
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

  <!-- Banner Section with Slider -->
<div class="banner-slider">
  <img src="images/banner1.jpg" id="bannerImage" alt="Banner" />
  <div class="banner-text">Taste the Purity with R.R. Business Masale</div>
</div>

<style>
  .banner-slider {
    position: relative;
    width: 100%;
    max-height: 400px;
    overflow: hidden;
    text-align: center;
    background-color: #000;
  }

  .banner-slider img {
    width: 100%;
    height: 400px;
    object-fit: cover;
    display: block;
    transition: opacity 1s ease-in-out;
  }
  .banner-text {
    position: absolute;
    bottom: 10px;
    width: 100%;
    color: white;
    font-size: 1.8em;
    font-weight: bold;
    background: rgba(0, 0, 0, 0.4);
    padding: 15px 0;
  }
</style>

<script>
  let images = [
    "images/banner1.jpg",
    "images/banner2.jpg",
    "images/banner3.jpg"
  ];
  let index = 0;

  setInterval(() => {
    index = (index + 1) % images.length;
    document.getElementById("bannerImage").src = images[index];
  }, 4000); // Change every 4 seconds
</script>

<!-- Our Products Section -->
<section class="section" style="background-color: #fff0e6;">
  <h2>Our Product Categories</h2>
  <div class="info-boxes">
    <div class="box">
      <img src="images/haldi1.png" style="width:100%; height:150px; object-fit:cover; border-radius:10px;">
      <h3>Powdered Spices</h3>
      <p>Haldi, Mirchi, Dhaniya, Jeera Powder & more.</p>
      <a href="products.php">View Products</a>
    </div>
    <div class="box">
      <img src="images/dhaniya.png" style="width:100%; height:150px; object-fit:cover; border-radius:10px;">
      <h3>Whole Spices</h3>
      <p>Sabut masale – laung, dalchini, elaichi etc.</p>
      <a href="products.php">View Products</a>
    </div>
    <div class="box">
      <img src="images/product3.jpeg" style="width:100%; height:150px; object-fit:cover; border-radius:10px;">
      <h3>Blended Spices</h3>
      <p>Garam Masala, Chaat Masala, Pav Bhaji & more.</p>
      <a href="products.php">View Products</a>
    </div>
    <div class="box">
      <img src="images/garam_masala.jpg" style="width:100%; height:150px; object-fit:cover; border-radius:10px;">
      <h3>Blended Spices</h3>
      <p>Garam Masala, Chaat Masala, Pav Bhaji & more.</p>
      <a href="products.php">View Products</a>
    </div>
  </div>
</section>

<!-- Why Choose Us -->
<section class="section">
  <h2>Why Choose Us?</h2>
  <div class="info-boxes">
    <div class="box">
      <h3>Pure Ingredients</h3>
      <p>We source only the best raw materials to ensure premium spice quality.</p>
    </div>
    <div class="box">
      <h3>Traditional Process</h3>
      <p>Our spices are ground using age-old techniques that preserve aroma and flavor.</p>
    </div>
    <div class="box">
      <h3>Certified Quality</h3>
      <p>All products are FSSAI certified and pass through rigorous quality checks.</p>
    </div>
    <div class="box">
      <h3>Affordable Pricing</h3>
      <p>Best quality masale at reasonable rates — perfect for home & commercial use.</p>
    </div>
  </div>
</section>


<!-- About Us Section -->
<section class="section">
  <h2>About R.R. Business</h2>
  <div style="display:flex; flex-wrap:wrap; justify-content:center; align-items:center; gap:30px;">
    <img src="images/about.jpg" style="width:300px; border-radius:10px;">
    <div style="max-width:500px; text-align:left;">
      <p>R.R. Business is committed to bringing 100% shuddh desi masale to every Indian kitchen. From carefully selected raw spices to hygienic packaging, our journey is guided by tradition, trust, and taste.</p>
      <p>We serve homes, restaurants, retailers, and bulk buyers with consistency and quality. Taste the difference with R.R. Business today.</p>
      <a href="about.php" style="background-color:#a83232; color:white; padding:10px 20px; text-decoration:none; border-radius:5px;">Read More</a>
    </div>
  </div>
</section>

<!-- Certification / Quality Assurance -->
<section class="section" style="background-color: #fff0e6;">
  <h2>Our Certifications</h2>
  <div class="info-boxes">
    <div class="box">
      <img src="images/fssai.png" alt="FSSAI" style="height:80px;">
      <h3>FSSAI Registered</h3>
      <p>All our products comply with food safety standards.</p>
    </div>
    <div class="box">
      <img src="images/iso.png" alt="ISO" style="height:60px;">
      <h3>ISO Certified</h3>
      <p>Processes follow global ISO 9001 quality management system.</p>
    </div>
    <div class="box">
      <img src="images/organic.png" alt="Organic" style="height:60px;">
      <h3>Organic Choices</h3>
      <p>Now offering selected organic spices on demand.</p>
    </div>
  </div>
</section>

<!-- Call to Action -->
<section class="section">
  <h2>Have a Bulk Order? Let's Talk!</h2>
  <p>We supply to retailers, hotels, restaurants, and distributors across India.</p>
  <a href="contact.php" style="background-color:#a83232; color:white; padding:12px 25px; text-decoration:none; font-size:16px; border-radius:5px;">Contact Us</a>
</section>

  <!-- About / Product / Order / Contact Boxes -->
  <div class="section">
    <h2>Explore Our World</h2>
    <div class="info-boxes">
      <div class="box">
        <h3>About Us</h3>
        <p>Learn more about our journey, values, and how we ensure quality in every spice.</p>
        <a href="about.php">Read More</a>
      </div>
      <div class="box">
        <h3>Our Products</h3>
        <p>From turmeric to garam masala, explore our wide range of pure and fresh spices.</p>
        <a href="products.php">Explore</a>
      </div>
      <div class="box">
        <h3>Order Online</h3>
        <p>Place your order directly from our website with quick delivery options available.</p>
        <a href="order.php">Order Now</a>
      </div>
      <div class="box">
        <h3>Contact Us</h3>
        <p>Have questions? Reach out to us for bulk orders, deals, or customer support.</p>
        <a href="contact.php">Get in Touch</a>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer>
    &copy; 2024 R.R. Business | All Rights Reserved | WhatsApp: <a style="color:#fff;" href="https://wa.me/917678853017">Click to Chat</a>
  </footer>

</body>
</html>

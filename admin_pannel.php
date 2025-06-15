<?php
/* -----------------------------------------------------------
   admin_pannel.php – RR Business Product Manager
   Harmonised header/footer + multi‑image upload
----------------------------------------------------------- */
$host='localhost';
$db  ='rr_business';
$user='root';
$pass='';
$conn=new mysqli($host,$user,$pass,$db);
if($conn->connect_error) die('DB connection failed: '.$conn->connect_error);

/* ---------- ADD PRODUCT ---------- */
if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['add'])){
  $name  = trim($_POST['new_name']);
  $desc  = trim($_POST['new_description']);
  $price = (float)$_POST['new_price'];

  $allowed=['jpg','jpeg','png','webp','gif'];
  $stored=[];
  $uploaddir=__DIR__.'/images/';
  foreach($_FILES['new_images']['tmp_name'] as $i=>$tmp){
    if($i>4) break;
    if($_FILES['new_images']['error'][$i]!==UPLOAD_ERR_OK) continue;
    $ext=strtolower(pathinfo($_FILES['new_images']['name'][$i],PATHINFO_EXTENSION));
    if(!in_array($ext,$allowed)) continue;
    $fname=uniqid('prod_',true).".$ext";
    move_uploaded_file($tmp,$uploaddir.$fname);
    $stored[]='images/'.$fname;
  }
  $csv=implode(',',$stored);
  $stmt=$conn->prepare("INSERT INTO products(name,description,price,images) VALUES (?,?,?,?)");
  $stmt->bind_param('ssds',$name,$desc,$price,$csv);
  $stmt->execute();
  $stmt->close();
  header('Location: admin_pannel.php?msg=added');
  exit;
}

/* ---------- UPDATE PRODUCT ---------- */
if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['update'])){
  $id    =(int)$_POST['id'];
  $name  =trim($_POST['name']);
  $desc  =trim($_POST['description']);
  $price =(float)$_POST['price'];

  $extraCsv='';
  if(!empty($_FILES['upd_images']['name'][0])){
    $allowed=['jpg','jpeg','png','webp','gif'];
    $stored=[];
    $uploaddir=__DIR__.'/images/';
    foreach($_FILES['upd_images']['tmp_name'] as $i=>$tmp){
      if($i>4) break;
      if($_FILES['upd_images']['error'][$i]!==UPLOAD_ERR_OK) continue;
      $ext=strtolower(pathinfo($_FILES['upd_images']['name'][$i],PATHINFO_EXTENSION));
      if(!in_array($ext,$allowed)) continue;
      $fname=uniqid('prod_',true).".$ext";
      move_uploaded_file($tmp,$uploaddir.$fname);
      $stored[]='images/'.$fname;
    }
    if($stored){
      $old  = ($conn->query("SELECT images FROM products WHERE id=$id")->fetch_assoc()['images'] ?? '');
      $imgs = array_filter(array_merge(explode(',',$old),$stored));
      $extraCsv = implode(',',$imgs);
    }
  }

  if($extraCsv){
      $stmt=$conn->prepare("UPDATE products SET name=?,description=?,price=?,images=? WHERE id=?");
      $stmt->bind_param('ssdsi',$name,$desc,$price,$extraCsv,$id);
  }else{
      $stmt=$conn->prepare("UPDATE products SET name=?,description=?,price=? WHERE id=?");
      $stmt->bind_param('ssdi',$name,$desc,$price,$id);
  }
  $stmt->execute();
  $stmt->close();
  header('Location: admin_pannel.php?msg=updated');
  exit;
}

/* ---------- READ ---------- */
$result=$conn->query("SELECT * FROM products ORDER BY id DESC");
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Manage Products - R.R. Business</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
<style>
body{margin:0;font-family:Arial,Helvetica,sans-serif;background:#f4f4f4}
nav{background:#444} nav a{display:inline-block;color:#fff;padding:14px 20px;text-decoration:none}
nav a:hover,nav a.active{background:#575757}
main{padding:20px;max-width:1200px;margin:20px auto;background:#fff;border-radius:5px;box-shadow:0 0 10px rgba(0,0,0,.1)}
h2{color:#a83232;margin-bottom:15px}
table{width:100%;border-collapse:collapse;margin-bottom:30px}
th,td{padding:10px;border:1px solid #ddd;text-align:left}
th{background:#a83232;color:#fff}
tr:nth-child(even){background:#f9f9f9}
input[type=text],input[type=number],textarea{width:100%;padding:6px;border:1px solid #ccc;border-radius:3px}
input[type=submit]{background:#a83232;color:#fff;border:none;padding:8px 20px;cursor:pointer;border-radius:4px}
input[type=submit]:hover{background:#8e3737}
input[type=file]{border:none}
.thumb-stack img{max-width:50px;border-radius:3px;margin-right:4px}
.alert{background:#d4edda;color:#155724;padding:10px;border-radius:4px;text-align:center;margin:15px auto;max-width:1200px}

/* Header/Footer styles */
header{background:#a83232;color:#fff;padding:10px 20px}
.header-inner{display:flex;align-items:center;justify-content:space-between;max-width:1200px;margin:0 auto}
.logo{height:80px}
header h1{margin:0;font-size:26px;text-align:center;flex:1}
.user-info{font-size:14px;text-align:right;min-width:150px}

footer{background:#333;color:#fff;padding:25px 10px;margin-top:60px}
.footer-grid{max-width:1200px;margin:0 auto;display:flex;flex-wrap:wrap;gap:30px}
.footer-col{flex:1 1 200px}
.footer-col h4{margin-top:0;color:#fff;border-bottom:2px solid #a83232;display:inline-block;padding-bottom:4px}
.footer-col ul{list-style:none;padding:0;margin:10px 0 0}
.footer-col ul li{margin-bottom:6px}
.footer-col a{color:#fff;text-decoration:none}
.footer-col a:hover{text-decoration:underline}
.copyright{text-align:center;margin-top:25px;font-size:14px}
.developed-by{text-align:center;margin-top:10px;font-size:13px;color:#ffcb6b}
</style>
</head>
<body>

<!-- ===== Header ===== -->
<header>
  <div class="header-inner">
    <img src="images/Logo.png" alt="R.R. Business Logo" class="logo">
    <h1>R.R. Business – Manage Products</h1>
    <div class="user-info"><span id="clock"></span></div>
  </div>
</header>

<!-- ===== Navigation ===== -->
<nav>
  <a href="dashboard.php">Dashboard</a>
  <a href="admin_pannel.php" class="active">Manage Products</a>
  <a href="view_order.php">View Orders</a>
  <a href="customer_queries.php">Customer Queries</a>
  <a href="logout.html">Logout</a>
</nav>

<?php if(isset($_GET['msg'])): ?>
  <p class="alert">✔ <?= ($_GET['msg']==='added'?'New product added':'Product updated') ?></p>
<?php endif; ?>

<main>
  <!-- ===== Product List ===== -->
  <h2>Product List</h2>
  <table>
    <tr><th>ID</th><th>Name</th><th>Description</th><th>Price (₹)</th><th>Images</th><th>Action</th></tr>
    <?php while($row = $result->fetch_assoc()): ?>
      <?php
        $imgsCsv = (string)($row['images'] ?? '');
        $imgs    = array_filter(array_map('trim', explode(',',$imgsCsv)));
      ?>
      <tr>
        <form method="post" enctype="multipart/form-data">
          <td><?= $row['id'] ?><input type="hidden" name="id" value="<?= $row['id'] ?>"></td>
          <td><input type="text" name="name" value="<?= htmlspecialchars($row['name'] ?? '') ?>"></td>
          <td><textarea name="description"><?= htmlspecialchars($row['description'] ?? '') ?></textarea></td>
          <td><input type="number" step="0.01" name="price" value="<?= htmlspecialchars($row['price'] ?? 0) ?>"></td>
          <td class="thumb-stack">
            <?php foreach(array_slice($imgs,0,3) as $img): ?>
              <img src="<?= htmlspecialchars($img) ?>" alt="">
            <?php endforeach; ?>
            <input type="file" name="upd_images[]" accept="image/*" multiple>
          </td>
          <td><input type="submit" name="update" value="Update"></td>
        </form>
      </tr>
    <?php endwhile; ?>
  </table>

  <!-- ===== Add New Product ===== -->
  <h2>Add New Product</h2>
  <form method="post" enctype="multipart/form-data">
    <table>
      <tr>
        <td><input type="text" name="new_name" placeholder="Product Name" required></td>
        <td><textarea name="new_description" placeholder="Description" required></textarea></td>
        <td><input type="number" step="0.01" name="new_price" placeholder="Price ₹" required></td>
        <td><input type="file" name="new_images[]" accept="image/*" multiple required></td>
        <td><input type="submit" name="add" value="Add Product"></td>
      </tr>
      <tr><td colspan="5" style="font-size:12px;color:#555">(3‑5 images चुनें – पहली तस्वीर थंबनेल बनेगी)</td></tr>
    </table>
  </form>
</main>

<!-- ===== Footer ===== -->
<footer>
  <div class="footer-grid">
    <div class="footer-col">
      <h4>Contact Us</h4>
      <ul>
        <li>Phone: +91 76788 53017</li>
        <li>Email: support@rrbusiness.com</li>
        <li>Email: care@rrbusiness.com</li>
      </ul>
    </div>
    <div class="footer-col">
      <h4>Quick Links</h4>
      <ul>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="view_order.php">Orders</a></li>
        <li><a href="customer_queries.php">Queries</a></li>
      </ul>
    </div>
    <div class="footer-col">
      <h4>Follow Us</h4>
      <ul>
        <li><a href="#"><i class="fab fa-facebook"></i> Facebook</a></li>
        <li><a href="#"><i class="fab fa-instagram"></i> Instagram</a></li>
        <li><a href="https://wa.me/917678853017"><i class="fab fa-whatsapp"></i> WhatsApp</a></li>
      </ul>
    </div>
  </div>
  <div class="copyright">
    &copy; <?= date('Y') ?> R.R. Business | All Rights Reserved | WhatsApp:
    <a style="color:#fff" href="https://wa.me/917678853017">Click to Chat</a>
  </div>
  <div class="developed-by">
    Developed by <strong>V.G Technologies Pvt. Ltd.</strong> (Devesh Mishra)
  </div>
</footer>

<!-- ===== Clock Script ===== -->
<script>
function updateClock(){
  document.getElementById('clock').textContent =
      new Date().toLocaleString('en-IN',{hour12:true});
}
updateClock(); setInterval(updateClock,1000);
</script>
</body>
</html>
<?php $conn->close(); ?>

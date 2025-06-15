<?php
/* -----------------------------------------------------------
   view_order.php – Order Manager (status transition)
   Header/footer harmonised with dashboard & admin panel
----------------------------------------------------------- */
$host='localhost';
$db  ='rr_business';
$user='root';
$pass='';
$conn=new mysqli($host,$user,$pass,$db);
if($conn->connect_error) die("Connection failed: ".$conn->connect_error);

/* ---------- Handle status transitions ---------- */
if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['order_id'],$_POST['action'])){
    $orderId = (int)$_POST['order_id'];
    $action  = $_POST['action'];
    if($action==='allocate'){
        $conn->query("UPDATE orders SET status='in_progress' WHERE id=$orderId");
    }elseif($action==='complete'){
        $conn->query("UPDATE orders SET status='completed'  WHERE id=$orderId");
    }
    header('Location: view_order.php'); exit;
}

/* ---------- Fetch orders ---------- */
$result=$conn->query("SELECT * FROM orders ORDER BY order_date DESC");
$serial=1;
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>View Orders - R.R. Business</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
<style>
body{margin:0;font-family:Arial,Helvetica,sans-serif;background:#f5f5f5}
nav{background:#333} nav a{display:inline-block;color:#fff;padding:14px 20px;text-decoration:none}
nav a:hover,nav a.active{background:#575757}
main{padding:20px;max-width:1200px;margin:20px auto;background:#fff;border-radius:5px;box-shadow:0 0 10px rgba(0,0,0,.1)}
h2{color:#a83232;margin-bottom:15px}
table{width:100%;border-collapse:collapse;margin-top:20px}
th,td{border:1px solid #ccc;padding:10px;text-align:center}
th{background:#a83232;color:#fff}
.badge{padding:4px 8px;border-radius:4px;color:#fff;font-size:13px}
.new{background:#ff9800}.prog{background:#2196f3}.done{background:#4caf50}
button{background:#28a745;color:#fff;border:none;padding:6px 12px;border-radius:4px;cursor:pointer}
button:hover{background:#1e7e34}

/* header / footer */
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
     <h1>R.R. Business – Order Details</h1>
     <div class="user-info"><span id="clock"></span></div>
  </div>
</header>

<!-- ===== Navigation ===== -->
<nav>
  <a href="dashboard.php">Dashboard</a>
  <a href="admin_pannel.php">Manage Products</a>
  <a href="view_order.php" class="active">View Orders</a>
  <a href="customer_queries.php">Customer Queries</a>
  <a href="logout.html">Logout</a>
</nav>

<main>
  <h2>Customer Orders</h2>
  <table>
    <tr>
      <th>#</th><th>Customer</th><th>Email</th><th>Phone</th>
      <th>Product</th><th>Qty</th><th>Address</th><th>Status</th><th>Action</th>
    </tr>

    <?php if($result && $result->num_rows): ?>
      <?php while($row=$result->fetch_assoc()):
        $badgeClass = $row['status']==='new'         ? 'new'  :
                      ($row['status']==='in_progress'? 'prog' : 'done');
        $badgeText  = $row['status']==='new'         ? 'New Order' :
                      ($row['status']==='in_progress'? 'In Progress' : 'Completed');
      ?>
      <tr>
        <td><?= $serial++ ?></td>
        <td><?= htmlspecialchars($row['customer_name']) ?></td>
        <td><?= htmlspecialchars($row['email']) ?></td>
        <td><?= htmlspecialchars($row['phone']) ?></td>
        <td><?= htmlspecialchars($row['product_name']) ?></td>
        <td><?= (int)$row['quantity'] ?></td>
        <td><?= htmlspecialchars($row['address']) ?></td>
        <td><span class="badge <?= $badgeClass ?>"><?= $badgeText ?></span></td>
        <td>
          <?php if($row['status']==='new'): ?>
            <form method="post" style="margin:0">
              <input type="hidden" name="order_id" value="<?= $row['id'] ?>">
              <input type="hidden" name="action" value="allocate">
              <button type="submit">Allocate</button>
            </form>
          <?php elseif($row['status']==='in_progress'): ?>
            <form method="post" style="margin:0">
              <input type="hidden" name="order_id" value="<?= $row['id'] ?>">
              <input type="hidden" name="action" value="complete">
              <button type="submit">Mark Completed</button>
            </form>
          <?php else: ?>
            ✅
          <?php endif; ?>
        </td>
      </tr>
      <?php endwhile; ?>
    <?php else: ?>
      <tr><td colspan="9">No orders found.</td></tr>
    <?php endif; ?>
  </table>
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
        <li><a href="admin_pannel.php">Products</a></li>
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

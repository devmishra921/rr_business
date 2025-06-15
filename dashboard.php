<?php
require 'db_connect.php';

/* ---------- helper: live counts ---------- */
function getCounts($conn){
  return [
    'total_products'    => $conn->query("SELECT COUNT(*) FROM products")->fetch_row()[0] ?? 0,
    'new_orders'        => $conn->query("SELECT COUNT(*) FROM orders WHERE status='new'")->fetch_row()[0] ?? 0,
    'in_progress'       => $conn->query("SELECT COUNT(*) FROM orders WHERE status='in_progress'")->fetch_row()[0] ?? 0,
    'completed_orders'  => $conn->query("SELECT COUNT(*) FROM orders WHERE status='completed'")->fetch_row()[0] ?? 0,
    'pending_queries'   => $conn->query("SELECT COUNT(*) FROM message WHERE status='pending'")->fetch_row()[0] ?? 0,
    'completed_queries' => $conn->query("SELECT COUNT(*) FROM message WHERE status='completed'")->fetch_row()[0] ?? 0,
  ];
}

/* ---------- AJAX endpoints ---------- */
if(isset($_GET['counts'])){
   header('Content-Type: application/json');
   echo json_encode(getCounts($conn));
   exit;
}

/* ---------- counts for first paint ---------- */
$init   = getCounts($conn);
$initJS = json_encode($init);

/* ---------- latest 5 orders (ASC display, yet latest records) ---------- */
$ordersRS = $conn->query("
    SELECT *
    FROM (
        SELECT *
        FROM orders
        ORDER BY id DESC          -- सबसे नए 5 उठा लो
        LIMIT 5
    ) AS recent
    ORDER BY id ASC               -- अब उन्हें 1,2,3,4,5 क्रम से दिखाओ
");
$recentOrders = $ordersRS ? $ordersRS->fetch_all(MYSQLI_ASSOC) : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>RR Business Dashboard</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-0y0K+P1BHoAhhbUjhAGwhbA1+w9P8/cD5jxPzfVnTHxDqH+0VYK3vH1s2vl4UWIEDIU1Z8mk6rJ+eoQemZ4h0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
:root{--brand:#a83232;--dark:#333;--light:#f2f2f2}
*{box-sizing:border-box}
body{font-family:Arial,sans-serif;background:var(--light);margin:0}
header{background:var(--brand);color:#fff;padding:10px 20px}
.header-inner{display:flex;align-items:center;justify-content:space-between;max-width:1200px;margin:0 auto}
.logo{height:80px}
header h1{margin:0;font-size:26px;text-align:center;flex:1}
.user-info{font-size:14px;text-align:right;min-width:150px}
nav{background:var(--dark)}
nav ul{margin:0;padding:0;display:flex;flex-wrap:wrap;list-style:none;max-width:1200px;margin:0 auto}
nav a{display:block;color:#fff;padding:14px 20px;text-decoration:none}
nav a:hover,nav .active{background:var(--brand)}
.container{padding:30px;background:#fff;margin:30px auto;max-width:1200px;box-shadow:0 0 10px rgba(0,0,0,.1)}
h2{color:var(--brand);margin-bottom:25px;text-align:center}
.dashboard-cards{display:flex;flex-wrap:wrap;gap:20px;justify-content:center}
.card{flex:1 1 200px;background:#fff;padding:20px;border-top:8px solid var(--brand);border-radius:8px;box-shadow:0 0 5px rgba(0,0,0,.15);text-align:center;position:relative}
.card i{position:absolute;top:-26px;right:10px;font-size:32px;color:var(--brand);opacity:.1}
.card h3{font-size:18px;color:#555;margin:0 0 6px}
.card p{font-size:32px;font-weight:bold;color:var(--brand);margin:0}
.chart-container{max-width:500px;margin:40px auto}
.orders-table{width:100%;border-collapse:collapse}
.orders-table th,.orders-table td{padding:10px;border:1px solid #ddd;text-align:center}
.orders-table th{background:var(--light)}
footer{background:var(--dark);color:#fff;padding:25px 10px;margin-top:60px}
.footer-grid{max-width:1200px;margin:0 auto;display:flex;flex-wrap:wrap;gap:30px}
.footer-col{flex:1 1 200px}
.footer-col h4{margin-top:0;color:#fff;border-bottom:2px solid var(--brand);display:inline-block;padding-bottom:4px}
.footer-col ul{list-style:none;padding:0;margin:10px 0 0}
.footer-col ul li{margin-bottom:6px}
.footer-col a{color:#fff;text-decoration:none}
.footer-col a:hover{text-decoration:underline}
.copyright{text-align:center;margin-top:25px;font-size:14px}
@media(max-width:600px){header h1{font-size:20px}.logo{height:60px}}
.developed-by {
  text-align: center;
  margin-top: 10px;
  font-size: 13px;
  color: #ffcb6b; /* elegant light yellow-orange shade */
}
</style>
</head>
<body>
<!-- ===== Header ===== -->
<header>
  <div class="header-inner">
     <img src="images/Logo.png" alt="R.R. Business Logo" class="logo">
     <h1>R.R. Business – Dashboard</h1>
     <div class="user-info">
         <span id="clock"></span>
     </div>
  </div>
</header>
<!-- ===== Navigation ===== -->
<nav>
 <ul>
   <li><a href="dashboard.php" class="active"><i class="fa fa-chart-line"></i> Dashboard</a></li>
   <li><a href="admin_pannel.php"><i class="fa fa-box"></i> Manage Products</a></li>
   <li><a href="view_order.php"><i class="fa fa-receipt"></i> View Orders</a></li>
   <li><a href="customer_queries.php"><i class="fa fa-comments"></i> Customer Queries</a></li>
   <li><a href="logout.html"><i class="fa fa-sign-out-alt"></i> Logout</a></li>
 </ul>
</nav>
<!-- ===== Main ===== -->
<div class="container">
  <h2>Live Overview</h2>
  <div class="dashboard-cards">
    <div class="card"><i class="fa fa-box"></i><h3>Total Products</h3><p id="total_products"><?=$init['total_products']?></p></div>
    <div class="card"><i class="fa fa-cart-arrow-down"></i><h3>New Orders</h3><p id="new_orders"><?=$init['new_orders']?></p></div>
    <div class="card"><i class="fa fa-tasks"></i><h3>In Progress</h3><p id="in_progress"><?=$init['in_progress']?></p></div>
    <div class="card"><i class="fa fa-check-circle"></i><h3>Completed Orders</h3><p id="completed_orders"><?=$init['completed_orders']?></p></div>
    <div class="card"><i class="fa fa-question-circle"></i><h3>Pending Queries</h3><p id="pending_queries"><?=$init['pending_queries']?></p></div>
    <div class="card"><i class="fa fa-envelope-open-text"></i><h3>Completed Queries</h3><p id="completed_queries"><?=$init['completed_queries']?></p></div>
  </div>

  <!-- Doughnut Chart -->
  <div class="chart-container">
     <canvas id="ordersChart"></canvas>
  </div>

  <!-- Latest Orders Table -->
  <section class="orders-section">
  <h2>Latest 5 Orders</h2>
  <table class="orders-table">
    <thead>
      <tr><th>ID</th><th>Customer</th><th>Amount (₹)</th><th>Status</th><th>Date</th></tr>
    </thead>
    <tbody>
<?php if ($recentOrders): ?>
  <?php foreach ($recentOrders as $o): ?>
    <tr>
      <td><?= $o['id'] ?></td>
      <td><?= htmlspecialchars($o['customer_name'] ?? $o['customer'] ?? '—') ?></td>
      <td><?= $o['total_amount'] ?? $o['amount'] ?? '0' ?></td>
      <td><?= ucfirst(str_replace('_',' ', $o['status'])) ?></td>
      <td>
        <?php
          $date = $o['created_at'] ?? $o['order_date'] ?? null;
          echo $date ? date('d M Y', strtotime($date)) : '—';
        ?>
      </td>
    </tr>
  <?php endforeach; ?>
<?php else: ?>
  <tr><td colspan="5">No recent orders found.</td></tr>
<?php endif; ?>
</tbody>

  </table>
</section>
</div>
<!-- ===== Footer ===== -->
<footer>
  <div class="footer-grid">
     <div class="footer-col">
       <h4>Contact Us</h4>
       <ul>
         <li>Phone: +91 76788 53017</li>
         <li>Email: support@rrbusiness.com</li>
         <li>Email: care@rrbusiness.com</li>
       </ul>
     </div>
     <div class="footer-col">
       <h4>Quick Links</h4>
       <ul>
         <li><a href="dashboard.php">Dashboard</a></li>
         <li><a href="admin_pannel.php">Manage Products</a></li>
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
  <div class="copyright">&copy; <?= date('Y') ?> R.R. Business | All Rights Reserved</div>
  <div class="developed-by">
    Developed by <strong>V.G Technologies Pvt. Ltd.</strong> (Devesh Mishra)
  </div>
</footer>
<!-- ===== Scripts ===== -->
<script>
function refreshCounts(){
  fetch('dashboard.php?counts=1')
    .then(r=>r.json())
    .then(c=>{
      for(const k in c){
        const el=document.getElementById(k);
        if(el) el.textContent=c[k];
      }
      drawChart(c);
    })
    .catch(console.error);
}
function drawChart(data){
  const ctx=document.getElementById('ordersChart');
  if(window.ordersChart){window.ordersChart.destroy();}
  window.ordersChart=new Chart(ctx,{type:'doughnut',data:{labels:['New','In Progress','Completed'],datasets:[{data:[data.new_orders,data.in_progress,data.completed_orders]}]},options:{plugins:{legend:{position:'bottom'}}}});
}
function updateClock(){
   const now=new Date();
   document.getElementById('clock').textContent=now.toLocaleString();
}
updateClock();
setInterval(updateClock,1000);
setInterval(refreshCounts,10000);
drawChart(JSON.parse('<?=$initJS?>'));
</script>
</body>
</html>
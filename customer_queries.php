<?php
require 'db_connect.php';

// AJAX: mark a query completed
if ($_SERVER['REQUEST_METHOD']==='POST' && ($_POST['action'] ?? '')==='complete') {
    $id = intval($_POST['id'] ?? 0);
    $stmt = $conn->prepare("UPDATE message SET status='completed' WHERE id=?");
    $stmt->bind_param('i', $id);
    $ok = $stmt->execute();
    header('Content-Type: application/json');
    echo json_encode(['success'=>$ok]);
    exit;
}

// Fetch list for display
$list   = $conn->query("SELECT * FROM message ORDER BY query_date DESC");
$serial = 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1"/>
<title>Customer Queries - RR Business</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
body{margin:0;font-family:Arial,Helvetica,sans-serif;background:#f2f2f2}
header{background:#a83232;color:#fff;padding:40px;text-align:center;font-size:28px;position:relative}
nav{background:#444;display:flex;flex-wrap:wrap}
nav a{color:#fff;padding:14px 20px;text-decoration:none}
nav a:hover,nav a.active{background:#575757}
.container{padding:20px}
.table-wrap{overflow-x:auto}
table{width:100%;border-collapse:collapse;background:#fff;margin-top:20px}
th,td{border:1px solid #ccc;padding:8px;text-align:center}
th{background:#a83232;color:#fff}
button{background:#28a745;color:#fff;border:none;padding:6px 12px;border-radius:4px;cursor:pointer}
button:hover{background:#218838}
.badge{color:green;font-weight:bold}

/* ---------- Footer styles ---------- */
footer{background:#252525;color:#fff;margin-top:40px}
.footer-grid{display:flex;flex-wrap:wrap;justify-content:space-around;max-width:1200px;margin:0 auto;padding:30px 10px}
.footer-col{flex:1 1 220px;padding:0 20px}
.footer-col h4{margin:0 0 10px;border-bottom:2px solid #a83232;display:inline-block;padding-bottom:4px}
.footer-col ul{list-style:none;margin:0;padding:0}
.footer-col ul li{margin-bottom:6px}
.footer-col a{color:#ccc;text-decoration:none}
.footer-col a:hover{text-decoration:underline;color:#fff}
.copyright{background:#1a1a1a;text-align:center;padding:12px 5px;font-size:14px}
.developed-by{background:#111;text-align:center;padding:8px 5px;font-size:13px;color:#ffcb6b}
</style>
</head>
<body>

<header>
  <img src="images/Logo.png" alt="RR Business Logo" style="height:100px;position:absolute;left:15px;top:5px">
  R.R. Business - Customer Queries
</header>

<nav>
  <a href="dashboard.php">Dashboard</a>
  <a href="admin_pannel.php">Manage Products</a>
  <a href="view_order.php">View Orders</a>
  <a href="customer_queries.php" class="active">Customer Queries</a>
  <a href="logout.html">Logout</a>
</nav>

<div class="container">
  <h2>All Customer Queries</h2>

  <div class="table-wrap">
    <table id="qTbl">
      <thead>
        <tr>
          <th>#</th><th>Name</th><th>Email</th><th>Phone</th><th>Message</th>
          <th>Date</th><th>Status</th><th>Action</th>
        </tr>
      </thead>
      <tbody>
      <?php while($r=$list->fetch_assoc()): ?>
        <tr data-id="<?= $r['id'] ?>">
          <td><?= $serial++ ?></td>
          <td><?= htmlspecialchars($r['customer_name']) ?></td>
          <td><?= htmlspecialchars($r['email']) ?></td>
          <td><?= htmlspecialchars($r['phone']) ?></td>
          <td style="text-align:left"><?= nl2br(htmlspecialchars($r['query_text'])) ?></td>
          <td><?= $r['query_date'] ?></td>
          <td class="status"><?= $r['status'] ?></td>
          <td class="act">
            <?php if($r['status']!=='completed'): ?>
              <button onclick="resolve(this)">Mark Completed</button>
            <?php else: ?>
              <span class="badge">✔</span>
            <?php endif; ?>
          </td>
        </tr>
      <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>

<script>
function resolve(btn){
  const row = btn.closest('tr');
  const id  = row.dataset.id;
  fetch('customer_queries.php',{
    method:'POST',
    headers:{'Content-Type':'application/x-www-form-urlencoded'},
    body:new URLSearchParams({action:'complete',id})
  })
  .then(r=>r.json())
  .then(j=>{
     if(j.success){
       row.querySelector('.status').textContent='completed';
       row.querySelector('.act').innerHTML='<span class="badge">✔</span>';
     }else alert('Update failed!');
  });
}
</script>

<!-- ========== Footer ========== -->
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
        <li><a href="admin_pannel.php">Manage Products</a></li>
        <li><a href="view_order.php">View Orders</a></li>
        <li><a href="customer_queries.php">Customer Queries</a></li>
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
    &copy; <?= date('Y') ?> R.R. Business | All Rights Reserved |
    <a href="https://wa.me/917678853017" style="color:#fff">Click to Chat</a>
  </div>

  <div class="developed-by">
    Developed by <strong>V.G Technologies Pvt. Ltd.</strong> (Devesh Mishra)
  </div>
</footer>

</body>
</html>
<?php $conn->close(); ?>

<?php
if (!isset($_SESSION['admin'])) {
  header("Location: ../login.php");
  exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin - R.R. Business</title>
</head>
<body>
<header style="background:#a83232;color:#fff;padding:10px;">
  <h1>R.R. Business Admin Panel</h1>
  <nav>
    <a href="dashboard.php">Dashboard</a> |
    <a href="manage_products.php">Products</a> |
    <a href="manage_orders.php">Orders</a> |
    <a href="manage_queries.php">Queries</a> |
    <a href="../logout.php">Logout</a>
  </nav>
</header>
<hr>

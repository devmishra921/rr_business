<?php
require 'db_connect.php';   // ← वही कनेक्शन फ़ाइल

/* ───── 1.  Form fields ───── */
$customer = trim($_POST['customer_name'] ?? '');
$email    = trim($_POST['email']         ?? '');
$phone    = trim($_POST['phone']         ?? '');
$product  = trim($_POST['product_name']  ?? '');
$qty      = intval($_POST['quantity']    ?? 1);
$address  = trim($_POST['address']       ?? '');

/* ───── 2.  Basic validation (ज़रूरत पड़ने पर) ───── */
if (!$customer || !$email || !$phone || !$product || !$address) {
    echo "<script>alert('Please fill all required fields.'); history.back();</script>";
    exit;
}

/* ───── 3.  Prepare INSERT  ─────
   Table‑name और हर कॉलम का spelling ठीक‑ठीक वैसा ही जैसा DESCRIBE में है */
$sql = "INSERT INTO `orders`
        (customer_name, email, phone, product_name, quantity, address, status)
        VALUES (?, ?, ?, ?, ?, ?, 'new')";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die('Prepare failed: '.$conn->error);   // dev‑debug, live में हटा सकते हैं
}

/* ───── 4.  bind_param:  s = string, i = int ───── */
$stmt->bind_param('ssssis', $customer, $email, $phone, $product, $qty, $address);

/* ───── 5.  Execute ───── */
if ($stmt->execute()) {
    /* status default 'pending', order_date CURRENT_TIMESTAMP() अपने‑आप भर जायेगा */
    echo "<script>alert('Order placed successfully!'); window.location.href='order.php';</script>";
} else {
    echo 'DB Error: '.$stmt->error;
}

$stmt->close();
$conn->close();
?>

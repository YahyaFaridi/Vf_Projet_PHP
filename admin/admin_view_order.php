<?php
require '../db.php';
require_once '../includes/functions.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = "SELECT * FROM orders WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();
$order = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$order) {
    echo "<p>Order not found.</p>";
    exit;
}

$sql = "SELECT order_items.*, products.name as product_name 
        FROM order_items 
        JOIN products ON order_items.product_id = products.id 
        WHERE order_items.order_id = :order_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':order_id', $id, PDO::PARAM_INT);
$stmt->execute();
$order_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Order</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <?php include 'admin_header.php'; ?>
    <div class="container">
        <h1>Order Details</h1>
        <h3>Order ID: <?= $order['id'] ?></h3>
        <p>User ID: <?= $order['user_id'] ?></p>
        <p>Total: $<?= number_format($order['total'], 2) ?></p>
        <p>Status: <?= $order['status'] ?></p>
        <p>Created At: <?= $order['created_at'] ?></p>

        <h3>Order Items</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($order_items as $item): ?>
                    <tr>
                        <td><?= $item['product_name'] ?></td>
                        <td><?= $item['quantity'] ?></td>
                        <td>$<?= number_format($item['price'], 2) ?></td>
                        <td>$<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php include 'admin_footer.php'; ?>
</body>
</html>

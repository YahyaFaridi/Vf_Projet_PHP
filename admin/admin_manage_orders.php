<?php
require '../db.php';
require_once '../includes/functions.php';

$sql = "SELECT * FROM orders";
$stmt = $conn->prepare($sql);
$stmt->execute();
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <?php include 'admin_header.php'; ?>
    <div class="container">
        <h1>Manage Orders</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Total</th>
                    <th>Created At</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?= $order['id'] ?></td>
                        <td><?= $order['user_id'] ?></td>
                        <td><?= number_format($order['total'], 2) ?></td>
                        <td><?= $order['created_at'] ?></td>
                        <td><?= $order['status'] ?></td>
                        <td>
                            <a href="admin_view_order.php?id=<?= $order['id'] ?>">View</a>
                            <a href="admin_delete_order.php?id=<?= $order['id'] ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php include 'admin_footer.php'; ?>
</body>
</html>

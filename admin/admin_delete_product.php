<?php
require '../db.php';
require_once '../includes/functions.php';

$id = validate_input($_GET['id']);

$sql = "DELETE FROM products WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id);

if ($stmt->execute()) {
    echo "<p>Product deleted successfully.</p>";
} else {
    echo "<p>Error deleting product.</p>";
}

header('Location: admin_manage_products.php');
exit();

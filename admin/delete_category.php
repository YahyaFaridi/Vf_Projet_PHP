<?php
require '../db.php';
require_once '../includes/functions.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    
    $sql = "DELETE FROM categories WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        
        header('Location: admin_manage_categories.php');
        exit();
    } else {
        echo "<p>Error deleting category.</p>";
    }
} else {
    echo "<p>Invalid category ID.</p>";
}
?>

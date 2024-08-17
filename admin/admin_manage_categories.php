<?php
require '../db.php';
require_once '../includes/functions.php';


$sql = "SELECT * FROM categories";
$stmt = $conn->prepare($sql);
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Categories</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <?php include 'admin_header.php'; ?>
    <div class="container">
        <h1>Manage Categories</h1>
        <a href="add_category.php" class="btn btn-primary mb-3">Add New Category</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $category): ?>
                    <tr>
                        <td><?= $category['id'] ?></td>
                        <td><?= $category['name'] ?></td>
                        <td>
                        <a href="edit_category.php?id=<?= $category['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
<a href="delete_category.php?id=<?= $category['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php include 'admin_footer.php'; ?>
</body>
</html>

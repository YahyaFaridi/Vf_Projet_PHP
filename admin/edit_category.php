<?php
require '../db.php';
require_once '../includes/functions.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars(strip_tags($_POST['name']));

    $sql = "UPDATE categories SET name = :name WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        header('Location: admin_manage_categories.php');
        exit();
    } else {
        echo "<p>Error updating category.</p>";
    }
} else {
    $sql = "SELECT * FROM categories WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $category = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$category) {
        echo "<p>Category not found.</p>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <?php include 'admin_header.php'; ?>
    <div class="container">
        <h1>Edit Category</h1>
        <form action="edit_category.php?id=<?= $id ?>" method="post">
            <div class="form-group">
                <label for="name">Category Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $category['name'] ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Category</button>
        </form>
    </div>
    <?php include 'admin_footer.php'; ?>
</body>
</html>

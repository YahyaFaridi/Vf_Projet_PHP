<?php
require '../db.php';
require_once '../includes/functions.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars(strip_tags($_POST['name']));
    $price = htmlspecialchars(strip_tags($_POST['price']));
    $description = htmlspecialchars(strip_tags($_POST['description']));
    $category_id = htmlspecialchars(strip_tags($_POST['category_id']));
    $image = $_FILES['image']['name'];
    $target = "../assets/images/" . basename($image);

    if ($image) {
        $sql = "UPDATE products SET name = :name, price = :price, description = :description, image = :image, category_id = :category_id WHERE id = :id";
    } else {
        $sql = "UPDATE products SET name = :name, price = :price, description = :description, category_id = :category_id WHERE id = :id";
    }
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':category_id', $category_id);
    $stmt->bindParam(':id', $id);

    if ($image) {
        $stmt->bindParam(':image', $image);
    }

    if ($stmt->execute()) {
        if ($image && !move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            echo "Failed to upload image";
        } else {
            header('Location: admin_manage_products.php');
            exit();
        }
    } else {
        echo "Failed to update product";
    }
}

$sql = "SELECT * FROM products WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();
$product = $stmt->fetch(PDO::FETCH_ASSOC);

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
    <title>Edit Product</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <?php include 'admin_header.php'; ?>
    <div class="container">
        <h1>Edit Product</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $product['name'] ?>" required>
            </div>
            <div class="form-group">
                <label for="price">Product Price</label>
                <input type="number" class="form-control" id="price" name="price" value="<?= $product['price'] ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Product Description</label>
                <textarea class="form-control" id="description" name="description" required><?= $product['description'] ?></textarea>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select class="form-control" id="category_id" name="category_id" required>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['id'] ?>" <?= $category['id'] == $product['category_id'] ? 'selected' : '' ?>><?= $category['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="image">Product Image</label>
                <input type="file" class="form-control" id="image" name="image">
                <?php if ($product['image']): ?>
                    <img src="../assets/images/<?= $product['image'] ?>" alt="<?= $product['name'] ?>" style="width: 100px;">
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary">Update Product</button>
        </form>
    </div>
    <?php include 'admin_footer.php'; ?>
</body>
</html>

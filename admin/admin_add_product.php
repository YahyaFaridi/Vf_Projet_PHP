<?php
require '../db.php';
require_once '../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars(strip_tags($_POST['name']));
    $price = htmlspecialchars(strip_tags($_POST['price']));
    $description = htmlspecialchars(strip_tags($_POST['description']));
    $category_id = htmlspecialchars(strip_tags($_POST['category_id']));
    $image = $_FILES['image']['name'];

    $target = "../assets/images/" . basename($image);

    $sql = "INSERT INTO products (name, price, description, image, category_id) 
            VALUES (:name, :price, :description, :image, :category_id)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':image', $image);
    $stmt->bindParam(':category_id', $category_id);

    if ($stmt->execute()) {
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            header('Location: admin_manage_products.php');
            exit();
        } else {
            echo "Failed to upload image";
        }
    } else {
        echo "Failed to add product";
    }
}

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
    <title>Add Product</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <?php include 'admin_header.php'; ?>
    <div class="container">
        <h1>Add Product</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="price">Product Price</label>
                <input type="number" class="form-control" id="price" name="price" required>
            </div>
            <div class="form-group">
                <label for="description">Product Description</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select class="form-control" id="category_id" name="category_id" required>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="image">Product Image</label>
                <input type="file" class="form-control" id="image" name="image" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Product</button>
        </form>
    </div>
    <?php include 'admin_footer.php'; ?>
</body>
</html>

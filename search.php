<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'db.php';


$search = isset($_GET['search']) ? trim($_GET['search']) : '';


$results = [];


if (!empty($search)) {
    
    $sql = "SELECT * FROM products WHERE name LIKE :search";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':search', '%' . $search . '%');
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats de Recherche</title>
    <link rel="stylesheet" href="path/to/bootstrap.css">
</head>
<body>
<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>


<div class="container mt-4">
    <h1>Résultats de Recherche pour "<?php echo htmlspecialchars($search, ENT_QUOTES, 'UTF-8'); ?>"</h1>
    
    <?php if (empty($results)): ?>
        <p>Aucun produit trouvé.</p>
    <?php else: ?>
        <div class="row">
            <?php foreach ($results as $product): ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="assets/images/<?php echo htmlspecialchars($product['image'], ENT_QUOTES, 'UTF-8'); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8'); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8'); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($product['description'], ENT_QUOTES, 'UTF-8'); ?></p>
                            <p class="card-text"><strong><?php echo htmlspecialchars($product['price'], ENT_QUOTES, 'UTF-8'); ?> $</strong></p>
                            <a href="index.php?page=product_detail&id=<?php echo htmlspecialchars($product['id'], ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-primary">Voir le produit</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>
</body>
</html>

<style>
#brandsCarousel .carousel-item img {
    width: 150px;
    height: auto;
    margin: 0 auto;
}
</style>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'includes/functions.php';


$category_id = isset($_GET['category']) ? (int)$_GET['category'] : 0;
$sql = $category_id ? "SELECT * FROM products WHERE category_id = :category_id ORDER BY created_at DESC" : "SELECT * FROM products ORDER BY created_at DESC LIMIT 6";
$stmt = $conn->prepare($sql);
if ($category_id) {
    $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
}
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);


if ($category_id) {
    $sql = "SELECT name FROM categories WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $category_id, PDO::PARAM_INT);
    $stmt->execute();
    $category_name = $stmt->fetchColumn();
}
?>

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="assets/images/banner1.png" alt="First slide">
            <div class="carousel-caption d-none d-md-block">
                
            </div>
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="assets/images/banner2.png" alt="Second slide">
            <div class="carousel-caption d-none d-md-block">
                
            </div>
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="assets/images/banner3.png" alt="Third slide">
            <div class="carousel-caption d-none d-md-block">
                
            </div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<div class="container">
    <h1 class="my-4"><?= $category_id ? $category_name : "Produits récents" ?></h1>

    <div class="row">
        <?php foreach ($products as $product): ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <a href="index.php?page=product_detail&id=<?= $product['id'] ?>"><img class="card-img-top" src="assets/images/<?= $product['image'] ?>" alt=""></a>
                    <div class="card-body">
                        <h4 class="card-title">
                            <a href="index.php?page=product_detail&id=<?= $product['id'] ?>"><?= $product['name'] ?></a>
                        </h4>
                        <h5>$<?= $product['price'] ?></h5>
                        <p class="card-text"><?= $product['description'] ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="container">
<h1 class="my-4"><?= $category_id ? $category_name : "Nos Marques" ?></h1>
<div class="container my-4">
    
    <div class="row">
        <div class="col-lg-2 col-md-3 col-4 mb-4">
            <img src="assets/images/nike_white.jpg" class="img-fluid marque-img" alt="Nike">
        </div>
        <div class="col-lg-2 col-md-3 col-4 mb-4">
            <img src="assets/images/jordan_white.jpg" class="img-fluid marque-img" alt="Jordan">
        </div>
        <div class="col-lg-2 col-md-3 col-4 mb-4">
            <img src="assets/images/converse_white.jpg" class="img-fluid marque-img" alt="Converse">
        </div>
        <div class="col-lg-2 col-md-3 col-4 mb-4">
            <img src="assets/images/puma.png" class="img-fluid marque-img" alt="Puma">
        </div>
        <div class="col-lg-2 col-md-3 col-4 mb-4">
            <img src="assets/images/adidas.png" class="img-fluid marque-img" alt="Nike">
        </div>
        <div class="col-lg-2 col-md-3 col-4 mb-4">
            <img src="assets/images/nw.png" class="img-fluid marque-img" alt="Nike">
        </div>
        
       
        
    </div>
</div>

</div>


       

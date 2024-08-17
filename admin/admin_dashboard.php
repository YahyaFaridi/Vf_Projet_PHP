<?php
require '../db.php';
require_once '../includes/functions.php';

$sql_products = "SELECT COUNT(*) as product_count FROM products";
$stmt_products = $conn->prepare($sql_products);
$stmt_products->execute();
$product_count = $stmt_products->fetch(PDO::FETCH_ASSOC)['product_count'];

$sql_orders = "SELECT COUNT(*) as order_count FROM orders";
$stmt_orders = $conn->prepare($sql_orders);
$stmt_orders->execute();
$order_count = $stmt_orders->fetch(PDO::FETCH_ASSOC)['order_count'];

$sql_categories = "SELECT COUNT(*) as category_count FROM categories";
$stmt_categories = $conn->prepare($sql_categories);
$stmt_categories->execute();
$category_count = $stmt_categories->fetch(PDO::FETCH_ASSOC)['category_count'];

$sql_users = "SELECT COUNT(*) as user_count FROM users";
$stmt_users = $conn->prepare($sql_users);
$stmt_users->execute();
$user_count = $stmt_users->fetch(PDO::FETCH_ASSOC)['user_count'];

$sql_latest_orders = "SELECT id, user_id, total , created_at FROM orders ORDER BY created_at DESC LIMIT 5";
$stmt_latest_orders = $conn->prepare($sql_latest_orders);
$stmt_latest_orders->execute();
$latest_orders = $stmt_latest_orders->fetchAll(PDO::FETCH_ASSOC);

$sql_low_stock = "SELECT COUNT(*) as low_stock_count FROM products WHERE stock < 10";
$stmt_low_stock = $conn->prepare($sql_low_stock);
$stmt_low_stock->execute();
$low_stock_count = $stmt_low_stock->fetch(PDO::FETCH_ASSOC)['low_stock_count'];
?>

<?php include 'admin_header.php'; ?>

<div class="container mt-5">
    <h1 class="text-center">Admin Dashboard</h1>

    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Produits</h5>
                            <p class="card-text"><?= $product_count ?></p>
                        </div>
                        <div>
                            <i class="fas fa-box fa-3x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Commandes</h5>
                            <p class="card-text"><?= $order_count ?></p>
                        </div>
                        <div>
                            <i class="fas fa-shopping-cart fa-3x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Catégories</h5>
                            <p class="card-text"><?= $category_count ?></p>
                        </div>
                        <div>
                            <i class="fas fa-tags fa-3x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Utilisateurs</h5>
                            <p class="card-text"><?= $user_count ?></p>
                        </div>
                        <div>
                            <i class="fas fa-users fa-3x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <h3>Commandes par Mois</h3>
            <canvas id="ordersChart" width="400" height="200"></canvas>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <h3>Dernières Commandes</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID Commande</th>
                        <th>Client</th>
                        <th>Date</th>
                        <th>Montant Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($latest_orders as $order): ?>
                        <tr>
                            <td><?= $order['id'] ?></td>
                            <td><?= $order['user_id'] ?></td>
                            <td><?= $order['created_at'] ?></td>
                            <td><?= $order['total'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php if ($low_stock_count > 0): ?>
        <div class="alert alert-warning mt-4" role="alert">
            Il y a <?= $low_stock_count ?> produits avec un stock faible !
        </div>
    <?php endif; ?>

    <div class="card mt-4">
        <div class="card-body">
            <h3>Rechercher</h3>
            <form method="GET" action="admin_dashboard.php">
                <div class="form-group">
                    <input type="text" name="search" class="form-control" placeholder="Rechercher un produit ou une commande...">
                </div>
                <button type="submit" class="btn btn-primary">Rechercher</button>
            </form>
        </div>
    </div>

    <div class="mt-4">
        <a href="admin_add_product.php" class="btn btn-success">Ajouter un Nouveau Produit</a>
        <a href="admin_manage_orders.php" class="btn btn-info">Voir les Commandes</a>
    </div>
</div>

<?php include 'admin_footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('ordersChart').getContext('2d');
    var ordersChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['January', 'February', 'March', 'April'], 
            datasets: [{
                label: '# of Orders',
                data: [12, 19, 3, 5], 
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

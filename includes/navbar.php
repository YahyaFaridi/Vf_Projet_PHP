<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'db.php';


$sql = "SELECT * FROM categories";
$stmt = $conn->prepare($sql);
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<style>

.navbar {
    display: flex;
    align-items: center;
    justify-content: space-between; 
}

.navbar .navbar-brand {
    margin-right: auto; 
}

.navbar .form-inline {
    flex: 1; 
    justify-content: center;
}

.navbar .navbar-nav {
    margin-left: auto; 
}
.navbar .form-inline .btn-outline-success {
    transition: background-color 0.3s, color 0.3s; 
    background-color: white; 
    color: red; 
    border-color: red; 
}


.navbar .form-inline .btn-outline-success:hover {
    background-color: red; 
    color: white; 
    border-color: red; 
}
</style>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
       
        <a class="navbar-brand" href="index.php">
            <img src="./assets/images/logo2.png" alt="Logo" style="height: 55px;">
        </a>

       
        <form class="form-inline mx-auto" method="GET" action="search.php">
            <input class="form-control mr-sm-2" type="search" name="search" placeholder="Rechercher des produits..." aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
        </form>

        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=home">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Catégories
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php foreach ($categories as $category): ?>
                            <a class="dropdown-item" href="index.php?page=home&category=<?= htmlspecialchars ($category['id'], ENT_QUOTES, 'UTF-8') ?>">
                                <?= htmlspecialchars($category['name'], ENT_QUOTES, 'UTF-8') ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=cart">Panier</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=logout">Déconnexion</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=login">Connexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=register">Inscription</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
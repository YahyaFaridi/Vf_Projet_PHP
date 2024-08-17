
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once 'db.php';
include 'includes/header.php';
include 'includes/navbar.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'home';

switch ($page) {
    case 'home':
        require 'templates/home.php';
        break;
    case 'login':
        require 'templates/login.php';
        break;
    case 'register':
        require 'templates/register.php';
        break;
    case 'cart':
        require 'templates/cart.php';
        break;
    case 'checkout':
        require 'templates/checkout.php';
        break;
    case 'product_detail':
        require 'templates/product_detail.php';
        break;
    case 'success':
        require 'templates/success.php';
        break;
    case 'paypal_payment':
        require 'templates/paypal_payment.php';
        break;
    case 'add_to_cart':
        require 'templates/add_to_cart.php'; 
        break;
    case 'remove_from_cart':
        require 'templates/remove_from_cart.php'; 
        break;
    case 'logout':
        session_destroy();
        header('Location: index.php?page=home');
        break;
    default:
        echo '<h1>Page non trouvée</h1>';
        break;
}
require 'includes/footer.php';
?>

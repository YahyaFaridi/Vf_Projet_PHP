<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

ob_start(); 

require 'db.php';
require 'includes/functions.php';

$url = "index.php?page=home";
$delay = 5; 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement Réussi</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    
    <div class="container">
        <h1 class="my-4">Paiement Réussi</h1>
        <p>Merci pour votre achat ! Vous serez redirigé vers la page d'accueil.</p>
    </div>
   
</body>
</html>

<?php
header("refresh:$delay;url=$url");
ob_end_flush(); 
?>

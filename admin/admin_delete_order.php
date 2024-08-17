<?php
require '../db.php';
require_once '../includes/functions.php';

$id = validate_input($_GET['id']);

$sql = "DELETE FROM orders WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id);

if ($stmt->execute()) {
    echo "<p>Commande supprimée avec succès.</p>";
} else {
    echo "<p>Erreur lors de la suppression de la commande.</p>";
}

header('Location: admin_manage_orders.php');
exit();

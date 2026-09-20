<?php
header('Content-Type: application/json');
include('../server/connection.php'); // connexion à MySQL

$sql = "SELECT product_id, product_name , product_price , product_image  FROM products"; // adapte les noms de colonnes si besoin
$result = $conn->query($sql);

$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

echo json_encode($products);
?>





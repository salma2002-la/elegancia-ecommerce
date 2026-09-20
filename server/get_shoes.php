

<?php
include('connection.php');

$st = $conn->prepare("SELECT  * from products WHERE product_category ='Обувь' LIMIT 6 ");
$st->execute();

$shoes = $st->get_result();

?>
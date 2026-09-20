<!--video 94 (fixing the bugs)-->
<?php
session_start();
include('connection.php');
$conn->set_charset("utf8mb4");

if(isset($_POST['place_order'])){

    // Sécurité : Si l'utilisateur n'est pas connecté, on lui donne un ID par défaut ou on gère l'erreur
    if(!isset($_SESSION['user_id'])){
        // Option A: Rediriger vers login
        // header('location: ../login.php'); exit;
        // Option B: ID temporaire (ex: 0) pour les invités
        $user_id = 0; 
    } else {
        $user_id = $_SESSION['user_id'];
    }

    // 1. Récupération des infos du formulaire
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];
    $adress = $_POST['adress'];

    $order_cost = $_SESSION['total'];
    $order_status = "Not_Paid";
    $order_date = date('Y-m-d H:i:s');

    // 2. Insertion de la commande principale
    $stmt = $conn->prepare("INSERT INTO orders (order_cost, order_status, user_id, user_phone, user_city, user_address, order_date)
                          VALUES (?,?,?,?,?,?,?)");

    // 'isiisss' -> i=int, s=string. Vérifiez bien l'ordre dans votre DB !
    $stmt->bind_param('isiisss', $order_cost, $order_status, $user_id, $phone, $city, $adress, $order_date);

    if($stmt->execute()){
        $order_id = $stmt->insert_id;
        $_SESSION['order_id'] = $order_id; // Très important pour la page de paiement !
    } else {
        // En cas d'erreur technique, on affiche l'erreur au lieu de fuir vers l'index
        die("Erreur SQL lors de la commande : " . $conn->error);
    }

    // 3. Boucle sur le panier pour insérer les articles
    foreach($_SESSION['cart'] as $key => $value){
        $product = $_SESSION['cart'][$key];
        $product_id = $product['product_id'];
        $product_name = $product['product_name'];
        $product_image = $product['product_image'];
        $product_price = $product['product_price'];
        $product_quantity = $product['product_quantity'];

        $stmt1 = $conn->prepare("INSERT INTO order_items (order_id, product_id, product_name, product_image, product_price, product_quantity, user_id, order_date)
                                VALUES (?,?,?,?,?,?,?,?)");

        $stmt1->bind_param('iissiiis', $order_id, $product_id, $product_name, $product_image, $product_price, $product_quantity, $user_id, $order_date);
        $stmt1->execute();
    }

    // 4. Redirection vers le paiement avec l'ID de commande
    header('location: ../payment.php?order_status=order_placed');
    exit;

} else {
    header('location: ../index.php');
    exit;
}
?>
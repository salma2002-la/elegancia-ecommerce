<?php 
session_start();

// -------------------- CART LOGIC -------------------- //

if (isset($_POST['add_to_cart'])) {

    $product_id = $_POST['product_id'];

    $product_array = array(
        'product_id' => $product_id,
        'product_name' => $_POST['product_name'],
        'product_image' => $_POST['product_image'],
        'product_price' => $_POST['product_price'],
        'product_quantity' => isset($_POST['product_quantity']) ? $_POST['product_quantity'] : 1
    );

    if (isset($_SESSION['cart'])) {

        $product_ids = array_column($_SESSION['cart'], 'product_id');

        if (!in_array($product_id, $product_ids)) {
            $_SESSION['cart'][$product_id] = $product_array;
        }

    } else {
        $_SESSION['cart'][$product_id] = $product_array;
    }

    calculate_total_cart();
}

else if (isset($_POST['remove_product'])) {
    $product_id = $_POST['product_id'];
    unset($_SESSION['cart'][$product_id]);
    calculate_total_cart();
}

else if (isset($_POST['edit_quantity'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['product_quantity'];

    $_SESSION['cart'][$product_id]['product_quantity'] = $quantity;
    calculate_total_cart();
}

function calculate_total_cart() {

    $total = 0;

    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $product) {
            $total += $product['product_price'] * $product['product_quantity'];
        }
    }

    $_SESSION['total'] = $total;
}

?>

<?php include('layouts/header.php');?>

<style>

.cart-section{
    background:#f9f9f9;
    padding:80px 0;
}

.cart-card{
    background:#fff;
    border-radius:16px;
    box-shadow:0 10px 30px rgba(0,0,0,0.08);
    padding:40px;
}

.cart-table th{
    font-weight:600;
}

.product-info img {
    width: 120px;
    height: 120px;
    object-fit: cover;
    border-radius: 8px;
}


.remove-btn{
    background:none;
    border:none;
    color:#c0392b;
    font-size:14px;
}

.edit-btn{
    background:#8b5e5e;
    color:#fff;
    border:none;
    padding:6px 12px;
    border-radius:6px;
}

.checkout-btn{
    background:#8b5e5e;
    color:#fff;
    padding:12px 30px;
    border:none;
    border-radius:8px;
    font-weight:600;
}

.continue-btn{
    background:#eee;
    padding:12px 30px;
    border-radius:8px;
    text-decoration:none;
    color:#333;
    font-weight:600;
}
body {
    padding-top: 80px;
}


</style>


<section class="cart-section">
<div class="container">

<div class="cart-card">

<h2 class="mb-4">Ваша корзина</h2>

<?php if(!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0){ ?>

    <p>Корзина пуста.</p>
    <a href="shop.php" class="continue-btn">Продолжить покупки</a>

<?php } else { ?>

<table class="table cart-table">
    <thead>
        <tr>
            <th>Товар</th>
            <th>Количество</th>
            <th>Сумма</th>
        </tr>
    </thead>
    <tbody>

    <?php foreach($_SESSION['cart'] as $value){ ?>

    <tr>
        <td>
            <div class="product-info d-flex align-items-center gap-3">
                <img src="assets/img/<?php echo $value['product_image'];?>">
                <div>
                    <p class="mb-1"><?php echo $value['product_name'];?></p>
                    <small>₽<?php echo $value['product_price'];?></small>

                    <form method="POST" action="cart.php">
                        <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
                        <input type="submit" name="remove_product" class="remove-btn" value="Удалить"/>
                    </form>
                </div>
            </div>
        </td>

        <td>
            <form action="cart.php" method="POST" class="d-flex gap-2">
                <input type="hidden" name="product_id" value="<?php echo $value['product_id'];?>"/>
                <input type="number" name="product_quantity" min="1" value="<?php echo $value['product_quantity']; ?>" class="form-control" style="width:80px;">
                <input type="submit" class="edit-btn" value="Обновить" name="edit_quantity" />
            </form>
        </td>

        <td>
        ₽<?php echo $value['product_quantity'] * $value['product_price'];?>
        </td>
    </tr>

    <?php } ?>

    </tbody>
</table>

<hr>

<div class="d-flex justify-content-between align-items-center mt-4">

    <h4>Итого: ₽<?php echo $_SESSION['total']; ?></h4>

    <div class="d-flex gap-3">
        <a href="shop.php" class="continue-btn">Продолжить покупки</a>

        <form method="POST" action="checkout.php">
            <input type="submit" class="checkout-btn" value="Оформить заказ" name="checkout">
        </form>
    </div>

</div>

<?php } ?>

</div>
</div>
</section>

<?php include('layouts/footer.php');?>

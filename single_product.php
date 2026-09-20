<?php 
include('server/connection.php');

if(isset($_GET['product_id'])){
  $product_id = $_GET['product_id'];

  $statement = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
  $statement->bind_param("i", $product_id);
  $statement->execute();
  $product = $statement->get_result();
} else {
  header('location: index.php');
  exit();
}
?>

<?php include('layouts/header.php'); ?>

<style>
/* Цвета темы */
:root {
  --color-primary: #8b5e5e;
  --color-primary-dark: #6b4444;
  --color-gold: #c9a962;
  --color-cream: #faf7f2;
  --color-dark: #1a1a1a;
}

/* Фон секции - кремовый */
.single-product-section {
  background: var(--color-cream);
  padding: 80px 0;
}

/* Карточка - белая с тенью */
.single-product-card {
  background: #fff;
  border-radius: 16px;
  box-shadow: 0 10px 30px rgba(139, 94, 94, 0.1);
  padding: 50px;
  border: 1px solid rgba(139, 94, 94, 0.05);
}

/* Изображение - без изменений */
.single-product-image img {
  width: 100%;
  max-height: 450px;
  object-fit: contain;
  border-radius: 12px;
}

/* Инфо */
.single-product-info h3 {
  font-weight: 700;
  color: var(--color-dark);
  font-family: 'Playfair Display', serif;
}

.single-product-info .price {
  font-size: 1.8rem;
  font-weight: bold;
  color: var(--color-primary);
}

/* Бейдж категории - золотой */
.badge-category {
  display: inline-block;
  background: var(--color-gold);
  color: #fff;
  padding: 5px 14px;
  border-radius: 20px;
  font-size: 12px;
  margin-bottom: 10px;
  text-transform: uppercase;
  letter-spacing: 1px;
}

/* Кнопка - темная с hover бордовый */
.single-product-info .buy-btn {
  background: var(--color-dark);
  color: #fff;
  padding: 12px 30px;
  border: none;
  border-radius: 30px;
  transition: all 0.3s ease;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 2px;
  font-size: 0.75rem;
}

.single-product-info .buy-btn:hover {
  background: var(--color-primary);
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(139, 94, 94, 0.2);
}

/* Фичи - кремовый фон */
.product-features {
  display: flex;
  gap: 15px;
  margin-top: 25px;
  flex-wrap: wrap;
}

.product-feature {
  display: flex;
  align-items: center;
  gap: 8px;
  background: var(--color-cream);
  padding: 10px 16px;
  border-radius: 20px;
  font-size: 13px;
  color: var(--color-dark);
  border: 1px solid rgba(139, 94, 94, 0.1);
}

.product-feature i {
  color: var(--color-gold);
  font-size: 14px;
}

/* Заголовок описания */
.product-details-title {
  font-weight: 700;
  color: var(--color-dark);
  position: relative;
  padding-left: 12px;
  font-family: 'Playfair Display', serif;
}

.product-details-title::before {
  content: "";
  position: absolute;
  left: 0;
  top: 50%;
  transform: translateY(-50%);
  width: 4px;
  height: 70%;
  background: var(--color-gold);
  border-radius: 2px;
}
</style>

<section class="single-product-section">
  <div class="container">
    <?php while($row = $product->fetch_assoc()) { ?>
      <div class="row single-product-card align-items-center">

        <!-- ИЗОБРАЖЕНИЕ -->
        <div class="col-lg-5 col-md-6 col-sm-12 single-product-image mb-4">
          <img src="assets/img/<?php echo $row['product_image']; ?>" 
               alt="<?php echo htmlspecialchars($row['product_name']); ?>">
        </div>

        <!-- ДЕТАЛИ -->
        <div class="col-lg-7 col-md-6 col-sm-12 single-product-info">
          <span class="badge-category">Новинка</span>
          <h3 class="my-3"><?php echo $row['product_name']; ?></h3>
          <p class="price">₽<?php echo $row['product_price']; ?></p>

          <form method="POST" action="cart.php" class="d-flex align-items-center gap-3 my-4">
            <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?>">
            <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>">

            <input type="number" name="product_quantity" value="1" min="1" class="form-control" style="width:90px; border-radius:8px; border:2px solid rgba(139,94,94,0.2);">
            <button class="buy-btn" type="submit" name="add_to_cart">Добавить в корзину</button>
          </form>

          <h5 class="mt-4 product-details-title">Описание товара</h5>
          <p style="color: #6c757d; line-height: 1.8;"><?php echo $row['product_description']; ?></p>

          <!-- Значки доверия -->
          <div class="product-features">
            <div class="product-feature">
              <i class="fas fa-shipping-fast"></i>
              <span>Быстрая доставка</span>
            </div>

            <div class="product-feature">
              <i class="fas fa-lock"></i>
              <span>Безопасная оплата</span>
            </div>

            <div class="product-feature">
              <i class="fas fa-undo"></i>
              <span>Возврат за 7 дней</span>
            </div>
          </div>

        </div>
      </div>
    <?php } ?>
  </div>
</section>

<?php include('layouts/footer.php'); ?>
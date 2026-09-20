<?php 
session_start();
include('server/connection.php'); 

// 1. Техническая коррекция: Принудительная кодировка UTF-8 для русского языка
$conn->set_charset("utf8mb4"); 

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $order_status = $_GET['order_status'] ?? ""; // Избежать ошибки если не определено

    $stmt = $conn->prepare("SELECT * FROM order_items WHERE order_id = ?");
    $stmt->bind_param('i', $order_id);
    $stmt->execute();
    $order_details = $stmt->get_result();

    // Конвертируем в массив для возможности многократного использования
    $items = $order_details->fetch_all(MYSQLI_ASSOC);
    $total_order_price = calculate_total_order_price($items);
} else {
    header('location: account.php');
    exit();
}

function calculate_total_order_price($items) {
    $total = 0;
    foreach($items as $row){
      $total += ($row['product_price'] * $row['product_quantity']);
    }
    return $total;
}
?>

<?php include('layouts/header.php');?>

<style>
    :root {
        --color-primary: #8b5e5e;
        --color-primary-dark: #6b4444;
        --color-gold: #c9a962;
        --color-cream: #faf7f2;
        --color-dark: #1a1a1a;
        --font-serif: 'Playfair Display', serif;
        --font-sans: 'Inter', sans-serif;
    }

    body { 
        background: linear-gradient(135deg, #f5f0e8 0%, #ebe5d9 100%);
        font-family: var(--font-sans);
    }

    .order-section {
        position: relative;
        overflow: hidden;
        padding: 60px 0;
    }

    .order-section::before {
        content: '';
        position: absolute;
        top: -100px;
        right: -100px;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(201, 169, 98, 0.1) 0%, transparent 70%);
        pointer-events: none;
    }

    /* Заголовок секции */
    .section-header-order {
        text-align: center;
        margin-bottom: 40px;
    }

    .section-label-order {
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 4px;
        color: var(--color-gold);
        font-weight: 600;
        margin-bottom: 15px;
        display: block;
    }

    .section-title-order {
        font-family: var(--font-serif);
        font-size: 2rem;
        color: var(--color-dark);
        font-weight: 400;
        margin-bottom: 10px;
    }

    .divider-luxe {
        width: 50px;
        height: 2px;
        background: var(--color-gold);
        margin: 0 auto;
        border: none;
        opacity: 1;
    }

    .details-container {
        background: #fff;
        border-radius: 20px;
        padding: 50px;
        box-shadow: 0 20px 60px rgba(139, 94, 94, 0.08);
        border: 1px solid rgba(139, 94, 94, 0.05);
        position: relative;
        z-index: 2;
    }

    .order-header h2 { 
        font-family: var(--font-serif);
        font-weight: 500; 
        color: var(--color-dark); 
        font-size: 1.8rem; 
    }

    .order-header hr { 
        width: 60px; 
        border: 2px solid var(--color-gold); 
        opacity: 1; 
        margin-bottom: 30px; 
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        color: var(--color-gray);
        text-decoration: none;
        font-size: 0.85rem;
        margin-bottom: 30px;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    .back-link:hover {
        color: var(--color-primary);
        transform: translateX(-5px);
    }
    
    .details-table { 
        width: 100%; 
        border-collapse: collapse; 
        margin-top: 30px; 
    }

    .details-table th { 
        background: var(--color-cream); 
        color: var(--color-dark); 
        padding: 18px 15px; 
        text-transform: uppercase; 
        font-size: 0.7rem; 
        letter-spacing: 2px;
        font-weight: 600;
        text-align: center;
        border-bottom: 2px solid rgba(139, 94, 94, 0.1);
    }

    .details-table td { 
        padding: 25px 15px; 
        border-bottom: 1px solid rgba(139, 94, 94, 0.05); 
        text-align: center; 
        vertical-align: middle; 
        color: var(--color-gray);
    }

    .details-table tr:hover td {
        background: rgba(139, 94, 94, 0.02);
    }
    
    .product-img { 
        width: 80px; 
        height: 80px; 
        object-fit: cover; 
        border-radius: 12px; 
        border: 1px solid rgba(139, 94, 94, 0.1); 
        margin-right: 20px; 
    }

    .product-name { 
        font-weight: 600; 
        color: var(--color-dark); 
        margin: 0; 
        font-size: 1rem;
    }

    .product-category {
        font-size: 0.75rem;
        color: var(--color-gold);
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-top: 5px;
    }
    
    .price-tag { 
        font-weight: 700; 
        color: var(--color-primary);
        font-size: 1rem;
    }

    .qty-badge { 
        background: var(--color-cream); 
        padding: 8px 16px; 
        border-radius: 50px; 
        font-size: 0.85rem;
        color: var(--color-dark);
        font-weight: 600;
        border: 1px solid rgba(139, 94, 94, 0.1);
    }

    .total-cell {
        font-weight: 700;
        color: var(--color-dark);
        font-size: 1.1rem;
    }
    
    .btn-pay {
        background-color: var(--color-dark); 
        color: white; 
        border-radius: 30px;
        padding: 16px 45px; 
        border: none; 
        transition: all 0.4s ease; 
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-size: 0.75rem;
        position: relative;
        overflow: hidden;
    }

    .btn-pay::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: var(--color-primary);
        transition: all 0.4s ease;
        z-index: -1;
    }

    .btn-pay:hover::before {
        left: 0;
    }

    .btn-pay:hover { 
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(139, 94, 94, 0.3);
    }
    
    .total-section { 
        margin-top: 40px; 
        border-top: 2px solid var(--color-cream); 
        padding-top: 30px; 
        text-align: right; 
    }

    .total-label {
        font-size: 1rem;
        color: var(--color-gray);
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 10px;
    }

    .total-price {
        font-family: var(--font-serif);
        font-size: 2.5rem;
        color: var(--color-primary);
        font-weight: 600;
    }

    .total-price span {
        font-size: 1rem;
        color: var(--color-gray);
        font-weight: 400;
    }

    .status-paid {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(40, 167, 69, 0.1);
        color: #155724;
        padding: 10px 20px;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 20px;
    }

    .status-paid i {
        color: #28a745;
    }

    /* Адаптивность */
    @media (max-width: 768px) {
        .details-container {
            padding: 25px;
        }

        .section-title-order {
            font-size: 1.5rem;
        }

        .details-table th,
        .details-table td {
            padding: 15px 10px;
            font-size: 0.85rem;
        }

        .product-img {
            width: 60px;
            height: 60px;
        }

        .total-price {
            font-size: 1.8rem;
        }
    }
</style>

<section class="order-section my-5 py-5">
    <div class="container">
        <!-- Заголовок -->
        <div class="section-header-order">
            <span class="section-label-order">Информация о заказе</span>
            <h2 class="section-title-order">Детали заказа #<?php echo $order_id; ?></h2>
            <hr class="divider-luxe">
        </div>

        <div class="details-container">
            <!-- Назад -->
            <a href="account.php" class="back-link">
                <i class="fas fa-arrow-left"></i>
                Назад к заказам
            </a>

            <!-- Статус оплачен -->
            <?php if($order_status != "Not_Paid"): ?>
                <div class="text-center">
                    <span class="status-paid">
                        <i class="fas fa-check-circle"></i>
                        Оплачено
                    </span>
                </div>
            <?php endif; ?>

            <table class="details-table">
                <thead>
                    <tr>
                        <th style="text-align: left; padding-left: 25px;">Продукт</th>
                        <th>Цена</th>
                        <th>Количество</th>
                        <th>Итого</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($items as $row){ ?>
                    <tr>
                        <td style="text-align: left; padding-left: 25px;">
                            <div class="d-flex align-items-center">
                                <img class="product-img" src="assets/img/<?php echo $row['product_image']; ?>" alt="<?php echo $row['product_name']; ?>">
                                <div>
                                    <p class="product-name"><?php echo $row['product_name']; ?></p>
                                    <p class="product-category">Товар</p>
                                </div>
                            </div>
                        </td>
                        <td><span class="price-tag">$<?php echo $row['product_price']; ?></span></td>
                        <td><span class="qty-badge"><?php echo $row['product_quantity']; ?></span></td>
                        <td class="total-cell">$<?php echo ($row['product_price'] * $row['product_quantity']); ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>

            <div class="total-section">
                <p class="total-label">Общая сумма заказа</p>
                <p class="total-price">$<?php echo $total_order_price; ?> <span>USD</span></p>
                
                <?php if($order_status == "Not_Paid"){ ?>
                    <form class="mt-4" method="POST" action="payment.php">
                        <input type="hidden" name="total_order_price" value="<?php echo $total_order_price; ?>"/>
                        <input type="hidden" name="order_status" value="<?php echo $order_status; ?>" >
                        <input type="hidden" name="order_id" value="<?php echo $order_id; ?>"/>
                        <input type="submit" name="orderpaybutton" class="btn-pay" value="Оплатить сейчас"/>
                    </form>
                <?php } else { ?>
                    <div class="mt-4">
                        <span style="color: var(--color-gold); font-size: 0.9rem; text-transform: uppercase; letter-spacing: 2px;">
                            <i class="fas fa-check-circle me-2"></i>
                            Заказ оплачен
                        </span>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>

<?php include('layouts/footer.php');?>
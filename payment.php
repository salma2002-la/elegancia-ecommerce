<?php
session_start();

// 1. ПОЛУЧЕНИЕ: Проверяем, пришли ли мы от кнопки (POST)
// или от автоматического перенаправления (SESSION)
if (isset($_POST['orderpaybutton'])) {
    $_SESSION['total'] = $_POST['total_order_price'];
    $_SESSION['order_status'] = $_POST['order_status'];
    $_SESSION['order_id'] = $_POST['order_id'];
}

// 2. ПРОВЕРКА: Убеждаемся, что переменные присутствуют для отображения
$order_status = $_SESSION['order_status'] ?? null;
$total = $_SESSION['total'] ?? 0;
$order_id = $_SESSION['order_id'] ?? null;

include('layouts/header.php'); 
?>

<script src="https://www.paypal.com/sdk/js?client-id=Ac5U3ORpvoCWvfihTA6sU9V_5fJ7Bomxy_6IHD__KOn7W6SuRKsprXiwChSj2JPlDxr3qN8LsYQjdv60&currency=RUB"></script>

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
        color: var(--color-dark);
    }

    .payment-section { 
        padding: 80px 0; 
        min-height: 70vh;
        position: relative;
        overflow: hidden;
    }

    .payment-section::before {
        content: '';
        position: absolute;
        top: -100px;
        right: -100px;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(201, 169, 98, 0.1) 0%, transparent 70%);
        pointer-events: none;
    }

    .payment-card {
        background: #ffffff;
        max-width: 600px;
        margin: 0 auto;
        padding: 60px;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(139, 94, 94, 0.1);
        border: 1px solid rgba(139, 94, 94, 0.05);
        text-align: center;
        position: relative;
        z-index: 2;
    }

    /* Заголовок */
    .section-label-payment {
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 4px;
        color: var(--color-gold);
        font-weight: 600;
        margin-bottom: 15px;
        display: block;
    }

    .section-title-payment {
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
        margin: 0 auto 40px;
        border: none;
        opacity: 1;
    }

    .amount-display {
        background: var(--color-cream);
        padding: 40px;
        border-radius: 20px;
        margin: 40px 0;
        border: 2px dashed rgba(139, 94, 94, 0.2);
        position: relative;
    }

    .amount-display::before {
        content: '💳';
        position: absolute;
        top: -20px;
        left: 50%;
        transform: translateX(-50%);
        width: 40px;
        height: 40px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .amount-label {
        color: var(--color-gray);
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 3px;
        margin-bottom: 15px;
        font-weight: 500;
    }

    .amount-value {
        font-family: var(--font-serif);
        font-size: 3rem;
        color: var(--color-primary);
        margin: 0;
        font-weight: 600;
    }

    .amount-currency {
        font-size: 1.2rem;
        color: var(--color-gray);
        font-weight: 400;
    }

    .order-number {
        margin-top: 15px;
        color: var(--color-gray);
        font-size: 0.9rem;
    }

    .order-number strong {
        color: var(--color-dark);
        font-weight: 600;
    }

    .payment-info {
        font-size: 0.95rem;
        margin-bottom: 30px;
        color: var(--color-gray);
        line-height: 1.6;
    }

    #paypal-button-container { 
        margin-top: 30px; 
    }

    /* Стилизация кнопки PayPal */
    #paypal-button-container iframe {
        border-radius: 30px !important;
    }

    /* Пустая корзина */
    .no-payment { 
        padding: 40px 20px; 
    }

    .no-payment-icon {
        width: 80px;
        height: 80px;
        background: var(--color-cream);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 30px;
        font-size: 2rem;
    }

    .no-payment h2 {
        font-family: var(--font-serif);
        font-size: 1.8rem;
        color: var(--color-dark);
        margin-bottom: 15px;
        font-weight: 400;
    }

    .no-payment p {
        color: var(--color-gray);
        margin-bottom: 25px;
    }

    .btn-back-shop {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: var(--color-dark);
        color: white;
        padding: 14px 30px;
        border-radius: 30px;
        text-decoration: none;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-weight: 600;
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
    }

    .btn-back-shop::before {
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

    .btn-back-shop:hover::before {
        left: 0;
    }

    .btn-back-shop:hover {
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(139, 94, 94, 0.3);
    }

    /* Безопасность */
    .security-badges {
        display: flex;
        justify-content: center;
        gap: 30px;
        margin-top: 40px;
        padding-top: 30px;
        border-top: 1px solid rgba(139, 94, 94, 0.1);
    }

    .security-badge {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.8rem;
        color: var(--color-gray);
    }

    .security-badge i {
        color: var(--color-gold);
        font-size: 1.1rem;
    }

    /* Адаптивность */
    @media (max-width: 768px) {
        .payment-card {
            padding: 40px 25px;
            margin: 0 20px;
        }

        .amount-value {
            font-size: 2.2rem;
        }

        .section-title-payment {
            font-size: 1.6rem;
        }
    }
</style>

<section class="payment-section">
    <div class="payment-card">
        
        <?php if ($total > 0) { ?>
            
            <span class="section-label-payment">Оплата</span>
            <h2 class="section-title-payment">Завершите покупку</h2>
            <hr class="divider-luxe">

            <div class="amount-display">
                <p class="amount-label">Итого к оплате</p>
                <h3 class="amount-value">
                ₽<?php echo number_format($total, 2); ?>
                    <span class="amount-currency">RUB</span>
                </h3>
                <?php if($order_id): ?>
                    <p class="order-number">Заказ <strong>#<?php echo $order_id; ?></strong></p>
                <?php endif; ?>
            </div>

            <p class="payment-info">
                Вы будете перенаправлены на защищенный сервер PayPal для завершения оплаты.
                Все данные передаются по защищенному соединению.
            </p>

            <div id="paypal-button-container"></div>

            <div class="security-badges">
                <div class="security-badge">
                    <i class="fas fa-lock"></i>
                    <span>SSL Защита</span>
                </div>
                <div class="security-badge">
                    <i class="fas fa-shield-alt"></i>
                    <span>Безопасная оплата</span>
                </div>
            </div>

            <script>
                paypal.Buttons({
                    style: {
                        shape: 'pill',
                        color: 'gold',
                        layout: 'vertical',
                        label: 'pay'
                    },
                    createOrder: function(data, actions) {
                        return actions.order.create({
                            purchase_units: [{
                                amount: {
                                    value: '<?php echo $total; ?>'
                                }
                            }]
                        });
                    },
                    onApprove: function(data, actions) {
                        return actions.order.capture().then(function(details) {
                            window.location.href = 'success_payment.php?order_id=<?php echo $order_id; ?>';
                        });
                    }
                }).render('#paypal-button-container');
            </script>

        <?php } else { ?>
            <div class="no-payment">
                <div class="no-payment-icon">🛒</div>
                <h2>Ваша корзина пуста</h2>
                <p>У вас нет активных заказов для оплаты.</p>
                <a href="shop.php" class="btn-back-shop">
                    <i class="fas fa-arrow-left"></i>
                    Вернуться в магазин
                </a>
            </div>
        <?php } ?>

    </div>
</section>

<?php include('layouts/footer.php'); ?>
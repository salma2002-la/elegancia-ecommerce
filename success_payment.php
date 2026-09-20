<?php
session_start();
include('server/connection.php');

// On récupère l'ID avant de vider la session
$order_id = $_SESSION['order_id'] ?? null;

if ($order_id) {
    // Mise à jour du statut en "Paid" (Payé)
    $stmt = $conn->prepare("UPDATE orders SET order_status = 'Paid' WHERE order_id = ?");
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $stmt->close();

    // NETTOYAGE DU PANIER (On vide le panier car la vente est finie)
    unset($_SESSION['cart']);
    unset($_SESSION['total']);
    // On garde l'order_id juste pour l'affichage ci-dessous, puis on nettoie
}
?>

<?php include('layouts/header.php'); ?>

<style>
    :root {
        --color-primary: #8b5e5e;
        --color-primary-dark: #6b4444;
        --color-gold: #c9a962;
        --color-cream: #faf7f2;
        --color-dark: #1a1a1a;
        --color-success: #28a745;
        --font-serif: 'Playfair Display', serif;
        --font-sans: 'Inter', sans-serif;
    }

    body { 
        background: linear-gradient(135deg, #f5f0e8 0%, #ebe5d9 100%);
        font-family: var(--font-sans);
    }
    
    .success-section { 
        padding: 100px 0; 
        min-height: 80vh;
        position: relative;
        overflow: hidden;
    }

    .success-section::before {
        content: '';
        position: absolute;
        top: -100px;
        right: -100px;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(40, 167, 69, 0.08) 0%, transparent 70%);
        pointer-events: none;
    }

    .success-section::after {
        content: '';
        position: absolute;
        bottom: -100px;
        left: -100px;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(201, 169, 98, 0.1) 0%, transparent 70%);
        pointer-events: none;
    }
    
    .success-card {
        background: #ffffff;
        max-width: 600px;
        margin: 0 auto;
        padding: 70px 50px;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(139, 94, 94, 0.1);
        border: 1px solid rgba(139, 94, 94, 0.05);
        text-align: center;
        position: relative;
        z-index: 2;
    }

    .success-icon-wrapper {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 30px;
        position: relative;
    }

    .success-icon-wrapper::before {
        content: '';
        position: absolute;
        inset: -10px;
        border: 2px solid rgba(40, 167, 69, 0.2);
        border-radius: 50%;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% { transform: scale(1); opacity: 1; }
        100% { transform: scale(1.2); opacity: 0; }
    }

    .success-icon {
        font-size: 3rem;
        color: var(--color-success);
    }

    .section-label-success {
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 4px;
        color: var(--color-success);
        font-weight: 600;
        margin-bottom: 15px;
        display: block;
    }

    .success-card h2 {
        font-family: var(--font-serif);
        font-size: 2.2rem;
        color: var(--color-dark);
        margin-bottom: 20px;
        font-weight: 400;
    }

    .success-message {
        color: var(--color-gray);
        font-size: 1rem;
        line-height: 1.8;
        margin-bottom: 30px;
    }

    .success-message strong {
        color: var(--color-primary);
        font-weight: 600;
    }

    .order-number-box {
        background: var(--color-cream);
        border: 2px dashed rgba(139, 94, 94, 0.2);
        padding: 20px 40px;
        border-radius: 15px;
        display: inline-block;
        margin: 20px 0 30px;
    }

    .order-label {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: var(--color-gray);
        margin-bottom: 8px;
        display: block;
    }

    .order-number {
        font-family: var(--font-serif);
        font-size: 1.8rem;
        color: var(--color-primary);
        font-weight: 600;
    }

    .btn-group {
        display: flex;
        flex-direction: column;
        gap: 15px;
        margin-top: 40px;
    }

    .btn-account {
        background-color: transparent;
        color: var(--color-dark);
        border: 2px solid var(--color-dark);
        padding: 16px 30px;
        border-radius: 30px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        transition: all 0.4s ease;
    }

    .btn-account:hover { 
        background-color: var(--color-dark);
        color: white;
        transform: translateY(-3px);
    }

    .btn-view-order {
        background-color: var(--color-dark);
        color: white;
        padding: 16px 30px;
        border-radius: 30px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
    }

    .btn-view-order::before {
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

    .btn-view-order:hover::before {
        left: 0;
    }

    .btn-view-order:hover { 
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(139, 94, 94, 0.3);
    }

    .confirmation-note {
        margin-top: 40px;
        padding-top: 30px;
        border-top: 1px solid rgba(139, 94, 94, 0.1);
        font-size: 0.9rem;
        color: var(--color-gray);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .confirmation-note i {
        color: var(--color-gold);
    }

    /* Адаптивность */
    @media (max-width: 768px) {
        .success-card {
            padding: 50px 30px;
            margin: 0 20px;
        }

        .success-card h2 {
            font-size: 1.8rem;
        }

        .order-number {
            font-size: 1.5rem;
        }
    }
</style>

<section class="success-section">
    <div class="success-card">
        <div class="success-icon-wrapper">
            <i class="fas fa-check success-icon"></i>
        </div>
        
        <span class="section-label-success">Успешно</span>
        <h2>Оплата прошла успешно!</h2>
        
        <p class="success-message">
            Спасибо за покупку в <strong>Élégancia</strong>.<br>
            Мы уже начали работу над вашим заказом.
        </p>

        <?php if ($order_id): ?>
            <div class="order-number-box">
                <span class="order-label">Номер заказа</span>
                <div class="order-number">#<?php echo $order_id; ?></div>
            </div>
        <?php endif; ?>

        <div class="btn-group">
            <a href="account.php" class="btn-account">Мои заказы</a>
            <a href="index.php" class="btn-view-order">Вернуться в магазин</a>
        </div>
        
        <div class="confirmation-note">
            <i class="fas fa-envelope"></i>
            Подтверждение заказа было отправлено на ваш электронный адрес
        </div>
    </div>
</section>

<?php 
// Maintenant on peut vider le reste
unset($_SESSION['order_id']);
unset($_SESSION['order_status']);
include('layouts/footer.php'); 
?>
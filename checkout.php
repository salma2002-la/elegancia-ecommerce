<?php
session_start();

/* On vérifie si le panier est vide. 
   On ne vérifie le bouton 'checkout' QUE si on ne vient pas de soumettre le formulaire actuel.
*/
if(empty($_SESSION['cart'])) {
    header('location: index.php');
    exit;
}

// Si l'utilisateur n'arrive ni du panier, ni n'est en train de valider sa commande
if(!isset($_POST['checkout']) && !isset($_POST['place_order'])) {
     header('location: index.php');
     exit;
}
?>

<?php include('layouts/header.php');?>

<style>
    :root {
        --primary-color: #8b5e5e; 
        --bg-light: #f9f9f9;
        --text-dark: #333;
        --text-muted: #777;
        --white: #ffffff;
        --shadow: 0 10px 30px rgba(0,0,0,0.05);
    }

    body {
        background-color: var(--bg-light);
        color: var(--text-dark);
        font-family: 'Inter', sans-serif;
    }

    .checkout-section {
        padding: 60px 0;
    }

    /* Conteneur principal symétrique */
    .checkout-container {
        display: flex;
        flex-wrap: wrap;
        gap: 30px;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        align-items: stretch; /* Force les deux colonnes à avoir la même hauteur si possible */
    }

    .section-header {
        width: 100%;
        margin-bottom: 40px;
    }

    .section-header h2 {
        text-transform: uppercase;
        letter-spacing: 2px;
        font-weight: 700;
        margin: 0;
    }

    .section-header hr {
        width: 60px;
        border: 2px solid var(--primary-color);
        margin: 15px 0 0 0;
    }

    /* Colonne Gauche (Formulaire) */
    .checkout-left {
        flex: 1 1 600px;
    }

    /* Colonne Droite (Résumé) */
    .checkout-right {
        flex: 0 0 400px;
    }

    .checkout-box {
        background: var(--white);
        padding: 40px;
        border-radius: 15px;
        box-shadow: var(--shadow);
        height: 100%; /* Pour la symétrie */
        box-sizing: border-box;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .full-width { grid-column: 1 / -1; }

    .form-group label {
        display: block;
        font-size: 0.8rem;
        font-weight: 700;
        margin-bottom: 8px;
        text-transform: uppercase;
        color: var(--text-muted);
    }

    .form-control {
        width: 100%;
        padding: 15px;
        border: 1px solid #eee;
        border-radius: 10px;
        font-size: 0.95rem;
        transition: 0.3s;
        box-sizing: border-box;
        color: var(--text-dark);
    }

    .form-control:focus {
        border-color: var(--primary-color);
        outline: none;
    }

    /* Désactiver le bleu sur les liens du panier */
    #order-summary a, .item-info h6 {
        color: var(--text-dark) !important;
        text-decoration: none !important;
    }

    .order-item {
        display: flex;
        gap: 15px;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 1px solid #f9f9f9;
    }

    .order-item img {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border-radius: 8px;
        background: #f1f1f1;
    }

    .item-info h6 {
        margin: 0 0 5px 0;
        font-size: 0.9rem;
        line-height: 1.2;
    }

    .item-info small { color: var(--text-muted); }

    .total-row {
        display: flex;
        justify-content: space-between;
        font-size: 1.2rem;
        font-weight: 700;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 2px solid #eee;
    }

    .btn-checkout {
        background-color: var(--primary-color);
        color: white;
        border: none;
        width: 100%;
        padding: 20px;
        border-radius: 12px;
        font-weight: 700;
        text-transform: uppercase;
        cursor: pointer;
        margin-top: 30px;
        transition: 0.3s;
        letter-spacing: 1px;
    }

    .btn-checkout:hover {
        background-color: #6d4a4a;
        transform: translateY(-2px);
    }

    @media (max-width: 992px) {
        .checkout-right { flex: 1 1 100%; }
        .checkout-container { flex-direction: column; }
    }
</style>

<section class="checkout-section">
    <div class="checkout-container">
        
        <div class="section-header">
            <h2>Оформление заказа</h2>
            <hr>
        </div>

        <div class="checkout-left">
            <div class="checkout-box">
                <form id="checkout-form" method="POST" action="server/place_order.php">
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Полное имя</label>
                            <input type="text" class="form-control" name="name" placeholder="Иван Иванов" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" placeholder="ivan@example.com" required>
                        </div>
                        <div class="form-group">
                            <label>Телефон</label>
                            <input type="tel" class="form-control" name="phone" placeholder="+7 (900) 000-00-00" required>
                        </div>
                        <div class="form-group">
                            <label>Город</label>
                            <input type="text" class="form-control" name="city" placeholder="Москва" required>
                        </div>
                        <div class="form-group full-width">
                            <label>Адрес доставки</label>
                            <input type="text" class="form-control" name="adress" placeholder="Улица, дом, квартира" required>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="checkout-right">
            <div class="checkout-box">
                <h4 style="margin-top:0; margin-bottom:25px;">Ваш заказ</h4>
                
                <div id="order-summary">
                    </div>
                
                <div class="total-row">
                    <span>Итого</span>
                    <span>₽ <?php echo number_format($_SESSION['total'], 2); ?></span>
                </div>

                <button type="submit" form="checkout-form" name="place_order" class="btn-checkout">
                Подтвердить и перейти к оплате
                </button>
            </div>
        </div>

    </div>
</section>

<script>
const cart = <?php echo json_encode($_SESSION['cart']); ?>;

function updateOrderSummary() {
    const orderSummary = document.getElementById('order-summary');
    let itemsHTML = '';
    
    Object.values(cart).forEach(item => {
        let totalAdjustment = 0;
        let optionsHTML = '';

        if (item.selected_options && item.selected_options.length > 0) {
            optionsHTML = '<div style="font-size: 0.75rem; color: #999; margin-top: 4px;">';
            item.selected_options.forEach(opt => {
                totalAdjustment += parseFloat(opt.price_adjustment) || 0;
                optionsHTML += `<div>${opt.option_name}: ${opt.value_name}</div>`;
            });
            optionsHTML += '</div>';
        }

        const adjustedPrice = parseFloat(item.product_price) + totalAdjustment;
        
        itemsHTML += `
            <div class="order-item">
                <img src="assets/img/${item.product_image}" alt="${item.product_name}">
                <div class="item-info">
                    <h6>${item.product_name}</h6>
                    <small>Кол-во: ${item.product_quantity} — ₽${adjustedPrice.toFixed(2)}</small>
                    ${optionsHTML}
                </div>
            </div>
        `;
    });

    orderSummary.innerHTML = itemsHTML;
}

updateOrderSummary();
</script>

<?php include('layouts/footer.php');?>
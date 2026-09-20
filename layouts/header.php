<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Élégancia - Дом Моды</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,500;0,600;1,400&display=swap" rel="stylesheet">

    <style>
        :root {
            --color-primary: #8b5e5e;
            --color-primary-dark: #6b4444;
            --color-gold: #c9a962;
            --color-cream: #faf7f2;
            --color-dark: #1a1a1a;
            --color-gray: #6c757d;
            --font-serif: 'Playfair Display', serif;
            --font-sans: 'Inter', sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--font-sans);
            background-color: var(--color-cream);
            color: var(--color-dark);
            overflow-x: hidden;
            padding-top: 80px;
        }

        /* ================= СТАТИЧНЫЙ РОСКОШНЫЙ ЗАГОЛОВОК ================= */
        .navbar-elegancia {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            background: #ffffff;
            padding: 18px 0;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
            border-bottom: 1px solid rgba(139, 94, 94, 0.1);
        }

        /* Логотип */
        .brand-text {
            font-family: var(--font-serif);
            font-size: 26px;
            letter-spacing: 5px;
            font-weight: 500;
            color: var(--color-dark);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .brand-text:hover {
            color: var(--color-primary);
        }

        /* НАВИГАЦИОННЫЕ ССЫЛКИ */
        .nav-link-luxe {
            color: var(--color-dark) !important;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 500;
            margin: 0 18px;
            padding: 8px 0 !important;
            position: relative;
            text-decoration: none;
            transition: all 0.3s ease;
            opacity: 0.85;
        }

        .nav-link-luxe:hover {
            color: var(--color-primary) !important;
            opacity: 1;
        }

        /* Анимированное подчеркивание */
        .nav-link-luxe::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--color-gold);
            transition: width 0.3s ease;
        }

        .nav-link-luxe:hover::after {
            width: 100%;
        }

        /* Активная ссылка */
        .nav-link-luxe.active {
            color: var(--color-primary) !important;
            opacity: 1;
        }

        .nav-link-luxe.active::after {
            width: 100%;
            background: var(--color-primary);
        }

        /* ИКОНКИ */
        .nav-icon {
            color: var(--color-dark) !important;
            font-size: 1.2rem;
            transition: all 0.3s ease;
            position: relative;
            text-decoration: none;
            margin-left: 22px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        .nav-icon:hover {
            background: rgba(139, 94, 94, 0.1);
            color: var(--color-primary) !important;
            transform: scale(1.1);
        }

        /* Значок корзины */
        .cart-badge {
            position: absolute;
            top: -2px;
            right: -2px;
            background: var(--color-gold);
            color: white;
            font-size: 0.65rem;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-family: var(--font-sans);
            border: 2px solid white;
        }

        /* Аватар пользователя - DORÉ */
        .user-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: var(--color-gold);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            margin-left: 15px;
        }

        .user-avatar:hover {
            border-color: var(--color-primary);
            transform: scale(1.05);
            color: white;
        }

        /* Мобильное меню */
        .navbar-toggler-luxe {
            border: none;
            color: var(--color-dark);
            font-size: 1.5rem;
            background: transparent;
            padding: 8px;
            margin-left: 10px;
        }

        .navbar-toggler-luxe:focus {
            box-shadow: none;
        }

        /* Открытое мобильное меню */
        .mobile-menu {
            background: white;
            padding: 20px;
            margin-top: 15px;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            border: 1px solid rgba(0,0,0,0.05);
        }

        .mobile-menu .nav-link-luxe {
            margin: 12px 0;
            display: block;
            padding: 10px 0 !important;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }

        /* Адаптивность */
        @media (max-width: 992px) {
            .brand-text {
                font-size: 22px;
                letter-spacing: 3px;
            }
        }

        @media (max-width: 768px) {
            body {
                padding-top: 70px;
            }
            
            .navbar-elegancia {
                padding: 12px 0;
            }
            
            .brand-text {
                font-size: 20px;
            }
            
            .nav-icon {
                width: 35px;
                height: 35px;
                margin-left: 10px;
            }
        }
    </style>
</head>

<body>

<!-- Статическая Навигация -->
<nav class="navbar-elegancia">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center w-100">
            
            <!-- Меню слева для десктопа -->
            <div class="d-none d-lg-flex align-items-center">
                <a href="index.php" class="nav-link-luxe <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">Главная</a>
                <a href="shop.php" class="nav-link-luxe <?php echo basename($_SERVER['PHP_SELF']) == 'shop.php' ? 'active' : ''; ?>">Магазин</a>
                <!-- АССИСТЕНТ - lien vide pour intégration Unity/WebGL -->
                <a href="assistant.php" class="nav-link-luxe <?php echo basename($_SERVER['PHP_SELF']) == 'assistant.php' ? 'active' : ''; ?>">Ассистент</a>
            </div>

            <!-- Логотип по центру -->
            <a href="index.php" class="brand-text mx-auto mx-lg-0">
                ÉLÉGANCIA
            </a>

            <!-- Меню справа -->
            <div class="d-flex align-items-center">
                <!-- Десктоп -->
                <div class="d-none d-lg-flex align-items-center me-3">
                    <a href="contact.php" class="nav-link-luxe <?php echo basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'active' : ''; ?>">Контакты</a>
                </div>

                <!-- Иконки -->
                <a href="cart.php" class="nav-icon position-relative" title="Корзина">
                    <i class="bi bi-bag"></i>
                    <?php if(isset($_SESSION['quantity']) && $_SESSION['quantity'] > 0): ?>
                        <span class="cart-badge"><?php echo $_SESSION['quantity']; ?></span>
                    <?php endif; ?>
                </a>

                <?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
                    <a href="account.php" class="user-avatar" title="Мой аккаунт">
                        <?php echo strtoupper(substr($_SESSION['user_name'], 0, 1)); ?>
                    </a>
                <?php else: ?>
                    <a href="login.php" class="nav-icon" title="Вход">
                        <i class="bi bi-person"></i>
                    </a>
                <?php endif; ?>

                <!-- Мобильное меню -->
                <button class="navbar-toggler-luxe d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#mobileMenu">
                    <i class="bi bi-list"></i>
                </button>
            </div>
        </div>

        <!-- Мобильное Меню -->
        <div class="collapse d-lg-none mobile-menu" id="mobileMenu">
            <a href="index.php" class="nav-link-luxe">Главная</a>
            <a href="shop.php" class="nav-link-luxe">Магазин</a>
            <!-- АССИСТЕНТ - mobile -->
            <a href="assistant.php" class="nav-link-luxe">Ассистент  </a>
                                                                            
                                                                           
            <a href="contact.php" class="nav-link-luxe">Контакты</a>
        </div>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
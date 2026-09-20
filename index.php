<?php include('layouts/header.php');?>

<style>
    /* ================= КИНЕМАТОГРАФИЧЕСКАЯ СЕКЦИЯ HERO ================= */
    .hero-cinematic {
    min-height: calc(100vh - 80px);
    position: relative;
    display: flex;
    align-items: center;
    overflow: hidden;
    /* НОВОЕ: Теплый бежевый с тонкой текстурой */
    background: linear-gradient(135deg, #f5f0e8 0%, #ebe5d9 50%, #f0ebe3 100%);
}

/* Тонкая текстура бумаги */
.hero-cinematic::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 400 400' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.03'/%3E%3C/svg%3E");
    pointer-events: none;
    opacity: 0.4;
}

/* Тонкая декоративная форма */
.hero-cinematic::after {
    content: '';
    position: absolute;
    top: -20%;
    right: -10%;
    width: 60%;
    height: 140%;
    background: radial-gradient(ellipse at center, rgba(201, 169, 98, 0.08) 0%, transparent 70%);
    pointer-events: none;
}

    .hero-content {
        position: relative;
        z-index: 2;
        padding: 0 5%;
    }

    .hero-label {
    font-size: 0.7rem;
    text-transform: uppercase;
    letter-spacing: 5px;
    color: var(--color-primary);
    font-weight: 600;
    margin-bottom: 25px;
    display: inline-flex;
    align-items: center;
    gap: 15px;
    position: relative;
    padding-left: 60px;
}

/* Декоративная линия перед текстом */
.hero-label::before {
    content: '';
    position: absolute;
    left: 0;
    width: 45px;
    height: 1px;
    background: var(--color-gold);
}

/* Маленькая декоративная точка */
.hero-label::after {
    content: '';
    width: 6px;
    height: 6px;
    background: var(--color-gold);
    border-radius: 50%;
    display: inline-block;
}

    .hero-title {
        font-family: var(--font-serif);
        font-size: clamp(3rem, 6vw, 5.5rem);
        line-height: 1.1;
        color: var(--color-dark);
        margin-bottom: 30px;
        font-weight: 400;
        animation: fadeInUp 1s ease 0.2s both;
    }

    .hero-title em {
        color: var(--color-primary);
        font-style: italic;
        position: relative;
    }

    .hero-title em::after {
        content: '';
        position: absolute;
        bottom: 5px;
        left: 0;
        width: 100%;
        height: 8px;
        background: rgba(201, 169, 98, 0.3);
        z-index: -1;
    }

    .hero-subtitle {
    Font-size: 1.05rem;
    color: var(--color-gray);
    max-width: 480px;
    line-height: 1.9;
    margin-bottom: 40px;
    font-weight: 400;
    /* Редакционный стиль */
    font-style: italic;
    position: relative;
    padding-left: 20px;
    border-left: 2px solid var(--color-gold);
    opacity: 0.9;
}

    .btn-luxe {
        display: inline-flex;
        align-items: center;
        gap: 15px;
        background: var(--color-dark);
        color: white;
        padding: 18px 40px;
        text-decoration: none;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 3px;
        font-weight: 500;
        border: none;
        position: relative;
        overflow: hidden;
        transition: all 0.4s ease;
        animation: fadeInUp 1s ease 0.6s both;
    }

    .btn-luxe::before {
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

    .btn-luxe:hover::before {
        left: 0;
    }

    .btn-luxe:hover {
        color: white;
        transform: translateX(5px);
    }

    .btn-luxe i {
        transition: transform 0.3s ease;
    }

    .btn-luxe:hover i {
        transform: translateX(5px);
    }

    /* Изображение Hero */
    .hero-visual {
        position: relative;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .hero-image-wrapper {
    position: relative;
    width: 85%;
    height: 85vh;  /* УВЕЛИЧЕНО с 75vh до 85vh */
    min-height: 600px;  /* ДОБАВЛЕН минимум */
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 40px 80px rgba(139, 94, 94, 0.2);
    animation: fadeIn 1.5s ease;
}

    .hero-image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center top;
        transition: transform 8s ease;
    }

    .hero-image-wrapper:hover img {
        transform: scale(1.05);
    }

    .hero-badge {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.2);
    /* Добавляет небольшую анимацию */
    animation: fadeInUp 1s ease 0.8s both, float 3s ease-in-out infinite;
}

/* Тонкая анимация */
@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-5px); }
}

.hero-badge-text {
    font-family: var(--font-serif);
    font-size: 2.2rem;
    color: var(--color-dark);
    font-weight: 600;
    line-height: 1;
    display: block;
}

.hero-badge-sub {
    font-size: 0.7rem;
    text-transform: uppercase;
    letter-spacing: 2px;
    color: var(--color-gray);
    margin-top: 5px;
    font-weight: 500;
    white-space: nowrap; /* ПРЕДОТВРАЩАЕТ разрыв строки */
}

    /* ================= СЕКЦИИ ТОВАРОВ ================= */
    .section-luxe {
        padding: 80px 0;
        
    }

    .section-header {
        text-align: center;
        margin-bottom: 80px;
    }

    .section-label {
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 4px;
        color: var(--color-gold);
        font-weight: 600;
        margin-bottom: 15px;
        display: block;
    }

    .section-title {
        font-family: var(--font-serif);
        font-size: clamp(2rem, 4vw, 3rem);
        color: var(--color-dark);
        font-weight: 400;
        margin-bottom: 20px;
    }

    .section-subtitle {
        color: var(--color-gray);
        font-size: 0.95rem;
        max-width: 500px;
        margin: 0 auto;
        line-height: 1.7;
    }

    /* Карточки товаров Люкс */
    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 40px;
        padding: 0 5%;
    }

    .product-card-luxe {
        position: relative;
        background: white;
        border-radius: 16px;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    }

    .product-card-luxe:hover {
        transform: translateY(-10px);
        box-shadow: 0 30px 60px rgba(139, 94, 94, 0.15);
    }

    .product-image-wrapper {
        position: relative;
        height: 350px;
        overflow: hidden;
        background: #f8f5f2;
    }

    .product-image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .product-card-luxe:hover .product-image-wrapper img {
        transform: scale(1.08);
    }

    .product-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.4), transparent);
        opacity: 0;
        transition: all 0.4s ease;
        display: flex;
        align-items: flex-end;
        justify-content: center;
        padding-bottom: 30px;
    }

    .product-card-luxe:hover .product-overlay {
        opacity: 1;
    }

    .btn-quick-view {
        background: white;
        color: var(--color-dark);
        border: none;
        padding: 12px 30px;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-weight: 600;
        border-radius: 30px;
        transform: translateY(20px);
        transition: all 0.3s ease;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
    }

    .product-card-luxe:hover .btn-quick-view {
        transform: translateY(0);
    }

    .btn-quick-view:hover {
        background: var(--color-primary);
        color: white;
    }

    .product-info {
        padding: 25px;
        text-align: center;
    }

    .product-category {
        font-size: 0.65rem;
        text-transform: uppercase;
        letter-spacing: 3px;
        color: var(--color-gold);
        margin-bottom: 10px;
        font-weight: 600;
    }

    .product-name {
        font-family: var(--font-serif);
        font-size: 1.1rem;
        color: var(--color-dark);
        margin-bottom: 12px;
        font-weight: 500;
    }

    .product-price {
        font-size: 1.2rem;
        color: var(--color-primary);
        font-weight: 600;
        font-family: var(--font-sans);
    }

    .product-price span {
        font-size: 0.85rem;
        color: var(--color-gray);
        text-decoration: line-through;
        margin-left: 10px;
        font-weight: 400;
    }

    /* Рейтинг звездами */
    .product-rating {
        margin: 10px 0;
        color: var(--color-gold);
        font-size: 0.8rem;
        letter-spacing: 2px;
    }

    /* ================= ПРОМО-БАННЕР ================= */
    .promo-banner {
        background: var(--color-dark);
        color: white;
        padding: 100px 0;
        text-align: center;
        position: relative;
        overflow: hidden;
        margin: 80px 0;
    }

    .promo-banner::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="40" fill="none" stroke="rgba(255,255,255,0.03)" stroke-width="0.5"/></svg>');
        background-size: 100px 100px;
        opacity: 0.5;
    }

    .promo-label {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 4px;
        color: var(--color-gold);
        margin-bottom: 20px;
        display: block;
    }

    .promo-title {
        font-family: var(--font-serif);
        font-size: clamp(2.5rem, 5vw, 4rem);
        margin-bottom: 30px;
        font-weight: 400;
    }

    .promo-title span {
        color: var(--color-gold);
        font-style: italic;
    }

    /* ================= АНИМАЦИИ ================= */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    /* Появление при прокрутке */
    .reveal {
        opacity: 0;
        transform: translateY(50px);
        transition: all 0.8s ease;
    }

    .reveal.active {
        opacity: 1;
        transform: translateY(0);
    }

    /* Адаптивность */
    @media (max-width: 768px) {
        .hero-cinematic {
            min-height: auto;
            padding: 150px 0 80px;
        }
        
        .hero-visual {
            height: auto;
            margin-top: 50px;
        }
        
        .hero-image-wrapper {
            height: 50vh;
            width: 90%;
        }
        
        .hero-badge {
            left: 20px;
            bottom: 20px;
        }
        
        .product-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            padding: 0 20px;
        }
        
        .product-image-wrapper {
            height: 250px;
        }
    }

    @media (max-width: 480px) {
        .product-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<!-- ================= СЕКЦИЯ HERO ================= -->
<section class="hero-cinematic">
    <div class="container-fluid p-0">
        <div class="row g-0 align-items-center">
            
            <!-- Текстовая сторона -->
            <div class="col-lg-5 hero-content">
                <span class="hero-label">Новая Коллекция 2025</span>
                <h1 class="hero-title">
                    Неувядаемая <em>элегантность</em> в вашем распоряжении
                </h1>
                <p class="hero-subtitle">
                    Откройте для себя нашу эксклюзивную подборку изысканных вещей, где каждая деталь рассказывает историю мастерства и страсти.
                </p>
                <a href="shop.php" class="btn-luxe">
                    Исследовать магазин
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>

            <!-- Сторона изображения -->
            <div class="col-lg-7 hero-visual">
                <div class="hero-image-wrapper">
                    <img src="assets/img/hero-model.jpg" alt="Коллекция Élégancia">
                    
                    <div class="hero-badge">
                        <div class="hero-badge-text">-30%</div>
                        <div class="hero-badge-sub">Новый Сезон</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ================= ИЗБРАННЫЕ ТОВАРЫ ================= -->
<section class="section-luxe" id="featured">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-label">Эксклюзивная Подборка</span>
            <h2 class="section-title">Наши Любимые Вещи</h2>
            <p class="section-subtitle">
                Тщательно подобранная коллекция наших самых популярных товаров, выбранных за их исключительное качество и отличительный стиль.
            </p>
        </div>

        <div class="product-grid">
            <?php include('server/get_featured_products.php');?>
            <?php while($row=$featured_products->fetch_assoc() ){ ?>
            
            <div class="product-card-luxe reveal">
                <div class="product-image-wrapper">
                    <img src="assets/img/<?php echo $row['product_image']; ?>" alt="<?php echo $row['product_name']; ?>">
                    <div class="product-overlay">
                        <a href="single_product.php?product_id=<?php echo $row['product_id']; ?>" class="btn-quick-view">
                            Смотреть товар
                        </a>
                    </div>
                </div>
                <div class="product-info">
                    <div class="product-category">В Тренде</div>
                    <h5 class="product-name"><?php echo $row['product_name']; ?></h5>
                    <div class="product-rating">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-half"></i>
                    </div>
                    <div class="product-price">
                    ₽<?php echo $row['product_price']; ?>
                    </div>
                </div>
            </div>

            <?php } ?>
        </div>
    </div>
</section>

<!-- ================= ПРОМО-БАННЕР ================= -->
<section class="promo-banner reveal">
    <div class="container position-relative">
        <span class="promo-label">Ограниченная Серия</span>
        <h2 class="promo-title">
            Осенняя Коллекция <span>-30%</span>
        </h2>
        <a href="shop.php" class="btn-luxe" style="background: white; color: var(--color-dark);">
            Открыть предложения
            <i class="bi bi-arrow-right"></i>
        </a>
    </div>
</section>

<!-- ================= ПЛАТЬЯ И ПАЛЬТО ================= -->
<section class="section-luxe" style="background: white;">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-label">Женская Одежда</span>
            <h2 class="section-title">Платья и Пальто</h2>
            <p class="section-subtitle">
                Суть женственности в изысканных силуэтах и благородных материалах.
            </p>
        </div>

        <div class="product-grid">
            <?php include('server/get_coats.php');?>
            <?php while($row=$coats_products->fetch_assoc()) { ?>

            <div class="product-card-luxe reveal">
                <div class="product-image-wrapper">
                    <img src="assets/img/<?php echo $row['product_image'];?>" alt="<?php echo $row['product_name'];?>">
                    <div class="product-overlay">
                        <a href="single_product.php?product_id=<?php echo $row['product_id']; ?>" class="btn-quick-view">
                            Смотреть товар
                        </a>
                    </div>
                </div>
                <div class="product-info">
                    <div class="product-category">Одежда</div>
                    <h5 class="product-name"><?php echo $row['product_name'];?></h5>
                    <div class="product-rating">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star"></i>
                    </div>
                    <div class="product-price">
                    ₽<?php echo $row['product_price'];?>
                    </div>
                </div>
            </div>

            <?php } ?>
        </div>
    </div>
</section>

<!-- ================= ОБУВЬ ================= -->
<section class="section-luxe">
    <div class="container">
        <div class="section-header reveal">
            <span class="section-label">Аксессуары</span>
            <h2 class="section-title">Исключительная Обувь</h2>
            <p class="section-subtitle">
                Культовые модели, сочетающие комфорт и изысканность, чтобы сопровождать каждый ваш шаг.
            </p>
        </div>

        <div class="product-grid">
            <?php include('server/get_shoes.php');?>
            <?php while($row=$shoes->fetch_assoc()) { ?>

            <div class="product-card-luxe reveal">
                <div class="product-image-wrapper">
                    <img src="assets/img/<?php echo $row['product_image'];?>" alt="<?php echo $row['product_name'];?>">
                    <div class="product-overlay">
                        <a href="single_product.php?product_id=<?php echo $row['product_id']; ?>" class="btn-quick-view">
                            Смотреть товар
                        </a>
                    </div>
                </div>
                <div class="product-info">
                    <div class="product-category">Обувь</div>
                    <h5 class="product-name"><?php echo $row['product_name'];?></h5>
                    <div class="product-rating">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                    </div>
                    <div class="product-price">
                    ₽<?php echo $row['product_price'];?>
                    </div>
                </div>
            </div>

            <?php } ?>
        </div>
    </div>
</section>

<!-- Анимация при прокрутке -->
<script>
    // Intersection Observer для анимаций
    const observerOptions = {
        threshold: 0.1,
        rootMargin: "0px 0px -50px 0px"
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
            }
        });
    }, observerOptions);

    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
</script>

<?php include('layouts/footer.php');?>
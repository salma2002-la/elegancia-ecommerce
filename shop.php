<?php 
include('server/connection.php');

// Подключение к базе данных и получение товаров
// Переменная $conn находится в connection.php

// Если пользователь нажал кнопку поиска в shop.php
// Другими словами, пользователь хочет использовать раздел поиска
if(isset($_POST['search'])){
    $category = $_POST['category'];
    $price = $_POST['price'];

    $statement=$conn->prepare("SELECT * from products WHERE product_category=? AND product_price<=? "); 
    $statement-> bind_param("si",$category,$price);
    $statement->execute();
    $products=$statement->get_result(); 

}else{
    // Возврат всех товаров
    $statement=$conn->prepare("SELECT * from products "); 
    $statement->execute();
    $products=$statement->get_result(); 
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
        --color-gray: #6c757d;
        --font-serif: 'Playfair Display', serif;
        --font-sans: 'Inter', sans-serif;
    }

    /* ================= СЕКЦИЯ ПОИСКА ================= */
    .search-section {
        background: linear-gradient(135deg, #f5f0e8 0%, #ebe5d9 100%);
        padding: 80px 0;
        position: relative;
        overflow: hidden;
    }

    .search-section::before {
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

    .search-header {
        text-align: center;
        margin-bottom: 50px;
        position: relative;
        z-index: 2;
    }

    .search-label {
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 4px;
        color: var(--color-gold);
        font-weight: 600;
        margin-bottom: 15px;
        display: block;
    }

    .search-title {
        font-family: var(--font-serif);
        font-size: clamp(2rem, 4vw, 3rem);
        color: var(--color-dark);
        font-weight: 400;
        margin-bottom: 20px;
    }

    .search-subtitle {
        color: var(--color-gray);
        font-size: 0.95rem;
        max-width: 500px;
        margin: 0 auto;
        line-height: 1.7;
    }

    .search-form-container {
        background: white;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 20px 60px rgba(139, 94, 94, 0.1);
        position: relative;
        z-index: 2;
    }

    .filter-title {
        font-family: var(--font-serif);
        font-size: 1.1rem;
        color: var(--color-dark);
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 1px solid rgba(139, 94, 94, 0.1);
        position: relative;
    }

    .filter-title::after {
        content: '';
        position: absolute;
        bottom: -1px;
        left: 0;
        width: 40px;
        height: 2px;
        background: var(--color-gold);
    }

    .form-check-luxe {
        margin-bottom: 15px;
        padding-left: 35px;
        position: relative;
    }

    .form-check-luxe input[type="radio"] {
        position: absolute;
        opacity: 0;
        cursor: pointer;
    }

    .form-check-luxe label {
        cursor: pointer;
        font-size: 0.9rem;
        color: var(--color-dark);
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
    }

    .form-check-luxe label::before {
        content: '';
        position: absolute;
        left: 0;
        top: 2px;
        width: 20px;
        height: 20px;
        border: 2px solid var(--color-primary);
        border-radius: 50%;
        transition: all 0.3s ease;
    }

    .form-check-luxe input[type="radio"]:checked + label::before {
        background: var(--color-primary);
        border-color: var(--color-primary);
        box-shadow: inset 0 0 0 4px white;
    }

    .form-check-luxe label:hover {
        color: var(--color-primary);
    }

    .price-range-container {
        margin-top: 30px;
    }

    .form-range-luxe {
        width: 100%;
        height: 6px;
        border-radius: 3px;
        background: #e9ecef;
        outline: none;
        -webkit-appearance: none;
    }

    .form-range-luxe::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 22px;
        height: 22px;
        border-radius: 50%;
        background: var(--color-gold);
        cursor: pointer;
        box-shadow: 0 4px 10px rgba(201, 169, 98, 0.4);
        transition: all 0.3s ease;
    }

    .form-range-luxe::-webkit-slider-thumb:hover {
        transform: scale(1.2);
        box-shadow: 0 6px 15px rgba(201, 169, 98, 0.5);
    }

    .price-labels {
        display: flex;
        justify-content: space-between;
        margin-top: 10px;
        font-size: 0.85rem;
        color: var(--color-gray);
        font-weight: 500;
    }

    .btn-search-luxe {
        background: var(--color-dark);
        color: white;
        border: none;
        padding: 15px 40px;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 3px;
        font-weight: 600;
        border-radius: 30px;
        transition: all 0.4s ease;
        margin-top: 30px;
        position: relative;
        overflow: hidden;
    }

    .btn-search-luxe::before {
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

    .btn-search-luxe:hover::before {
        left: 0;
    }

    .btn-search-luxe:hover {
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(139, 94, 94, 0.3);
    }

    /* ================= СЕКЦИЯ ТОВАРОВ ================= */
    .shop-section {
        padding: 80px 0;
        background: var(--color-cream);
    }

    .shop-header {
        text-align: center;
        margin-bottom: 60px;
    }

    .shop-label {
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 4px;
        color: var(--color-gold);
        font-weight: 600;
        margin-bottom: 15px;
        display: block;
    }

    .shop-title {
        font-family: var(--font-serif);
        font-size: clamp(2rem, 4vw, 3rem);
        color: var(--color-dark);
        font-weight: 400;
        margin-bottom: 20px;
    }

    .shop-subtitle {
        color: var(--color-gray);
        font-size: 0.95rem;
        max-width: 500px;
        margin: 0 auto;
        line-height: 1.7;
    }

    /* Карточки товаров */
    .product-grid-shop {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 40px;
        padding: 0 5%;
    }

    .product-card-shop {
        position: relative;
        background: white;
        border-radius: 16px;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        cursor: pointer;
    }

    .product-card-shop:hover {
        transform: translateY(-10px);
        box-shadow: 0 30px 60px rgba(139, 94, 94, 0.15);
    }

    .product-image-shop {
        position: relative;
        height: 350px;
        overflow: hidden;
        background: #f8f5f2;
    }

    .product-image-shop img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .product-card-shop:hover .product-image-shop img {
        transform: scale(1.08);
    }

    .product-overlay-shop {
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

    .product-card-shop:hover .product-overlay-shop {
        opacity: 1;
    }

    .btn-quick-view-shop {
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

    .product-card-shop:hover .btn-quick-view-shop {
        transform: translateY(0);
    }

    .btn-quick-view-shop:hover {
        background: var(--color-primary);
        color: white;
    }

    .product-info-shop {
        padding: 25px;
        text-align: center;
    }

    .product-category-shop {
        font-size: 0.65rem;
        text-transform: uppercase;
        letter-spacing: 3px;
        color: var(--color-gold);
        margin-bottom: 10px;
        font-weight: 600;
    }

    .product-name-shop {
        font-family: var(--font-serif);
        font-size: 1.1rem;
        color: var(--color-dark);
        margin-bottom: 12px;
        font-weight: 500;
    }

    .product-rating-shop {
        margin: 10px 0;
        color: var(--color-gold);
        font-size: 0.8rem;
        letter-spacing: 2px;
    }

    .product-price-shop {
        font-size: 1.2rem;
        color: var(--color-primary);
        font-weight: 600;
        font-family: var(--font-sans);
        margin-bottom: 15px;
    }

    .btn-buy-shop {
        display: inline-block;
        background: var(--color-dark);
        color: white;
        padding: 12px 30px;
        text-decoration: none;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-weight: 600;
        border-radius: 30px;
        transition: all 0.3s ease;
        border: none;
    }

    .btn-buy-shop:hover {
        background: var(--color-primary);
        color: white;
        transform: translateY(-2px);
    }

    /* ================= ПАГИНАЦИЯ ================= */
    .pagination-luxe {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 60px;
        list-style: none;
        padding: 0;
    }

    .pagination-luxe .page-item {
        margin: 0;
    }

    .pagination-luxe .page-link {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 45px;
        height: 45px;
        border-radius: 50%;
        border: 1px solid rgba(139, 94, 94, 0.2);
        color: var(--color-dark);
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 500;
        transition: all 0.3s ease;
        background: white;
    }

    .pagination-luxe .page-link:hover {
        background: var(--color-primary);
        color: white;
        border-color: var(--color-primary);
        transform: translateY(-2px);
    }

    /* Адаптивность */
    @media (max-width: 768px) {
        .search-form-container {
            padding: 25px;
        }

        .product-grid-shop {
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            padding: 0 20px;
        }

        .product-image-shop {
            height: 250px;
        }
    }

    @media (max-width: 480px) {
        .product-grid-shop {
            grid-template-columns: 1fr;
        }
    }
</style>

<!-- ================= СЕКЦИЯ ПОИСКА ================= -->
<section class="search-section">
    <div class="container">
        <div class="search-header">
            <span class="search-label">Поиск</span>
            <h2 class="search-title">Найдите идеальную вещь</h2>
            <p class="search-subtitle">
                Используйте фильтры ниже, чтобы найти именно то, что вы ищете в нашей коллекции.
            </p>
        </div>

        <form action="shop.php" method="POST">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10">
                    <div class="search-form-container">
                        <div class="row">
                            <!-- Категории -->
                            <div class="col-md-6 mb-4">
                                <h4 class="filter-title">Категория</h4>
                                
                                <div class="form-check-luxe">
                                    <input type="radio" name="category" id="category-one" value="Shoes">
                                    <label for="category-one">Обувь</label>
                                </div>

                                <div class="form-check-luxe">
                                    <input type="radio" value="coat" name="category" id="category-two" checked>
                                    <label for="category-two">Пальто</label>
                                </div>

                                <div class="form-check-luxe">
                                    <input type="radio" value="Accessories" name="category" id="category-three">
                                    <label for="category-three">Аксессуары</label>
                                </div>

                                <div class="form-check-luxe">
                                    <input type="radio" value="bags" name="category" id="category-four">
                                    <label for="category-four">Сумки</label>
                                </div>
                            </div>

                            <!-- Цена -->
                            <div class="col-md-6 mb-4">
                                <h4 class="filter-title">Цена</h4>
                                <div class="price-range-container">
                                    <input type="range" class="form-range-luxe" min="1" max="1000" id="custom_range" name="price" value="100">
                                    <div class="price-labels">
                                        <span>1 ₽</span>
                                        <span id="priceValue">100 ₽</span>
                                        <span>1000 ₽</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <input type="submit" name="search" value="Найти" class="btn-search-luxe">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<!-- ================= СЕКЦИЯ ТОВАРОВ ================= -->
<section class="shop-section">
    <div class="container-fluid p-0">
        <div class="shop-header">
            <span class="shop-label">Каталог</span>
            <h3 class="shop-title">Наши товары</h3>
            <p class="shop-subtitle">
                Здесь вы можете ознакомиться с нашими избранными товарами премиум-класса.
            </p>
        </div>

        <div class="product-grid-shop">
            <?php while($row = $products->fetch_assoc()) {?>
                <div class="product-card-shop" onclick="window.location.href='single_product.php?product_id=<?php echo $row['product_id'];?>'">
                    <div class="product-image-shop">
                        <img class="img-fluid" src="assets/img/<?php echo $row['product_image'];?>" alt="<?php echo $row['product_name'];?>">
                        <div class="product-overlay-shop">
                            <a href="single_product.php?product_id=<?php echo $row['product_id'];?>" class="btn-quick-view-shop">
                                Смотреть товар
                            </a>
                        </div>
                    </div>
                    <div class="product-info-shop">
                        <div class="product-category-shop">
                            <?php 
                            $category = isset($row['product_category']) ? $row['product_category'] : 'Товар';
                            echo $category;
                            ?>
                        </div>
                        <h5 class="product-name-shop"><?php echo $row['product_name'];?></h5>
                        <div class="product-rating-shop">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <h4 class="product-price-shop">₽<?php echo $row['product_price'];?></h4>
                        <a class="btn-buy-shop" href="single_product.php?product_id=<?php echo $row['product_id'];?>">
                            Купить сейчас
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>

        <!-- Пагинация -->
        <nav aria-label="Навигация по страницам" class="mt-5"> 
            <ul class="pagination-luxe">
                <li class="page-item"><a class="page-link" href="#">Назад</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Вперед</a></li>
            </ul>
        </nav>
    </div>
</section>

<script>
    // Обновление значения цены при движении ползунка
    document.getElementById('custom_range').addEventListener('input', function() {
        document.getElementById('priceValue').textContent = this.value + ' $';
    });
</script>

<?php include('layouts/footer.php');?>
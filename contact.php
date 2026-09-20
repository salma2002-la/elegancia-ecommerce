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

    .contact-section {
        padding: 80px 0;
        position: relative;
        overflow: hidden;
    }

    .contact-section::before {
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
    .section-header-contact {
        text-align: center;
        margin-bottom: 50px;
    }

    .section-label-contact {
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 4px;
        color: var(--color-gold);
        font-weight: 600;
        margin-bottom: 15px;
        display: block;
    }

    .section-title-contact {
        font-family: var(--font-serif);
        font-size: 2.5rem;
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

    .contact-container {
        background: #fff;
        border-radius: 20px;
        padding: 60px 50px;
        box-shadow: 0 20px 60px rgba(139, 94, 94, 0.08);
        border: 1px solid rgba(139, 94, 94, 0.05);
        position: relative;
        z-index: 2;
    }
    
    .contact-info-box {
        transition: all 0.4s ease;
        padding: 30px 20px;
        border-radius: 16px;
    }
    
    .contact-info-box:hover {
        transform: translateY(-10px);
        background: var(--color-cream);
        box-shadow: 0 15px 40px rgba(139, 94, 94, 0.1);
    }
    
    .icon-circle {
        width: 70px;
        height: 70px;
        background: var(--color-cream);
        color: var(--color-gold);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        font-size: 1.6rem;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .contact-info-box:hover .icon-circle {
        background: var(--color-gold);
        color: white;
        transform: scale(1.1);
    }
    
    .contact-info-box h5 {
        font-family: var(--font-serif);
        font-size: 1.2rem;
        color: var(--color-dark);
        margin-bottom: 15px;
        font-weight: 500;
    }
    
    .contact-link {
        color: var(--color-gray);
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        position: relative;
    }

    .contact-link::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 1px;
        background: var(--color-gold);
        transition: width 0.3s ease;
    }
    
    .contact-link:hover {
        color: var(--color-primary);
    }

    .contact-link:hover::after {
        width: 100%;
    }
    
    .work-hours-section {
        margin-top: 50px;
        padding-top: 40px;
        border-top: 1px solid rgba(139, 94, 94, 0.1);
    }

    .work-hours-label {
        font-size: 0.85rem;
        color: var(--color-gray);
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 15px;
    }
    
    .work-hours {
        background: var(--color-dark);
        color: #fff;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 12px 25px;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 500;
        letter-spacing: 1px;
    }

    .work-hours i {
        color: var(--color-gold);
    }

    /* Адаптивность */
    @media (max-width: 768px) {
        .contact-container {
            padding: 40px 25px;
        }

        .section-title-contact {
            font-size: 1.8rem;
        }

        .contact-info-box {
            margin-bottom: 20px;
        }
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<section class="contact-section my-5 py-5">
    <div class="container">
        <div class="section-header-contact">
            <span class="section-label-contact">Свяжитесь с нами</span>
            <h2 class="section-title-contact">Контакты</h2>
            <hr class="divider-luxe">
        </div>
        
        <div class="contact-container text-center">
            <div class="row">
                <div class="col-md-4 contact-info-box">
                    <div class="icon-circle">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <h5>Телефон</h5>
                    <a href="tel:+79271791107" class="contact-link">+7 927 179 11 07</a>
                </div>

                <div class="col-md-4 contact-info-box">
                    <div class="icon-circle">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h5>Email</h5>
                    <a href="mailto:harbsalma18@gmail.com" class="contact-link">harbsalma18@gmail.com</a>
                </div>

                <div class="col-md-4 contact-info-box">
                    <div class="icon-circle">
                        <i class="fab fa-vk"></i>
                    </div>
                    <h5>ВКонтакте</h5>
                    <a href="#" class="contact-link">salma salma</a>
                </div>
            </div>

            <div class="work-hours-section">
                <p class="work-hours-label">Мы работаем для вас</p>
                <div class="work-hours">
                    <i class="far fa-clock"></i>
                    24 часа / 7 дней
                </div>
            </div>
        </div>
    </div>
</section>

<?php include('layouts/footer.php');?>
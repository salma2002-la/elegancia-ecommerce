<style>
    /* ================= FOOTER ÉLÉGANCIA ================= */
    .footer-luxe {
        background: var(--color-dark);
        color: rgba(255, 255, 255, 0.8);
        padding: 100px 0 0;
        font-family: var(--font-sans);
    }

    .footer-brand {
        font-family: var(--font-serif);
        font-size: 2rem;
        color: white;
        letter-spacing: 4px;
        margin-bottom: 25px;
        display: inline-block;
        text-decoration: none;
    }

    .footer-brand:hover {
        color: var(--color-gold);
    }

    .footer-text {
        font-size: 0.9rem;
        line-height: 1.8;
        color: rgba(255, 255, 255, 0.6);
        max-width: 300px;
    }

    .footer-title {
        font-family: var(--font-serif);
        font-size: 1.1rem;
        color: white;
        margin-bottom: 30px;
        font-weight: 400;
        position: relative;
        padding-bottom: 15px;
    }

    .footer-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 40px;
        height: 1px;
        background: var(--color-gold);
    }

    .footer-links {
        list-style: none;
        padding: 0;
    }

    .footer-links li {
        margin-bottom: 15px;
    }

    .footer-links a {
        color: rgba(255, 255, 255, 0.6);
        text-decoration: none;
        font-size: 0.85rem;
        transition: all 0.3s ease;
        display: inline-block;
    }

    .footer-links a:hover {
        color: var(--color-gold);
        transform: translateX(5px);
    }

    .footer-contact p {
        font-size: 0.85rem;
        margin-bottom: 15px;
        color: rgba(255, 255, 255, 0.6);
    }

    .footer-contact strong {
        color: white;
        font-weight: 500;
    }

    .newsletter-form {
        display: flex;
        gap: 10px;
        margin-top: 20px;
    }

    .newsletter-input {
        flex: 1;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        padding: 15px 20px;
        color: white;
        font-size: 0.85rem;
        outline: none;
        transition: all 0.3s ease;
    }

    .newsletter-input::placeholder {
        color: rgba(255, 255, 255, 0.4);
    }

    .newsletter-input:focus {
        border-color: var(--color-gold);
        background: rgba(255, 255, 255, 0.15);
    }

    .newsletter-btn {
        background: var(--color-gold);
        color: var(--color-dark);
        border: none;
        padding: 15px 25px;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .newsletter-btn:hover {
        background: white;
        transform: scale(1.05);
    }

    .instagram-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
    }

    .instagram-item {
        aspect-ratio: 1;
        overflow: hidden;
        border-radius: 8px;
        position: relative;
        cursor: pointer;
    }

    .instagram-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .instagram-item:hover img {
        transform: scale(1.1);
    }

    .instagram-overlay {
        position: absolute;
        inset: 0;
        background: rgba(139, 94, 94, 0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: all 0.3s ease;
    }

    .instagram-item:hover .instagram-overlay {
        opacity: 1;
    }

    .instagram-overlay i {
        color: white;
        font-size: 1.5rem;
    }

    .footer-bottom-luxe {
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        margin-top: 80px;
        padding: 30px 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }

    .footer-copyright {
        font-size: 0.8rem;
        color: rgba(255, 255, 255, 0.5);
    }

    .footer-social {
        display: flex;
        gap: 25px;
    }

    .footer-social a {
        color: rgba(255, 255, 255, 0.6);
        font-size: 1.1rem;
        transition: all 0.3s ease;
    }

    .footer-social a:hover {
        color: var(--color-gold);
        transform: translateY(-3px);
    }

    /* ================= UNITY WEBGL ASSISTANT WIDGET ================= */
    #assistant-button {
        position: fixed;
        bottom: 30px;
        right: 30px;
        width: 65px;
        height: 65px;
        border-radius: 50%;
        background: var(--color-gold, #C9A962);
        color: white;
        font-size: 26px;
        border: none;
        cursor: pointer;
        box-shadow: 0 10px 30px rgba(201, 169, 98, 0.4);
        z-index: 9999;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #assistant-button:hover {
        transform: scale(1.1) rotate(10deg);
        box-shadow: 0 15px 40px rgba(201, 169, 98, 0.5);
    }

    #assistant-popup {
        position: fixed;
        bottom: 110px;
        right: 30px;
        width: 800px;
        height: 600px;
        max-height: 85vh;
        background: var(--color-dark, #1A1A1A);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0,0,0,0.35);
        display: none;
        z-index: 9998;
        border: 2px solid var(--color-gold, #C9A962);
        flex-direction: column;
    }

    #assistant-popup.active {
        display: flex;
        animation: slideUp 0.3s ease;
    }

    @keyframes slideUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .assistant-header {
        background: var(--color-dark);
        color: white;
        padding: 15px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid rgba(201, 169, 98, 0.3);
    }

    .assistant-header h4 {
        margin: 0;
        font-family: var(--font-serif);
        font-size: 1.1rem;
        color: var(--color-gold);
    }

    .assistant-close-btn {
        background: rgba(255,255,255,0.1);
        border: none;
        color: white;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        cursor: pointer;
        font-size: 18px;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .assistant-close-btn:hover {
        background: rgba(255,255,255,0.2);
        transform: rotate(90deg);
    }

    .assistant-content {
        flex: 1;
        position: relative;
        background: #fafafa;
    }

    #assistant-popup iframe {
        width: 100%;
        height: 100%;
        border: none;
        display: block;
    }

    .assistant-loader {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: var(--color-gold);
        font-size: 14px;
        display: none;
        font-family: var(--font-sans);
    }

    @media (max-width: 480px) {
        #assistant-button {
            bottom: 20px;
            right: 20px;
            width: 55px;
            height: 55px;
            font-size: 22px;
        }
        
        #assistant-popup {
            bottom: 90px;
            right: 10px;
            left: 10px;
            width: auto;
            height: 75vh;
        }
    }
</style>

<footer class="footer-luxe">
    <div class="container">
        <div class="row">
            <!-- Бренд -->
            <div class="col-lg-3 col-md-6 mb-5">
                <a href="index.php" class="footer-brand">ÉLÉGANCIA</a>
                <p class="footer-text">
                    Дом моды, посвященный неувядаемой элегантности. Каждая вещь рассказывает историю страсти и совершенства.
                </p>
                <div class="footer-social mt-4">
                    <a href="#"><i class="bi bi-instagram"></i></a>
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-pinterest"></i></a>
                    <a href="#"><i class="bi bi-tiktok"></i></a>
                </div>
            </div>

            <!-- Ссылки -->
            <div class="col-lg-2 col-md-6 mb-5">
                <h5 class="footer-title">Магазин</h5>
                <ul class="footer-links">
                    <li><a href="shop.php">Новинки</a></li>
                    <li><a href="shop.php">Женщинам</a></li>
                    <li><a href="shop.php">Мужчинам</a></li>
                    <li><a href="shop.php">Аксессуары</a></li>
                    <li><a href="shop.php">Акции</a></li>
                </ul>
            </div>

            <!-- Сервис -->
            <div class="col-lg-2 col-md-6 mb-5">
                <h5 class="footer-title">Сервис</h5>
                <ul class="footer-links">
                    <li><a href="#">Доставка</a></li>
                    <li><a href="#">Возвраты</a></li>
                    <li><a href="#">Руководство по размерам</a></li>
                    <li><a href="contact.php">Контакты</a></li>
                    <li><a href="#">Вопросы и ответы</a></li>
                </ul>
            </div>

            <!-- Контакты -->
            <div class="col-lg-2 col-md-6 mb-5">
                <h5 class="footer-title">Контакты</h5>
                <div class="footer-contact">
                    <p><strong>Адрес:</strong><br>Касабланка, Марокко</p>
                    <p><strong>Телефон:</strong><br>+212 6 59 74 98 98</p>
                    <p><strong>Email:</strong><br>contact@elegancia.ma</p>
                </div>
            </div>

            <!-- Рассылка -->
            <div class="col-lg-3 col-md-6 mb-5">
                <h5 class="footer-title">Рассылка</h5>
                <p class="footer-text" style="font-size: 0.85rem;">
                    Получайте наши эксклюзивные предложения и последние тренды.
                </p>
                <form class="newsletter-form">
                    <input type="email" class="newsletter-input" placeholder="Ваш email">
                    <button type="submit" class="newsletter-btn">
                        <i class="bi bi-arrow-right"></i>
                    </button>
                </form>
                
                <!-- Мини Instagram -->
                <div class="mt-4">
                    <p style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 2px; color: var(--color-gold); margin-bottom: 15px;">
                        @elegancia.ma
                    </p>
                    <div class="instagram-grid">
                        <div class="instagram-item">
                            <img src="assets/img/coat1.jpeg" alt="Instagram">
                            <div class="instagram-overlay">
                                <i class="bi bi-instagram"></i>
                            </div>
                        </div>
                        <div class="instagram-item">
                            <img src="assets/img/coatmen3.jpg" alt="Instagram">
                            <div class="instagram-overlay">
                                <i class="bi bi-instagram"></i>
                            </div>
                        </div>
                        <div class="instagram-item">
                            <img src="assets/img/showomen2.jpg" alt="Instagram">
                            <div class="instagram-overlay">
                                <i class="bi bi-instagram"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Низ -->
        <div class="footer-bottom-luxe">
            <p class="footer-copyright">
                © 2025 Élégancia. Все права защищены. Создано с любовью в Касабланке.
            </p>
            <div style="display: flex; gap: 30px; font-size: 0.75rem; color: rgba(255,255,255,0.4);">
                <a href="#" style="color: inherit; text-decoration: none;">Политика конфиденциальности</a>
                <a href="#" style="color: inherit; text-decoration: none;">Условия использования</a>
            </div>
        </div>
    </div>
</footer>

<!-- UNITY WEBGL ASSISTANT WIDGET -->
<button id="assistant-button" onclick="toggleAssistant()" title="Parler avec la conseillère">
    <i class="bi bi-chat-dots-fill"></i>
</button>

<div id="assistant-popup">
    <div class="assistant-header">
        <h4>Консьерж Élégancia</h4>
        <button class="assistant-close-btn" onclick="toggleAssistant()">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>
    <div class="assistant-content">
        <div class="assistant-loader" id="assistant-loader">
            <i class="bi bi-arrow-repeat bi-spin"></i> Chargement de l'assistant...
        </div>
        <iframe id="unity-frame" data-src="http://localhost/project-e-commerce/assistant-webgl/index.html?v=2"></iframe>
    </div>
</div>

<script>
// Gestionnaire de l'assistant Unity WebGL
let assistantLoaded = false;
let assistantOpen = false;
const popup = document.getElementById('assistant-popup');
const frame = document.getElementById('unity-frame');
const loader = document.getElementById('assistant-loader');
const button = document.getElementById('assistant-button');

function toggleAssistant() {
    assistantOpen = !assistantOpen;
    
    if (assistantOpen) {
        // Ouvrir
        popup.classList.add('active');
        button.style.transform = 'scale(0.8)';
        button.style.opacity = '0.5';
        
        // Lazy loading : charger Unity uniquement à la première ouverture
        if (!assistantLoaded) {
            loader.style.display = 'block';
            
            setTimeout(() => {
                frame.src = frame.getAttribute('data-src');
                assistantLoaded = true;
                
                frame.onload = () => {
                    loader.style.display = 'none';
                    console.log('✅ Unity WebGL chargé avec succès');
                };
                
                frame.onerror = () => {
                    loader.innerHTML = '<span style="color:red;">Erreur de chargement</span>';
                    console.error('❌ Erreur chargement Unity');
                };
            }, 300);
        }
    } else {
        // Fermer
        popup.classList.remove('active');
        button.style.transform = '';
        button.style.opacity = '';
    }
}

// Fermer avec la touche Echap
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && assistantOpen) {
        toggleAssistant();
    }
});

// Fermer en cliquant à l'extérieur (optionnel - décommenter si besoin)
/*
document.addEventListener('click', (e) => {
    if (assistantOpen && 
        !popup.contains(e.target) && 
        !button.contains(e.target)) {
        toggleAssistant();
    }
});
*/

// Fonctions utilitaires (conservées pour compatibilité)
function escapeHtml(text) {
    if (!text) return '';
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

function formatAIReply(text) {
    if (!text) return '';
    text = text.replace(/(https?:\/\/[^\s<]+)/g, '<a href="$1" target="_blank">$1</a>');
    text = text.replace(/\n/g, '<br>');
    return text;
}
</script>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Консьерж Élégancia - Ваш персональный ассистент</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            overflow: hidden; /* Empêche le scroll, l'avatar prend tout */
            background: var(--color-dark, #1A1A1A);
        }
        
        .assistant-page {
            width: 100vw;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        /* Header minimal pour cette page */
        .assistant-header {
            background: var(--color-dark);
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid var(--color-gold);
            height: 70px;
        }
        
        .assistant-header h1 {
            font-family: var(--font-serif);
            font-size: 1.5rem;
            margin: 0;
            color: var(--color-gold);
        }
        
        .back-link {
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
        }
        
        .back-link:hover {
            color: var(--color-gold);
            transform: translateX(-5px);
        }

        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            background: #000;
            }
        
        /* Conteneur Unity plein écran */
        .unity-container {
            height: calc(100vh - 70px);
            position: relative;
            background: #000;
        }
        
        #unity-canvas {
            width: 100%;
            height: 100%;
            border: none;
        }
        
        /* Loader */
        .unity-loader {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: var(--color-gold);
            font-size: 1.2rem;
            text-align: center;
            font-family: var(--font-sans);
        }
        
        .spinner {
            width: 50px;
            height: 50px;
            border: 3px solid rgba(201, 169, 98, 0.3);
            border-top-color: var(--color-gold);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 20px;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        #unity-frame {
    width: 100%;
    height: 100%;
    display: block;
}
    </style>
</head>
<body>

<div class="assistant-page">
    <!-- Header spécifique pour la page assistant -->
    <header class="assistant-header">
        <a href="index.php" class="back-link">
            <i class="bi bi-arrow-left"></i>
            <span>Вернуться на сайт</span>
        </a>
        <h1>Консьерж Élégancia</h1>
        <div style="width: 100px;"></div> <!-- Spacer pour centrer le titre -->
    </header>
    
    <!-- Unity WebGL plein écran -->
    <div class="unity-container">
        <div class="unity-loader" id="loader">
            <div class="spinner"></div>
            <div>Загрузка виртуального ассистента...</div>
        </div>
        
        <iframe 
            id="unity-frame"
            src="http://localhost/project-e-commerce/assistant-webgl/index.html?v=2" 
            style="width: 100%; height: 100%; border: none;"
            allowfullscreen
            onload="document.getElementById('loader').style.display='none'">
        </iframe>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

</body>
</html>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Content-Type: application/json");


try {
    $input = json_decode(file_get_contents("php://input"), true);

    if (!isset($input["message"]) || empty($input["message"])) {
        echo json_encode([
            "status" => "error",
            "reply" => "No message received"
        ]);
        exit;
    }

    $message = mb_strtolower(trim($input["message"]), 'UTF-8');
    /*

   
$predefinedReply = null;
$predefined = [

    // 1. Чёрное женское пальто до 1500
    'чёрное женское пальто|черное женское пальто|женское черное пальто|женское чёрное пальто' => [
        'reply' => 'Я нашла для вас элегантные варианты чёрных пальто для женщин в вашем бюджете! Особенно рекомендую Женскую зимнюю куртку CHARIOU за 1500 MAD — тёплая, стильная и практичная. Также есть Женские балетки в чёрном цвете по доступной цене.',
        'force_filters' => ['category' => 'Пальто', 'color' => 'чёрный', 'gender' => 'Женщины', 'maxPrice' => 1500]
    ],

    // 2. Детские куртки до 800
    'детские куртки до 800|детское пальто до 800|куртка для ребенка до 800|детская куртка недорого' => [
        'reply' => 'Отличный выбор! Для детей у нас есть несколько тёплых курток по доступной цене. Детское вельветовое зимнее пальто за 700 MAD — мягкое и уютное. Тёплая детская куртка для зимы за 750 MAD — лёгкая, но очень тёплая!',
        'force_filters' => ['category' => 'Пальто', 'gender' => 'Дети', 'maxPrice' => 800]
    ],

    // 3. Спортивная обувь для женщин белая
    'спортивная обувь.*бел|белая.*спортивная обувь|белые кроссовки.*женщин|женские белые кроссовки' => [
        'reply' => 'Прекрасный выбор! У нас есть стильные белые кроссовки для женщин. Женские кроссовки Skechers Bobs B Cute за 1000 MAD — удобная посадка и современный дизайн. Skechers D\'Lites Big за 1100 MAD — массивная подошва, очень модно!',
        'force_filters' => ['category' => 'Обувь', 'color' => 'белый', 'gender' => 'Женщины']
    ],

    // 4. Элегантные туфли бежевые
    'элегантн.*бежев|бежев.*туфли|бежевая обувь.*женщин|женские бежевые туфли' => [
        'reply' => 'Для элегантного образа идеально подойдёт обувь Clarks Unisex Kataleyna Gem за 1300 MAD — комфортная, элегантная, с качественной кожей. Настоящая классика!',
        'force_filters' => ['category' => 'Обувь', 'color' => 'бежевый', 'gender' => 'Женщины']
    ],

    // 5. Мужская куртка чёрная размер L
    'мужская куртка.*чёрн|чёрная мужская куртка|мужское пальто чёрное|чёрное пальто мужское' => [
        'reply' => 'Для мужчин у нас отличный выбор чёрных курток! Мужская зимняя куртка с ветрозащитой за 10000 MAD — современный дизайн и надёжная защита от холода. Мужская универсальная зимняя куртка — практичная и стильная!',
        'force_filters' => ['category' => 'Пальто', 'color' => 'чёрный', 'gender' => 'Мужчины']
    ],

    // 6. Детское пальто красное размер 5Y
    'детское.*красн|красная.*детская куртка|красное детское пальто' => [
        'reply' => 'Прекрасный выбор! Тёплая детская куртка для зимы в красном цвете за 750 MAD — лёгкая, тёплая, с современным дизайном. Доступна в размерах 5Y и 6Y. Отличный вариант для активных детей!',
        'force_filters' => ['category' => 'Пальто', 'color' => 'красный', 'gender' => 'Дети']
    ],

    // 7. Женское пальто серое
    'женское пальто серое|серое пальто для женщин|серое женское пальто|женская куртка серая' => [
        'reply' => 'Серый — очень элегантный выбор! У нас есть Длинное женское пальто Vancavoo за 1700 MAD — стильный удлинённый силуэт, идеален для города. Также Зимняя куртка для женщин за 1600 MAD — практичная с утеплённой подкладкой!',
        'force_filters' => ['category' => 'Пальто', 'color' => 'серый', 'gender' => 'Женщины']
    ],

    // 8. Аксессуары для мужчин
    'аксессуары.*мужчин|мужские аксессуары|часы для мужчин|мужские часы' => [
        'reply' => 'Для завершения мужского образа у нас есть Classic Watch — классические наручные часы с кожаным ремешком за 1210 MAD. Элегантный и практичный выбор для современного мужчины!',
        'force_filters' => ['category' => 'Аксессуары', 'gender' => 'Мужчины']
    ],

    // 9. Чёрная обувь для женщин до 800
    'чёрная обувь.*до 800|женская чёрная обувь до 800|чёрные туфли до 800|обувь чёрная женская дешево' => [
        'reply' => 'Отличный выбор! В вашем бюджете есть несколько вариантов. Женские балетки в чёрном за 600 MAD — лёгкие и удобные для каждого дня. Женские чёрные сандалии на танкетке за 800 MAD — стильно и элегантно!',
        'force_filters' => ['category' => 'Обувь', 'color' => 'чёрный', 'gender' => 'Женщины', 'maxPrice' => 800]
    ],

    // 10. Детская куртка жёлтая размер 6Y
    'жёлтая детская куртка|детская куртка жёлтая|жёлтое детское пальто|куртка для детей жёлтая' => [
        'reply' => 'Яркий выбор! Детская зимняя парка с подкладкой в жёлтом цвете за 950 MAD — тёплая, удобная, доступна в размерах 6Y и 7Y. Идеально для активных и весёлых детей!',
        'force_filters' => ['category' => 'Пальто', 'color' => 'жёлтый', 'gender' => 'Дети']
    ],

    // Salutation
    'привет|здравствуй|bonjour|hello|салют' => [
        'reply' => 'Здравствуйте! Я Элегансия, ваш виртуальный помощник магазина Élégancia. Чем могу помочь вам сегодня? 😊',
        'force_filters' => [],
        'skip_products' => true
    ],

    // Merci
    'спасибо|благодарю|merci|thank' => [
        'reply' => 'Пожалуйста! Рада была помочь. Если нужна ещё помощь — обращайтесь! 😊',
        'force_filters' => [],
        'skip_products' => true
    ],
];

foreach ($predefined as $pattern => $data) {
    if (preg_match('/(' . $pattern . ')/iu', $message)) {

        // Appliquer les filtres forcés
        if (!empty($data['force_filters'])) {
            $f = $data['force_filters'];
            if (isset($f['category'])) $category = $f['category'];
            if (isset($f['color']))    $color    = $f['color'];
            if (isset($f['gender']))   $gender   = $f['gender'];
            if (isset($f['maxPrice'])) $maxPrice = $f['maxPrice'];
            if (isset($f['minPrice'])) $minPrice = $f['minPrice'];
        }

        // Réponse directe sans produits
        if (!empty($data['skip_products'])) {
            echo json_encode([
                "status"   => "success",
                "reply"    => $data['reply'],
                "audio"    => "",
                "products" => [],
                "filters"  => []
            ]);
            exit;
        }

        // Garder la reply prédéfinie pour remplacer Ollama
        $predefinedReply = $data['reply'];
        break;
    }
}
*/


    /* ========== DÉTECTION CRITÈRES EN RUSSE ========== */
    
    // 1. GENRE (Corrigé pour correspondre exactement à ta BD)
    $gender = null;
    if (preg_match('/\b(муж|мужской|мужчина|мужчины|мужское|men|man|male|homme)\b/iu', $message)) {
        $gender = 'Мужчины';
    } elseif (preg_match('/\b(жен|женский|женщина|женщины|женское|women|woman|female|femme)\b/iu', $message)) {
        $gender = 'Женщины';
    } elseif (preg_match('/\b(дет|детский|дети|детское|ребенок|ребёнок|kid|kids|child|children)\b/iu', $message)) {
        $gender = 'Дети';
    }

    // 2. COULEUR (Corrigé avec les valeurs exactes de ta BD)
    $color = null;
    $colorPatterns = [
        'черный|чёрный|black' => 'чёрный',
        'белый|white' => 'белый',
        'красный|red' => 'красный',
        'синий|синяя|blue' => 'синий',
        'зеленый|зелёный|green' => 'зелёный',
        'коричневый|brown' => 'коричневый',
        'желтый|жёлтый|yellow' => 'жёлтый',
        'серый|grey|gray' => 'серый',
        'розовый|pink' => 'розовый',
        'бежевый|beige' => 'бежевый',
        'хаки|khaki' => 'хаки',
        'темно-синий|тёмно-синий|темно синий|тёмно синий|dark blue|navy' => 'тёмно-синий',
        'фиолетовый|purple|violet' => 'фиолетовый',
        'оранжевый|orange' => 'оранжевый',
        'olive|оливковый' => 'olive'
    ];

    foreach ($colorPatterns as $pattern => $dbValue) {
        if (preg_match('/\b(' . $pattern . ')\b/iu', $message)) {
            $color = $dbValue;
            break;
        }
    }

    // 3. CATÉGORIE (Corrigé avec les valeurs exactes de ta BD)
    $category = null;
    $categoryPatterns = [
        'пальто|palto|coat' => 'Пальто',
        'обувь|obuv|shoe|shoes|ботинки|туфли|кроссовки|сандалии|балетки' => 'Обувь',
        'аксессуар|accessories|accessory|watch|часы|сумка|ремень' => 'Аксессуары'
    ];

    foreach ($categoryPatterns as $pattern => $dbValue) {
        if (preg_match('/\b(' . $pattern . ')\b/iu', $message)) {
            $category = $dbValue;
            break;
        }
    }

    // 4. Taille 
    $size = null;
    if (preg_match('/\b(36|37|38|39|40|41|42|s|m|l|xl)\b/i', $message, $m)) {
        $size = strtoupper($m[1]);
    }

    // 5. PRIX (plages et budgets)
    $minPrice = null;
    $maxPrice = null;
    
    if (preg_match('/(?:entre|between)\s+(\d+)(?:\s*(?:et|and|-)\s*|\s+to\s+)(\d+)/i', $message, $m)) {
        $minPrice = (float)$m[1];
        $maxPrice = (float)$m[2];
    } 
    elseif (preg_match('/(?:moins\s+(?:de|que)|less\s+than|under|below|max|maximum)\s+(\d+)/i', $message, $m)) {
        $maxPrice = (float)$m[1];
    } 
    elseif (preg_match('/(?:plus\s+(?:de|que)|more\s+than|over|above|min|minimum|at\s+least)\s+(\d+)/i', $message, $m)) {
        $minPrice = (float)$m[1];
    }
    elseif (preg_match('/(?:budget|around|approximately|environ|about)\s+(\d+)/i', $message, $m)) {
        $basePrice = (float)$m[1];
        $minPrice = $basePrice * 0.8;
        $maxPrice = $basePrice * 1.2;
    }

    /* ========== CONNEXION DB ========== */
    $pdo = new PDO(
        "mysql:host=localhost;dbname=php_project;charset=utf8mb4",
        "root",
        ""
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    /* ========== SQL DYNAMIQUE RICHE ========== */
    $sql = "
    SELECT 
        p.product_id,
        p.product_name,
        p.product_price,
        p.product_category,
        p.product_color,
        p.product_gender,
        p.product_image,
        CONCAT('http://localhost/project-e-commerce/single_product.php?product_id=', p.product_id) AS product_link,
        GROUP_CONCAT(DISTINCT s.size) as sizes
    FROM products p
    LEFT JOIN product_sizes s 
        ON p.product_id = s.product_id
    WHERE 1=1
    ";

    $params = [];

    // Filtre Couleur (utilise = au lieu de LIKE pour plus de précision)
    if ($color) {
        $sql .= " AND p.product_color = ?";
        $params[] = $color;
    }

    // Filtre Catégorie (utilise = pour correspondance exacte)
    if ($category) {
        $sql .= " AND p.product_category = ?";
        $params[] = $category;
    }

    // Filtre GENRE (CORRIGÉ - utilise les valeurs exactes de la BD)
    if ($gender) {
        $sql .= " AND (p.product_gender = ? OR p.product_gender = 'Унисекс' OR p.product_gender = '' OR p.product_gender IS NULL)";
        $params[] = $gender;
    }

    // Filtre PRIX MIN
    if ($minPrice !== null) {
        $sql .= " AND p.product_price >= ?";
        $params[] = $minPrice;
    }

    // Filtre PRIX MAX
    if ($maxPrice !== null) {
        $sql .= " AND p.product_price <= ?";
        $params[] = $maxPrice;
    }

    // Filtre Taille
    if ($size) {
        $sql .= " AND EXISTS (
            SELECT 1 FROM product_sizes ps 
            WHERE ps.product_id = p.product_id 
            AND ps.size = ?
        )";
        $params[] = $size;
    }

    $sql .= "
        GROUP BY p.product_id
        ORDER BY
        (
            (CASE WHEN p.product_category = ? THEN 1 ELSE 0 END) +
            (CASE WHEN p.product_color = ? THEN 1 ELSE 0 END) +
            (CASE WHEN p.product_gender = ? THEN 1 ELSE 0 END)
        ) DESC,
        p.product_price ASC
        LIMIT 5
        ";

    /* ========== EXÉCUTION ========== */
    $paramsScore = [];

    $paramsScore[] = $category ? $category : "";
    $paramsScore[] = $color ? $color : "";
    $paramsScore[] = $gender ? $gender : "";

    $params = array_merge($params, $paramsScore);

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    /* ========== PRÉPARATION CONTEXTE AI ========== */
    $productText = "";
    $filtersUsed = [];
    
    if ($category) $filtersUsed[] = "category: $category";
    if ($color) $filtersUsed[] = "color: $color";
    if ($gender) $filtersUsed[] = "gender: $gender";
    if ($size) $filtersUsed[] = "size: $size";
    if ($minPrice !== null && $maxPrice !== null) {
        $filtersUsed[] = "price range: " . round($minPrice) . "-" . round($maxPrice) . " MAD";
    } elseif ($minPrice !== null) {
        $filtersUsed[] = "min price: " . round($minPrice) . " руб";
    } elseif ($maxPrice !== null) {
        $filtersUsed[] = "max price: " . round($maxPrice) . " руб";
    }

    foreach ($products as $p) {
        $productText .= "
    PRODUCT:
    name: {$p["product_name"]}
    category: {$p["product_category"]}
    color: {$p["product_color"]}
    price: {$p["product_price"]} руб
    sizes: {$p["sizes"]}
    
    ";
    }

/* ========== PROMPT RICHE POUR AI ========== */
$prompt = "
You are Élégancia, an intelligent e-commerce shopping assistant. 
IMPORTANT: You must answer ONLY in Russian language (русский язык).

USER REQUEST: \"$message\"

FILTERS APPLIED: " . (empty($filtersUsed) ? "None (general inquiry)" : implode(", ", $filtersUsed)) . "

AVAILABLE PRODUCTS FROM DATABASE:
" . ($productText ?: "No products match these exact criteria.") . "

BEHAVIOR RULES:
1. Keep responses natural and friendly like a shop assistant.

2. Start with a short natural sentence like:
\"Я нашла несколько вариантов, которые могут вам понравиться.\"

3. Mention 1–2 products from the database in the message.

4. For each product include:
- product_name
- product_price
- a short phrase based on product_description

5. Do NOT list links in the message text.
The interface will display product buttons automatically.

6. Do NOT invent products.
Only use products from the database.

7. Keep the response short (2–4 sentences maximum).

8. If only one product matches, describe only that product.

9. If the user only greets, respond:
\"Здравствуйте! Я Элегансия, ваш виртуальный помощник. Чем могу помочь?\"

10. Never repeat the same product twice.

EXAMPLES:

User: \"привет\"
You: Здравствуйте! Я Элегансия, ваш виртуальный помощник. Чем могу помочь?

User: \"у вас есть чёрное пальто для женщин?\"
You: Вот несколько вариантов:
• Название товара — Цена
• Название товара — Цена

User: \"спасибо\"
You: Пожалуйста! Если нужна еще помощь, обращайтесь.

If no products match:
К сожалению, я не нашел товары по вашему запросу. Попробуйте изменить цвет, размер или ценовой диапазон.

Your response (in Russian only, follow rules 3, 4 and 6 strictly):
";

    /* ========== APPEL OLLAMA ========== */
    $ollamaData = [
        "model" => "mistral:latest",
        "prompt" => $prompt,
        "stream" => false,
        "options" => [
            "temperature" => 0.8,
            "num_predict" => 300
        ]
    ];


    $ch = curl_init("http://localhost:11434/api/generate");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($ollamaData));
    curl_setopt($ch, CURLOPT_TIMEOUT, 300);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);

    $response = curl_exec($ch);

    if ($response === false) {
        echo json_encode([
            "status" => "error",
            "reply" => curl_error($ch)
        ]);
        exit;
    }

    curl_close($ch);

    $decoded = json_decode($response, true);

    if (!isset($decoded["response"])) {
        echo json_encode([
            "status" => "error",
            "reply" => "Invalid response from Ollama"
        ]);
        exit;
    }

    $reply = $decoded["response"];

    /* ========== TTS PIPER ========== */
    $ttsText = preg_replace('/http\S+/', '', $decoded["response"]);
    $ttsText = strip_tags($ttsText);
    $audioFile = "tts_" . time() . ".wav";

    $ttsData = json_encode([
        "text" => $ttsText
    ]);

    $ch = curl_init("http://localhost:5005/speak");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $ttsData);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);

    $audioData = curl_exec($ch);

    if ($audioData !== false) {
        file_put_contents($audioFile, $audioData);
    }

    curl_close($ch);
    //$finalReply = $predefinedReply ?? $decoded["response"];

    echo json_encode([
        "status" => "success",
        "reply" => $decoded["response"],
        "audio" => $audioFile,
        "products" => $products,
        "filters" => [
            "category" => $category,
            "color" => $color,
            "gender" => $gender,
            "size" => $size,
            "minPrice" => $minPrice,
            "maxPrice" => $maxPrice
        ]
    ]);

} catch (Exception $e) {
    echo json_encode([
        "status" => "error",
        "reply" => $e->getMessage()
    ]);
}
?>
# Technical Analysis Report: Élégancia E-Commerce Project

## 1. Project Structure (Folders and Main Files)

```
project-e-commerce/
├── Root Level Pages (15+ PHP files)
│   ├── index.php              # Homepage with featured products
│   ├── shop.php               # Product listing with search/filter
│   ├── cart.php               # Shopping cart with session management
│   ├── checkout.php           # Order checkout form
│   ├── single_product.php     # Individual product view
│   ├── contact.php            # Contact page
│   ├── login.php              # User login
│   ├── register.php           # User registration
│   ├── account.php            # User account dashboard
│   ├── order_details.php      # Order history
│   ├── payment.php            # Payment processing
│   ├── success_payment.php    # Payment success page
│   └── error.png, img.png     # Static assets (mistakenly in root)
│
├── api/                       # API Endpoints
│   └── get_products.php       # JSON API for products
│
├── server/                    # Backend Logic
│   ├── connection.php         # MySQL database connection
│   ├── get_featured_products.php
│   ├── get_coats.php
│   ├── get_shoes.php
│   └── place_order.php        # Order processing
│
├── layouts/                   # PHP Template System
│   ├── header.php             # Navigation & session start
│   └── footer.php             # Footer content
│
└── assets/
    ├── css/
    │   └── style.css          # Main stylesheet
    └── img/                   # Product images (80+ files)
```

---

## 2. Frontend Framework Used

**Technology Stack:**
- **HTML5** - Server-side rendered via PHP
- **CSS3** - Custom styles + Bootstrap 5.3.3 (CDN)
- **JavaScript** - Minimal, inline only (checkout.php)
- **No JS Framework** - No React, Vue, Angular, or jQuery

**External CDN Dependencies:**
```
html
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
```

**Frontend Approach:** Traditional multi-page application (MPA) with server-side rendering. Each page is a PHP file that renders HTML on the server before sending to the client.

---

## 3. How User Input is Handled

### Form Handling (Server-Side PHP)

**Search Form (shop.php):**
```
php
<form action="shop.php" method="POST">
    <input type="radio" name="category" value="Shoes">
    <input type="radio" name="category" value="coat">
    <input type="range" name="price" value="100">
    <input type="submit" name="search" value="search">
</form>
```
- **Processing:** PHP `$_POST` superglobal
- **Database Query:** Prepared statements with `$conn->prepare()`

**Add to Cart (single_product.php → cart.php):**
```
php
if (isset($_POST['add_to_cart'])) {
    $product_array = array(
        'product_id' => $product_id,
        'product_name' => $_POST['product_name'],
        'product_price' => $_POST['product_price'],
        'product_quantity' => $_POST['product_quantity']
    );
    $_SESSION['cart'][$product_id] = $product_array;
}
```

### Session-Based State Management

**PHP Sessions** (`$_SESSION`):
- Cart contents: `$_SESSION['cart']`
- Cart total: `$_SESSION['total']`
- User authentication: `$_SESSION['logged_in']`, `$_SESSION['user_id']`
- Order ID: `$_SESSION['order_id']`

**Cart Operations:**
```
php
// Add product
$_SESSION['cart'][$product_id] = $product_array;

// Remove product
unset($_SESSION['cart'][$product_id]);

// Update quantity
$_SESSION['cart'][$product_id]['product_quantity'] = $quantity;
```

---

## 4. How Messages Are Currently Processed

**No existing chat/messaging system exists in this project.**

- **Contact page exists** (`contact.php`) - likely static HTML form
- **No WebSocket** implementation
- **No real-time messaging** capability
- **No AI/chatbot** integration

**Current "message" flow is limited to:**
- Order confirmation emails (via payment processor)
- Contact form submissions (if implemented - not examined)

---

## 5. Backend Connectivity

**Backend Stack:**
- **Language:** PHP 7+ (vanilla PHP, no framework)
- **Database:** MySQL (php_project database)
- **ORM/Query Builder:** None - raw MySQLi

**Database Connection (server/connection.php):**
```
php
$conn = mysqli_connect("localhost", "root", "", "php_project");
mysqli_set_charset($conn, "utf8mb4");
```

**No external backend services:**
- ❌ No Node.js
- ❌ No Express
- ❌ No Python/Django/Flask
- ❌ No Firebase
- ❌ No external REST APIs (except potential payment gateway)

---

## 6. How HTTP Requests Are Handled

**Request Handling Approach:**

| Method | Usage | Example |
|--------|-------|---------|
| **POST** | Form submissions | `$_POST['add_to_cart']`, `$_POST['search']` |
| **GET** | URL parameters | `single_product.php?product_id=5` |
| **PHP Include** | Server-side includes | `include('server/get_products.php')` |

**No AJAX/Fetch Usage:**
- ❌ No `fetch()` API calls
- ❌ No `axios` HTTP client
- ❌ No XMLHttpRequest
- ❌ No async operations

**Every request causes a full page reload:**
```
User clicks "Add to Cart" → POST to cart.php → Page reloads with updated cart
```

**Existing API Endpoint (unused by frontend):**
```
php
// api/get_products.php
header('Content-Type: application/json');
$sql = "SELECT product_id, product_name, product_price, product_image FROM products";
$products = $result->fetch_all();
echo json_encode($products);
```
This API exists but is **not called by any frontend code**.

---

## 7. How the UI is Structured

### Page Structure
```
┌─────────────────────────────────────────┐
│  layouts/header.php (Navigation)       │
├─────────────────────────────────────────┤
│                                         │
│  Page-specific Content (index.php,      │
│  shop.php, cart.php, etc.)              │
│                                         │
├─────────────────────────────────────────┤
│  layouts/footer.php                     │
└─────────────────────────────────────────┘
```

### No Component System
- ❌ No React/Vue components
- ❌ No PHP templating engine (Twig, Blade)
- ❌ No reusable UI components
- ❌ No JavaScript UI framework

### No Routing System
- Direct PHP file access: `index.php`, `shop.php`, `cart.php`
- Query string parameters for dynamic content: `single_product.php?product_id=X`
- No URL rewriting (no `.htaccess` mod_rewrite)

### CSS Architecture
- **Bootstrap** for grid/layout (container, row, col-*)
- **Custom CSS** in `assets/css/style.css`
- **Inline CSS** in PHP files for page-specific styles

---

## 8. Existing Chat System Logic

**No chat system exists in this project.**

What exists instead:
- **Contact form** (likely email-based, not examined)
- **User accounts** (registration/login)
- **Order messaging** (order status updates via payment)

---

## 9. Where a New API Endpoint Could Be Integrated

### Option A: Create New PHP API File
**Location:** `api/` directory

Example: `api/chat.php`
```
php
<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

include('../server/connection.php');

// Process chat message
$data = json_decode(file_get_contents('php://input'), true);
// ... process and return JSON
?>
```

### Option B: Modify Existing API
**File:** `api/get_products.php`
- Currently returns all products
- Could be extended to accept POST requests for messaging

### Option C: Create Chat Handler in /server
**Location:** `server/chat_handler.php`
- Similar to `place_order.php`
- Could handle chat message storage and retrieval

---

## 10. Unity WebGL Communication Strategy

### Current Architecture Limitation
The site has **no JavaScript** to communicate with Unity. Here's how to implement it:

### Step 1: Unity to JavaScript Bridge
Unity's WebGL build provides:
```
javascript
// In Unity (C#):
Application.ExternalCall("unityToJs", "message from Unity");

// In JavaScript (in HTML page):
function unityToJs(message) {
    console.log("Received from Unity:", message);
    // Send to PHP backend via fetch()
    fetch('api/chat.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({message: message})
    });
}
```

### Step 2: JavaScript to Unity Bridge
```
javascript
// Send message from website TO Unity
function sendToUnity(message) {
    if (unityInstance) {
        unityInstance.SendMessage('GameObject', 'ReceiveMessage', message);
    }
}
```

### Step 3: Embed Unity in PHP Page
```
php
<!-- In index.php or any page -->
<iframe src="unity-build/index.html" id="unity-frame"></iframe>

<script>
    // Communication between PHP page and Unity iframe
    window.addEventListener('message', function(event) {
        // Receive from Unity
        console.log(event.data);
    });
</script>
```

### Recommended Integration Points

1. **Create chat API** (`api/chat.php`):
   - Store messages in MySQL database
   - Return message history via JSON

2. **Add JavaScript** (inline or `assets/js/unity-bridge.js`):
   - Use `fetch()` for async communication with PHP backend
   - Handle Unity ↔ JavaScript messaging

3. **Create database table** for chat:
```
sql
CREATE TABLE messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    message_text TEXT,
    source ENUM('website', 'unity'),
    created_at DATETIME
);
```

---

## Summary

| Aspect | Current State |
|--------|---------------|
| **Architecture** | PHP MPA with server-side rendering |
| **Frontend** | Bootstrap + Vanilla CSS, Minimal JS |
| **Backend** | PHP + MySQL (no frameworks) |
| **HTTP Client** | None (form submissions only) |
| **State Management** | PHP Sessions |
| **Chat System** | None (needs to be built) |
| **Unity Integration** | Not implemented, needs JS bridge |
| **API** | Exists but unused by frontend |

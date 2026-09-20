<?php 
session_start();
include('server/connection.php'); 

// Перенаправление, если не вошел в систему
if(!isset($_SESSION['user_id'])) {
  header('location: login.php?error=Пожалуйста, войдите в систему');
  exit();
}

// Выход из системы
if(isset($_GET['logout'])){
  if(isset($_SESSION['logged_in'])){
    unset($_SESSION['logged_in']);
    unset($_SESSION['user_name']);
    unset($_SESSION['user_email']);
    header('location: login.php');
    exit();
  }
}

// Смена пароля
if (isset($_POST['change_password'])) {
  $password = $_POST['password'];
  $confirm_password = $_POST['cpassword'];
  $user_email = $_SESSION['user_email'];

  if ($password !== $confirm_password) {
    header('location: account.php?error=Пароли не совпадают');
    exit();
  } else if (strlen($password) < 6) {
    header('location: account.php?error=Пароль должен содержать минимум 6 символов');
    exit();
  } else {
    $stmt = $conn->prepare("UPDATE users SET user_password=? WHERE user_email=?");
    $stmt->bind_param('ss', md5($password), $user_email);

    if ($stmt->execute()) {
      header('location: account.php?message=Пароль успешно обновлен');
      exit();
    } else {
      header('location: account.php?error=Ошибка при обновлении пароля');
      exit();
    }
  }
}

// Получение заказов
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM orders WHERE user_id=?");
$stmt->bind_param('i', $user_id);
$stmt->execute();
$orders = $stmt->get_result();
?>

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

    .account-section {
        position: relative;
        overflow: hidden;
        padding: 60px 0;
    }

    .account-section::before {
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
    .section-header-account {
        text-align: center;
        margin-bottom: 50px;
    }

    .section-label-account {
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 4px;
        color: var(--color-gold);
        font-weight: 600;
        margin-bottom: 15px;
        display: block;
    }

    .section-title-account {
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
    
    .account-card {
        background: #fff;
        border-radius: 20px;
        padding: 35px;
        box-shadow: 0 20px 60px rgba(139, 94, 94, 0.08);
        border: 1px solid rgba(139, 94, 94, 0.05);
        height: 100%;
        margin-bottom: 30px;
        transition: all 0.3s ease;
    }

    .account-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 25px 70px rgba(139, 94, 94, 0.12);
    }

    .account-card h3 {
        font-family: var(--font-serif);
        font-size: 1.3rem;
        letter-spacing: 1px;
        color: var(--color-dark);
        margin-bottom: 20px;
        font-weight: 500;
        text-align: center;
    }

    .divider-card {
        width: 40px;
        height: 2px;
        background: var(--color-gold);
        margin: 0 auto 25px;
        border: none;
        opacity: 1;
    }

    .info-item { 
        margin-bottom: 18px; 
        font-size: 0.95rem; 
        color: var(--color-gray);
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 10px;
        border-bottom: 1px solid rgba(139, 94, 94, 0.05);
    }
    
    .info-label { 
        font-weight: 600; 
        color: var(--color-dark);
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .info-value {
        color: var(--color-primary);
        font-weight: 500;
    }
    
    .btn-custom-dark {
        background-color: var(--color-dark);
        color: white;
        border-radius: 30px;
        padding: 14px 30px;
        border: none;
        transition: all 0.4s ease;
        font-size: 0.75rem;
        text-decoration: none;
        display: inline-block;
        cursor: pointer;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-weight: 600;
        position: relative;
        overflow: hidden;
    }

    .btn-custom-dark::before {
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

    .btn-custom-dark:hover::before {
        left: 0;
    }
    
    .btn-custom-dark:hover {
        color: #fff;
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(139, 94, 94, 0.3);
    }
    
    .link-red { 
        color: var(--color-primary); 
        text-decoration: none; 
        font-weight: 500;
        font-size: 0.85rem;
        transition: all 0.3s ease;
        position: relative;
    }

    .link-red::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 1px;
        background: var(--color-gold);
        transition: width 0.3s ease;
    }
    
    .link-red:hover { 
        color: var(--color-primary-dark); 
    }

    .link-red:hover::after {
        width: 100%;
    }

    .form-control-account {
        width: 100%;
        border-radius: 12px;
        padding: 14px 20px;
        border: 2px solid rgba(139, 94, 94, 0.1);
        margin-bottom: 15px;
        outline: none;
        background: var(--color-cream);
        transition: all 0.3s ease;
        font-size: 0.95rem;
    }

    .form-control-account:focus {
        background: #fff;
        border-color: var(--color-gold);
        box-shadow: 0 5px 20px rgba(201, 169, 98, 0.15);
    }

    .form-control-account::placeholder {
        color: rgba(0,0,0,0.3);
    }

    /* Алерты */
    .alert-luxe {
        border-radius: 12px;
        padding: 15px;
        font-size: 0.85rem;
        margin-bottom: 20px;
        text-align: center;
    }

    .alert-danger-luxe {
        background: rgba(139, 94, 94, 0.1);
        border: 1px solid rgba(139, 94, 94, 0.2);
        color: var(--color-primary-dark);
    }

    .alert-success-luxe {
        background: rgba(40, 167, 69, 0.1);
        border: 1px solid rgba(40, 167, 69, 0.2);
        color: #155724;
    }

    .orders-table-container {
        background: #fff;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 20px 60px rgba(139, 94, 94, 0.08);
        overflow-x: auto;
        border: 1px solid rgba(139, 94, 94, 0.05);
    }

    .orders-title {
        font-family: var(--font-serif);
        font-size: 2rem;
        color: var(--color-dark);
        font-weight: 400;
        margin-bottom: 30px;
        text-align: center;
    }

    table { 
        width: 100%; 
        border-collapse: collapse; 
        min-width: 600px; 
    }
    
    th { 
        background: var(--color-cream); 
        color: var(--color-dark); 
        padding: 18px 15px; 
        text-transform: uppercase; 
        font-size: 0.7rem;
        letter-spacing: 2px;
        font-weight: 600;
        border-bottom: 2px solid rgba(139, 94, 94, 0.1);
    }
    
    td { 
        padding: 18px 15px; 
        border-bottom: 1px solid rgba(139, 94, 94, 0.05); 
        text-align: center; 
        font-size: 0.9rem;
        color: var(--color-gray);
    }

    tr:hover td {
        background: rgba(139, 94, 94, 0.02);
    }
    
    .status-badge {
        padding: 8px 18px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
        background: var(--color-cream);
        color: var(--color-primary);
        border: 1px solid rgba(139, 94, 94, 0.1);
    }

    .empty-orders {
        text-align: center;
        padding: 60px 20px;
    }

    .empty-orders i {
        font-size: 3rem;
        color: var(--color-gold);
        margin-bottom: 20px;
        opacity: 0.5;
    }

    .empty-orders p {
        color: var(--color-gray);
        font-size: 1rem;
    }

    /* Адаптивность */
    @media (max-width: 768px) {
        .section-title-account {
            font-size: 1.8rem;
        }
        
        .account-card {
            padding: 25px;
        }
        
        .orders-table-container {
            padding: 20px;
        }
    }
</style>

<section class="account-section my-5 py-5">
    <div class="container">
        <div class="section-header-account">
            <span class="section-label-account">Личный кабинет</span>
            <h2 class="section-title-account">Мой аккаунт</h2>
            <hr class="divider-luxe">
        </div>

        <div class="row mt-5">
            <!-- Профиль -->
            <div class="col-lg-5 col-md-12 mb-4 ">
                <div class="account-card text-center">
                    <h3>Мой профиль</h3>
                    <hr class="divider-card">
                    
                    <div class="mt-4">
                        <div class="info-item">
                            <span class="info-label">Имя</span> 
                            <span class="info-value"><?php echo $_SESSION['user_name']; ?></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Email</span> 
                            <span class="info-value"><?php echo $_SESSION['user_email']; ?></span>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="#orders" class="btn-custom-dark mb-3 d-inline-block">Мои заказы</a> <br>
                        <a href="account.php?logout=1" class="link-red">Выйти из системы</a>
                    </div>
                </div>
            </div>

            <!-- Безопасность -->
            <div class="col-lg-7 col-md-12 h-100 ">
                <div class="account-card">
                    <h3>Безопасность</h3>
                    <hr class="divider-card">
                    
                    <form class="mt-4" method="POST" action="account.php">
                        <?php if (isset($_GET['error'])): ?>
                            <div class="alert-luxe alert-danger-luxe">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <?php echo $_GET['error']; ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if (isset($_GET['message'])): ?>
                            <div class="alert-luxe alert-success-luxe">
                                <i class="fas fa-check-circle me-2"></i>
                                <?php echo $_GET['message']; ?>
                            </div>
                        <?php endif; ?>

                        <div class="form-group mb-3">
                            <label class="small ms-3 mb-2 text-muted" style="text-transform: uppercase; letter-spacing: 1px; font-size: 0.7rem;">Новый пароль</label>
                            <input type="password" class="form-control-account" placeholder="••••••••" name="password" required>
                        </div>
                        <div class="form-group mb-4">
                            <label class="small ms-3 mb-2 text-muted" style="text-transform: uppercase; letter-spacing: 1px; font-size: 0.7rem;">Подтвердите пароль</label>
                            <input type="password" class="form-control-account" placeholder="••••••••" name="cpassword" required>
                        </div>

                        <div class="text-center">
                            <input type="submit" value="Обновить пароль" name="change_password" class="btn-custom-dark w-100">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- История заказов -->
    <div class="container mt-5" id="orders">
        <h2 class="orders-title">История заказов</h2>
        <div class="orders-table-container">
            <?php if(isset($orders) && $orders->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>№ заказа</th>
                        <th>Сумма</th>
                        <th>Статус</th>
                        <th>Дата</th>
                        <th>Действие</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $orders->fetch_assoc()): ?>
                    <tr>
                        <td><strong style="color: var(--color-dark);">#<?php echo $row['order_id']; ?></strong></td>
                        <td style="color: var(--color-primary); font-weight: 600;">$<?php echo $row['order_cost']; ?></td>
                        <td><span class="status-badge"><?php echo $row['order_status']; ?></span></td>
                        <td><?php echo date('d.m.Y', strtotime($row['order_date'])); ?></td>
                        <td>
                            <form method="GET" action="order_details.php">
                                <input type="hidden" value="<?php echo $row['order_id']; ?>" name="order_id">
                                <input class="btn-custom-dark py-2 px-4" style="font-size: 0.7rem;" type="submit" value="Детали">
                            </form>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <?php else: ?>
                <div class="empty-orders">
                    <i class="fas fa-shopping-bag"></i>
                    <p>У вас пока нет заказов.</p>
                    <a href="shop.php" class="btn-custom-dark mt-3">Перейти в магазин</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include('layouts/footer.php');?>
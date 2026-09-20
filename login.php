<?php 
// 1. Запуск сессии и подключение к базе данных
session_start();
include('server/connection.php'); 

// Перенаправление, если пользователь уже вошел
if(isset($_SESSION['logged_in'])){
    header('location: account.php');
    exit;
}

// 2. Логика обработки формы
if(isset($_POST['login_btn'])) {
  $email = $_POST['email'];
  $password = md5($_POST['password']); // Хеширование MD5 для соответствия БД

  $stmt = $conn->prepare("SELECT user_id, user_name, user_email, user_password FROM users WHERE user_email=? AND user_password=? LIMIT 1");
  $stmt->bind_param('ss', $email, $password);

  if($stmt->execute()) {
      $stmt->store_result();
      if($stmt->num_rows() == 1){
          $stmt->bind_result($user_id, $user_name, $user_email, $user_password);
          $stmt->fetch();

          $_SESSION['user_id'] = $user_id;
          $_SESSION['user_name'] = $user_name;
          $_SESSION['user_email'] = $user_email;
          $_SESSION['logged_in'] = true;

          header('location: account.php?login_success=Вы успешно вошли в систему');
          exit();
      } else {
          header('location: login.php?error=Неверный email или пароль');
          exit();
      }
  } else {
      header('location: login.php?error=Что-то пошло не так');
      exit();
  }
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
        --font-serif: 'Playfair Display', serif;
        --font-sans: 'Inter', sans-serif;
    }

    body {
        background: linear-gradient(135deg, #f5f0e8 0%, #ebe5d9 100%);
        font-family: var(--font-sans);
    }

    /* Декоративный элемент */
    .login-section {
        position: relative;
        overflow: hidden;
        padding: 60px 0;
    }

    .login-section::before {
        content: '';
        position: absolute;
        top: -100px;
        right: -100px;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(201, 169, 98, 0.1) 0%, transparent 70%);
        pointer-events: none;
    }

    .login-box {
        max-width: 480px;
        width: 95%;
        margin: 40px auto;
        padding: 50px 40px;
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(139, 94, 94, 0.1);
        border: 1px solid rgba(139, 94, 94, 0.05);
        position: relative;
    }

    /* Заголовок секции */
    .section-header-login {
        text-align: center;
        margin-bottom: 30px;
    }

    .section-label-login {
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 4px;
        color: var(--color-gold);
        font-weight: 600;
        margin-bottom: 15px;
        display: block;
    }

    .section-title-login {
        font-family: var(--font-serif);
        font-size: 2rem;
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

    /* Группы формы */
    .form-group-centered {
        margin-bottom: 25px;
    }

    .form-group-centered label {
        display: block;
        margin-bottom: 10px;
        font-weight: 500;
        color: var(--color-dark);
        text-transform: uppercase;
        font-size: 0.7rem;
        letter-spacing: 2px;
    }

    .form-control-custom {
        width: 100%;
        border-radius: 12px;
        padding: 15px 20px;
        border: 2px solid rgba(139, 94, 94, 0.1);
        background-color: var(--color-cream);
        outline: none;
        transition: all 0.3s ease;
        font-size: 0.95rem;
        color: var(--color-dark);
    }

    .form-control-custom::placeholder {
        color: rgba(0,0,0,0.3);
    }

    .form-control-custom:focus {
        background-color: #fff;
        border-color: var(--color-gold);
        box-shadow: 0 5px 20px rgba(201, 169, 98, 0.15);
    }

    /* Кнопка входа */
    .btn-login-main {
        width: 100%;
        background-color: var(--color-dark);
        color: white;
        border-radius: 30px;
        padding: 16px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: all 0.4s ease;
        margin-top: 15px;
        letter-spacing: 3px;
        text-transform: uppercase;
        font-size: 0.75rem;
        position: relative;
        overflow: hidden;
    }

    .btn-login-main::before {
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

    .btn-login-main:hover::before {
        left: 0;
    }

    .btn-login-main:hover {
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(139, 94, 94, 0.3);
    }

    /* Ссылка регистрации */
    .register-link-container {
        text-align: center;
        margin-top: 30px;
        padding-top: 25px;
        border-top: 1px solid rgba(139, 94, 94, 0.1);
    }

    .register-link-container p {
        color: var(--color-gray);
        font-size: 0.9rem;
        margin-bottom: 5px;
    }

    .register-link-container a {
        color: var(--color-primary);
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 600;
        transition: all 0.3s ease;
        position: relative;
    }

    .register-link-container a::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 1px;
        background: var(--color-gold);
        transition: width 0.3s ease;
    }

    .register-link-container a:hover {
        color: var(--color-primary-dark);
    }

    .register-link-container a:hover::after {
        width: 100%;
    }

    /* Алерт ошибки */
    .alert-luxe {
        background: rgba(139, 94, 94, 0.1);
        border: 1px solid rgba(139, 94, 94, 0.2);
        color: var(--color-primary-dark);
        border-radius: 12px;
        padding: 15px;
        font-size: 0.85rem;
        margin-bottom: 25px;
        text-align: center;
    }

    /* Адаптивность */
    @media (max-width: 576px) {
        .login-box {
            padding: 35px 25px;
            margin: 20px auto;
        }
        
        .section-title-login {
            font-size: 1.6rem;
        }
    }
</style>

<section class="login-section my-5 py-5">
    <div class="container">
        <div class="section-header-login">
            <span class="section-label-login">Добро пожаловать</span>
            <h2 class="section-title-login">Вход в систему</h2>
            <hr class="divider-luxe">
        </div>

        <div class="login-box">
            <form id="login-form" action="login.php" method="POST">
                
                <?php if(isset($_GET['error'])): ?>
                    <div class="alert-luxe">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <?php echo $_GET['error']; ?>
                    </div>
                <?php endif; ?>

                <div class="form-group-centered">
                    <label>Электронная почта</label>
                    <input type="email" class="form-control-custom" name="email" placeholder="ваш@email.com" required>
                </div>

                <div class="form-group-centered">
                    <label>Пароль</label>
                    <input type="password" class="form-control-custom" name="password" placeholder="Введите пароль" required>
                </div>

                <div class="form-group-centered">
                    <input type="submit" class="btn-login-main" name="login_btn" value="Войти">
                </div>

                <div class="register-link-container">
                    <p>Еще нет аккаунта?</p>
                    <a href="register.php">Зарегистрироваться сейчас</a>
                </div>
            </form>
        </div>
    </div>
</section>

<?php include('layouts/footer.php');?>
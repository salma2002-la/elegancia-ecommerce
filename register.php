<?php
session_start();
include('server/connection.php');

// Если нажата кнопка регистрации
if(isset($_POST['register'])){
    // Получаем данные из формы
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordconfirmation = $_POST['password_confirmation'];

    // Сравниваем пароль с подтверждением
    if($password !== $passwordconfirmation){
        header('location: register.php?error=Пароли не совпадают');
        exit();
    }
    // Проверка длины пароля (минимум 6 символов)
    else if(strlen($password)<6){
        header('location: register.php?error=Пароль должен содержать минимум 6 символов');
        exit();
    }

    // Проверка, существует ли пользователь с таким email
    $stmt1 = $conn->prepare("SELECT count(*) FROM users where user_email=?");
    $stmt1->bind_param('s',$email);
    $stmt1->execute();
    $stmt1->bind_result($num_rows);
    $stmt1->store_result();
    $stmt1->fetch();
    $stmt1->close();

    // Если пользователь с таким email уже существует
    if($num_rows !=0){
        header('location: register.php?error=Этот email уже используется');
        exit();
    }
    // Если пользователя нет, создаем нового
    else{
        $stmt = $conn->prepare("INSERT INTO users (user_name,user_email,user_password) VALUES(?,?,?) ");
        $stmt->bind_param('sss',$name,$email,md5($password));

        // Если аккаунт успешно создан
        if($stmt->execute()){
            $user_id = $stmt->insert_id;
            $_SESSION['user_id']=$user_id;
            $_SESSION['user_email']=$email;
            $_SESSION['user_name']=$name;
            $_SESSION['logged_in']=true;
            header('location: account.php?register_success=Вы успешно зарегистрировались');
            exit();
        }
        // Не удалось создать аккаунт
        else{
            header('location: register.php?error=Не удалось создать аккаунт. Попробуйте позже.');
            exit();
        }
    }

}
// Если пользователь уже вошел, перенаправляем в личный кабинет
else if(isset($_SESSION['logged_in'])){
  header('location: account.php');
  exit;
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

    /* Секция регистрации */
    .register-section {
        position: relative;
        overflow: hidden;
        padding: 60px 0;
    }

    .register-section::before {
        content: '';
        position: absolute;
        top: -100px;
        left: -100px;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(201, 169, 98, 0.1) 0%, transparent 70%);
        pointer-events: none;
    }

    /* Заголовок */
    .section-header-register {
        text-align: center;
        margin-bottom: 30px;
    }

    .section-label-register {
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 4px;
        color: var(--color-gold);
        font-weight: 600;
        margin-bottom: 15px;
        display: block;
    }

    .section-title-register {
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

    /* Контейнер формы */
    .register-box {
        max-width: 480px;
        width: 95%;
        margin: 40px auto;
        padding: 50px 40px;
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(139, 94, 94, 0.1);
        border: 1px solid rgba(139, 94, 94, 0.05);
    }

    /* Группы формы */
    .form-group {
        margin-bottom: 25px;
    }

    .form-group label {
        display: block;
        margin-bottom: 10px;
        font-weight: 500;
        color: var(--color-dark);
        text-transform: uppercase;
        font-size: 0.7rem;
        letter-spacing: 2px;
    }

    .form-control {
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

    .form-control::placeholder {
        color: rgba(0,0,0,0.3);
    }

    .form-control:focus {
        background-color: #fff;
        border-color: var(--color-gold);
        box-shadow: 0 5px 20px rgba(201, 169, 98, 0.15);
    }

    /* Алерт ошибки */
    .alert-error {
        background: rgba(139, 94, 94, 0.1);
        border: 1px solid rgba(139, 94, 94, 0.2);
        color: var(--color-primary-dark);
        border-radius: 12px;
        padding: 15px;
        font-size: 0.85rem;
        margin-bottom: 25px;
        text-align: center;
    }

    .alert-error::before {
        content: '⚠ ';
        font-size: 1.1rem;
    }

    /* Кнопка регистрации */
    #register-btn {
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

    #register-btn::before {
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

    #register-btn:hover::before {
        left: 0;
    }

    #register-btn:hover {
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(139, 94, 94, 0.3);
    }

    /* Ссылка входа */
    #login-url {
        display: block;
        width: 100%;
        text-align: center;
        margin-top: 20px;
        padding: 15px;
        color: var(--color-gray);
        text-decoration: none;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        border-radius: 12px;
        background: transparent;
        border: 1px solid transparent;
    }

    #login-url:hover {
        color: var(--color-primary);
        background: rgba(139, 94, 94, 0.05);
        border-color: rgba(139, 94, 94, 0.1);
    }

    #login-url strong {
        color: var(--color-primary);
        font-weight: 600;
    }

    /* Адаптивность */
    @media (max-width: 576px) {
        .register-box {
            padding: 35px 25px;
            margin: 20px auto;
        }
        
        .section-title-register {
            font-size: 1.6rem;
        }
    }
</style>

<section class="register-section my-5 py-5">
    <div class="container">
        <div class="section-header-register">
            <span class="section-label-register">Присоединяйтесь к нам</span>
            <h2 class="section-title-register">Создать аккаунт</h2>
            <hr class="divider-luxe">
        </div>

        <div class="register-box">
            <form id="registration-form" method="POST" action="register.php">
              
                <?php if(isset($_GET['error'])): ?>
                    <div class="alert-error">
                        <?php echo $_GET['error']; ?>
                    </div>
                <?php endif; ?>

                <div class="form-group">
                    <label>Имя</label>
                    <input type="text" class="form-control" id="register-name" name="name" placeholder="Введите ваше имя" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" id="register-email" name="email" placeholder="ваш@email.com" required>
                </div>

                <div class="form-group">
                    <label>Пароль</label>
                    <input type="password" class="form-control" id="register-password" name="password" placeholder="Минимум 6 символов" required>
                </div>

                <div class="form-group">
                    <label>Подтверждение пароля</label>
                    <input type="password" class="form-control" id="register-confirm-password" name="password_confirmation" placeholder="Повторите пароль" required>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn" id="register-btn" value="Зарегистрироваться" name="register">
                </div>

                <div class="form-group">
                    <a id="login-url" href="login.php">
                        Уже есть аккаунт? <strong>Войти</strong>
                    </a>
                </div>

            </form>
        </div>
    </div>
</section>

<?php include('layouts/footer.php');?>
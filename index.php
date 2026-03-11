<?php
require_once 'functions.php';
$user = getCurrentUser();
?>
<!DOCTYPE html>
<html>
<head>
    <title>SPA салон Акватера</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>SPA салон Акватера</h1>
        
                <nav style="margin: 20px 0;">
            <a href="index.php" style="margin: 0 10px;">Главная</a>
            <?php if ($user): ?>
                <span>Вы вошли как: <strong><?php echo $user; ?></strong></span>
                <a href="logout.php" style="margin: 0 10px;">Выйти</a>
            <?php else: ?>
                <a href="login.php" style="margin: 0 10px;">Войти</a>
                <a href="register.php" style="margin: 0 10px;">Регистрация</a>
            <?php endif; ?>
        </nav>
        
        <p>
            Добро пожаловать в наш SPA-салон!<br>
            Мы предлагаем расслабляющие процедуры, профессиональный уход за кожей
            и атмосферу полного отдыха.
        </p>
        
        <h2>Наши услуги</h2>
        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; margin: 20px 0;">
            <div style="background: white; padding: 15px; border-radius: 10px;">
                <h3>Тайский Массаж</h3>
                <p>Древнее искусство исцеления - 3000₽/час</p>
            </div>
            <div style="background: white; padding: 15px; border-radius: 10px;">
                <h3>Релакс-массаж с маслами</h3>
                <p>Полное расслабление - 2500₽/час</p>
            </div>
            <div style="background: white; padding: 15px; border-radius: 10px;">
                <h3>Антистресс-программа</h3>
                <p>Гармония тела и духа - 3500₽/2 часа</p>
            </div>
            <div style="background: white; padding: 15px; border-radius: 10px;">
                <h3>Косметология</h3>
                <p>Профессиональный уход - от 2000₽</p>
            </div>
        </div>
        
        <h2>Акции</h2>
        <p>✨ Специальная акция для новых гостей - Скидка 20% на первый визит ✨</p>
        
        <?php if ($user): ?>
            
            <?php if (isset($_SESSION['login_time'])): 
                $expire = $_SESSION['login_time'] + 86400;
                $remaining = $expire - time();
                if ($remaining > 0):
                    $hours = floor($remaining / 3600);
                    $minutes = floor(($remaining % 3600) / 60);
                    $seconds = $remaining % 60;
            ?>
                <div style="background: #8b5a7c; color: white; padding: 15px; border-radius: 10px; margin: 20px 0;">
                    <h3>🎁 Ваша персональная скидка действует:</h3>
                    <p style="font-size: 2em;"><?php echo $hours; ?>ч <?php echo $minutes; ?>мин <?php echo $seconds; ?>сек</p>
                </div>
            <?php 
                else: 
            ?>
                <p style="color: #999;">Персональная акция закончилась</p>
            <?php 
                endif;
            else:
            ?>
                <p style="color: #999;">Таймер не запущен</p>
            <?php 
                endif; 
            ?>
            
           
            <?php
            $birthday = getUserBirthday($user);
            if ($birthday):
                $today = new DateTime();
                $bday = new DateTime($birthday);
                $bday->setDate(
                    $today->format("Y"),
                    $bday->format("m"),
                    $bday->format("d")
                );
                
                if ($today > $bday) {
                    $bday->modify("+1 year");
                }
                
                $diff = $today->diff($bday)->days;
                
                if ($diff == 0):
            ?>
                <div style="background: gold; color: #333; padding: 20px; border-radius: 10px; margin: 20px 0;">
                    <h2>🎉 С ДНЕМ РОЖДЕНИЯ! 🎉</h2>
                    <p style="font-size: 1.5em;">Скидка <strong>20%</strong> на все услуги!</p>
                </div>
            <?php else: ?>
                <p>До вашего дня рождения осталось <strong><?php echo $diff; ?></strong> дней</p>
            <?php 
                endif;
            endif; 
            ?>
        <?php endif; ?>
        
        <h2>Фотогалерея</h2>
        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px;">
           <img src="https://images.pexels.com/photos/3997991/pexels-photo-3997991.jpeg?w=600" style="width: 100%; height: 300px; object-fit: cover; border-radius: 10px;">
<img src="https://images.pexels.com/photos/3768916/pexels-photo-3768916.jpeg?w=600" style="width: 100%; height: 300px; object-fit: cover; border-radius: 10px;">
<img src="https://images.pexels.com/photos/5069605/pexels-photo-5069605.jpeg?w=600" style="width: 100%; height: 300px; object-fit: cover; border-radius: 10px;">
<img src="https://images.pexels.com/photos/6621361/pexels-photo-6621361.jpeg?w=600" style="width: 100%; height: 300px; object-fit: cover; border-radius: 10px;">
        </div>
    </div>
</body>
</html>
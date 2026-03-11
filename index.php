<?php

require_once 'functions.php';

$user = getCurrentUser();

?>

<h1>SPA салон</h1>

<?php if ($user): ?>

<p>Вы вошли как: <?php echo $user; ?></p>

<a href="logout.php">Выйти</a>

<?php else: ?>

<a href="login.php">Войти</a>

<?php endif; ?>

<h2>Наши услуги</h2>

<ul>
<li>Классический массаж</li>
<li>SPA уход для лица</li>
<li>Ароматерапия</li>
<li>Косметология</li>
</ul>

<h2>Акции</h2>

<p>Скидка 10% на первый визит</p>

<img src="https://images.unsplash.com/photo-1544161515-4ab6ce6db874" width="500">

<?php

if ($user && isset($_SESSION['login_time'])) {

    $expire = $_SESSION['login_time'] + 86400;

    $remaining = $expire - time();

    if ($remaining > 0) {

        $hours = floor($remaining / 3600);
        $minutes = floor(($remaining % 3600) / 60);
        $seconds = $remaining % 60;

        echo "<h3>Персональная скидка действует:</h3>";
        echo $hours . " ч " . $minutes . " мин " . $seconds . " сек";

    } else {

        echo "<p>Акция закончилась</p>";

    }

}

?>
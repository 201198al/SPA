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

<?php

if ($user) {

    $file = file("users.txt");

    foreach ($file as $line) {

        list($login,$hash,$birthday) = explode(":", trim($line));

        if ($login === $user) {

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

            if ($diff == 0) {

                echo "<h2>Поздравляем Вас С ДНЕМ РОЖДЕНИЯ!</h2>";
                echo "<p>Скидка 20% на все услуги!</p>";

            } else {

                echo "<p>До вашего дня рождения осталось $diff дней</p>";

            }

        }

    }

}

?>
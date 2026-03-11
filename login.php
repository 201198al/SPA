<?php

require_once 'functions.php';

if (getCurrentUser() !== null) {
    header("Location: index.php");
    exit;
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $login = $_POST['login'];
    $password = $_POST['password'];

    if (checkPassword($login, $password)) {

        $_SESSION['login'] = $login;
        $_SESSION['login_time'] = time();

        header("Location: index.php");
        exit;

    } else {

        $error = "Неверный логин или пароль";

    }

}

?>

<link rel="stylesheet" href="style.css">

<h2>Вход</h2>

<form method="POST">

<p>Логин</p>
<input name="login">

<p>Пароль</p>
<input type="password" name="password">

<br><br>

<button>Войти</button>

</form>

<p style="color:red"><?php echo $error; ?></p>

<a href="register.php">Регистрация</a>
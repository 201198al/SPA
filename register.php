<?php

require_once 'functions.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $login = $_POST['login'];
    $password = $_POST['password'];
    $birthday = $_POST['birthday'];

    if (!existsUser($login)) {

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $data = $login . ":" . $hash . ":" . $birthday . "\n";

        file_put_contents("users.txt", $data, FILE_APPEND);

        $message = "Пользователь зарегистрирован";

    } else {

        $message = "Пользователь уже существует";

    }

}

?>

<h2>Регистрация</h2>

<form method="POST">

<p>Логин</p>
<input name="login">

<p>Пароль</p>
<input type="password" name="password">

<p>Дата рождения</p>
<input type="date" name="birthday">

<br><br>

<button>Зарегистрироваться</button>

</form>

<p><?php echo $message; ?></p>
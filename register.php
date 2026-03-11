<?php
require_once 'functions.php';
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $login = trim($_POST['login'] ?? '');
    $password = $_POST['password'] ?? '';
    $birthday = $_POST['birthday'] ?? '';
    
    if (empty($login) || empty($password) || empty($birthday)) {
        $message = "Все поля обязательны для заполнения";
    } elseif (!existsUser($login)) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $data = $login . ":" . $hash . ":" . $birthday . PHP_EOL;
        file_put_contents("users.txt", $data, FILE_APPEND | LOCK_EX);
        $message = "Регистрация успешна! Теперь вы можете войти.";
    } else {
        $message = "Пользователь с таким логином уже существует";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Регистрация</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Регистрация</h2>
        <form method="POST">
            <p>Логин</p>
            <input name="login" required>
            <p>Пароль</p>
            <input type="password" name="password" required>
            <p>Дата рождения</p>
            <input type="date" name="birthday" required>
            <br><br>
            <button>Зарегистрироваться</button>
        </form>
        <p style="color: <?php echo strpos($message, 'успешна') !== false ? 'green' : 'red'; ?>">
            <?php echo $message; ?>
        </p>
        <a href="login.php">Уже есть аккаунт? Войти</a>
    </div>
</body>
</html>
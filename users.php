<?php

if (!file_exists('users.txt') || filesize('users.txt') == 0) {
    $admin_hash = password_hash("12345", PASSWORD_DEFAULT);
    $data = "admin:" . $admin_hash . ":1990-01-01" . PHP_EOL;
    file_put_contents("users.txt", $data);
    echo "Админ создан! Логин: admin, пароль: 12345";
}
?>
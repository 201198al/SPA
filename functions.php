<?php
session_start();

function getUsersList() {
    $users = [];
    
    if (file_exists('users.txt')) {
        $lines = file('users.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            $parts = explode(':', trim($line));
            if (count($parts) >= 2) {
                $login = $parts[0];
                $hash = $parts[1];
                $birthday = $parts[2] ?? '';
                $users[$login] = [
                    'hash' => $hash,
                    'birthday' => $birthday
                ];
            }
        }
    }
    
    return $users;
}

function existsUser($login) {
    $users = getUsersList();
    return isset($users[$login]);
}

function checkPassword($login, $password) {
    $users = getUsersList();
    
    if (!existsUser($login)) {
        return false;
    }
    
    return password_verify($password, $users[$login]['hash']);
}

function getUserBirthday($login) {
    $users = getUsersList();
    return isset($users[$login]) ? $users[$login]['birthday'] : null;
}

function getCurrentUser() {
    if (isset($_SESSION['login'])) {
        return $_SESSION['login'];
    }
    return null;
}
?>
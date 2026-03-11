<?php

session_start();

require_once 'users.php';

function getUsersList() {
    global $users;
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

    return password_verify($password, $users[$login]);
}

function getCurrentUser() {

    if (isset($_SESSION['login'])) {
        return $_SESSION['login'];
    }

    return null;
}

?>
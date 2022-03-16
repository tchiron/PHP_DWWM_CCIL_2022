<?php

require_once '..' . DIRECTORY_SEPARATOR . 'User.php';

session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../blog.php');
    die;
}

session_destroy();
unset($_SESSION);
$params = session_get_cookie_params();
setcookie(
    session_name(),
    null,
    strtotime('yesterday'),
    $params["path"], $params["domain"],
    $params["secure"], $params["httponly"]
);
header('Location: ../blog.php');
die;
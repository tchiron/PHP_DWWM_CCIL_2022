<?php

require_once '..' . DIRECTORY_SEPARATOR . 'User.php';

session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../blog.php');
    die;
}

$id_article = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if (!empty($id_article)) {
    require_once '..' . DIRECTORY_SEPARATOR . 'librairie' . DIRECTORY_SEPARATOR . 'ArticleDao.php';
    $articleDao = new ArticleDao();
    $articleDao->delete($id_article);
    header('Location: ../blog.php');
    die;
}
<?php

use App\Controller\{ArticleController, SigninController, SignoutController, SignupController};

$router->map('GET', '/', function() {
    $articleController = new ArticleController();
    $articleController->index();
});
$router->map('POST', '/article/new', function() {
    $articleController = new ArticleController();
    $articleController->new();
});
$router->map('GET', '/article/show', function() {
    $articleController = new ArticleController();
    $articleController->show();
});
$router->map('PUT', '/article/edit', function() {
    $articleController = new ArticleController();
    $articleController->edit();
});
$router->map('DELETE', '/article/delete', function() {
    $articleController = new ArticleController();
    $articleController->delete();
});
$router->map('GET|POST', '/signup', function () {
    $signupController = new SignupController();
    $signupController->index();
});
$router->map('GET|POST', '/signin', function () {
    $signinController = new SigninController();
    $signinController->index();
});
$router->map('GET|POST', '/signout', function () {
    $signoutController = new SignoutController();
    $signoutController->index();
});

<?php

use App\Controller\{ArticleController, SigninController, SignoutController, SignupController};

$router->map('GET', '/', function() {
    $articleController = new ArticleController();
    $articleController->index();
});
$router->map('GET|POST', '/article/new', function() {
    $articleController = new ArticleController();
    $articleController->new();
});
$router->map('GET|POST', '/article/show/[i:id]', function(int $id) {
    $articleController = new ArticleController();
    $articleController->show($id);
});
$router->map('GET|POST', '/article/edit/[i:id]', function(int $id) {
    $articleController = new ArticleController();
    $articleController->edit($id);
});
$router->map('GET', '/article/delete/[i:id]', function(int $id) {
    $articleController = new ArticleController();
    $articleController->delete($id);
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

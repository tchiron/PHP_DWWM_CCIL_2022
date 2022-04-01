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
$router->map('GET', '/article/show/[i:id]', function(int $id) {
    $articleController = new ArticleController();
    $articleController->show($id);
});
$router->map('GET|POST', '/article/edit/[i:id]', function(int $id) {
    $articleController = new ArticleController();
    $articleController->edit($id);
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

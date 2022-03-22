<?php

use App\Controller\{ArticleController, SigninController, SignupController};

$router->map('GET', '/', function() {
    $articleController = new ArticleController();
    $articleController->index();
});
$router->map('GET|POST', '/article/new', function() {
    // TODO
    echo "Créer un nouvel article";
});
$router->map('GET|POST', '/article/edit/[i:id]', function(int $id) {
    // TODO
    echo "Editer un article en fonction de son id : $id";
});
$router->map('GET', '/article/delete/[i:id]', function(int $id) {
    // TODO
    echo "Supprimer un article en fonction de son id : $id";
});
$router->map('GET|POST', '/signup', function () {
    $signupController = new SignupController();
    $signupController->index();
});
$router->map('GET|POST', '/signin', function () {
    $signinController = new SigninController();
    $signinController->index();
});

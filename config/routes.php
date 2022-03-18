<?php

use App\Controller\ArticleController;

$router->map('GET', '/', function() {
    require_once implode(DIRECTORY_SEPARATOR, [ROOT, 'src', 'Controller', 'ArticleController.php']);
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

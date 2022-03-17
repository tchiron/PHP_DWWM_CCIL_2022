<?php

require_once implode(DIRECTORY_SEPARATOR, ['..', 'config', 'setup.php']);
require_once implode(DIRECTORY_SEPARATOR, [ROOT, 'vendor', 'autoload.php']);

session_start();

$requestUrl = filter_input(INPUT_SERVER, "REQUEST_URI");
$requestMethod = filter_input(INPUT_SERVER, "REQUEST_METHOD");

$router = new AltoRouter();

$router->map('GET', '/', function() {
    // TODO
    echo "Afficher tous les articles";
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

$match = $router->match($requestUrl, $requestMethod);

if (is_array($match) && is_callable($match['target'])) {
    call_user_func_array($match['target'], $match['params']);
} elseif (is_bool($match) && !$match) {
    // TODO
    echo 'error 404';
}

dump($requestUrl, $requestMethod, $router, $match);

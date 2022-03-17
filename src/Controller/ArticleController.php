<?php

class ArticleController
{
    public function index() {
        try {
            require_once implode(DIRECTORY_SEPARATOR, [ROOT, 'src', 'Dao', 'ArticleDao.php']);
            $articleDao = new ArticleDao();
            $articles = $articleDao->getAll();
            require_once implode(DIRECTORY_SEPARATOR, [VIEW, 'article', 'index.html.php']);
        } catch (PDOException $e) {
            echo "Oups ! Something gone wrong";
            echo "<br>";
            echo $e->getMessage();
            die;
        }
    }

    public function new() {
        // TODO ...
    }

    public function show(int $id) {
        // TODO ...
    }

    public function edit(int $id) {
        // TODO ...
    }

    public function delete(int $id) {
        // TODO ...
    }
}
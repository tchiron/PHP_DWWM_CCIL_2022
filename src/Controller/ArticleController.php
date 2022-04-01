<?php

namespace App\Controller;

use PDOException;
use App\Model\Article;
use App\Dao\ArticleDao;

class ArticleController
{
    public function index()
    {
        try {
            $articleDao = new ArticleDao();
            $articles = $articleDao->getAll();

            for ($i = 0; $i < count($articles); $i++) {
                $articles[$i] = $articles[$i]->toArray();
            }

            header("Content-Type: application/json");
            echo json_encode($articles);
        } catch (PDOException $e) {
            // TODO
        }
    }

    public function new()
    {
//        if (!isset($_SESSION['user'])) {
//            header('Location: /');
//            die;
//        }

        $article_post = json_decode(file_get_contents('php://input'), true);

        /** Vérifies que les variables existent et qu'elles ne sont pas NULL */
        if (isset($article_post['title']) && isset($article_post['content'])) {
            /** Vérifies que les variables sont vide (false, NULL, 0, "", []) */
            if (empty(trim($article_post['title']))) {
                $error_messages[] = "Titre inexistant";
            }
            if (empty(trim($article_post['content']))) {
                $error_messages[] = "Contenu inexistant";
            }

            /** Vérifies que $error_messages n'existe pas */
            if (!isset($error_messages)) {
                $article = new Article();
                $article->setTitle($article_post['title'])
                    ->setContent($article_post['content']);
                $articleDao = new ArticleDao();
                $articleDao->new($article);

                header("Content-Type: application/json");
                echo json_encode([
                    'id_article' => $article->getIdArticle()
                ]);
            }
        }
        // TODO
    }

    public function show()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $articleDao = new ArticleDao();
        $article = $articleDao->getById($data['id_article']);

        if (!is_null($article)) {
            $article = $article->toArray();
        }

        header("Content-Type: application/json");
        echo json_encode($article);
    }

    public function edit()
    {
//        if (!isset($_SESSION['user'])) {
//            header('Location: /');
//            die;
//        }

        $article_post = json_decode(file_get_contents('php://input'), true);

        /** Vérifies que les variables existent et qu'elles ne sont pas NULL */
        if (isset($article_post['title']) && isset($article_post['content'])) {
            /** Vérifies que les variables sont vide (false, NULL, 0, "", []) */
            if (empty(trim($article_post['title']))) {
                $error_messages[] = "Titre inexistant";
            }
            if (empty(trim($article_post['content']))) {
                $error_messages[] = "Contenu inexistant";
            }

            /** Vérifies que $error_messages n'existe pas */
            if (!isset($error_messages)) {
                $article = Article::fromArray($article_post);
                $article->setIdArticle($article_post['id_article']);
                $articleDao = new ArticleDao();
                $articleDao->edit($article);
            }
        }
    }

    public function delete()
    {
//        if (!isset($_SESSION['user'])) {
//            header('Location: /');
//            die;
//        }

        $data = json_decode(file_get_contents('php://input'), true);

        $articleDao = new ArticleDao();
        $articleDao->delete($data['id_article']);
    }
}

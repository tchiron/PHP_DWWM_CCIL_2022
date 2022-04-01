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
            $json = file_get_contents('http://localhost:8000');
            $articles = json_decode($json, true);

            for ($i = 0; $i < count($articles); $i++) {
                $articles[$i] = Article::fromArray($articles[$i]);
            }

            require_once implode(DIRECTORY_SEPARATOR, [VIEW, 'article', 'index.html.php']);
        } catch (PDOException $e) {
            echo "Oups ! Something gone wrong";
            echo "<br>";
            echo $e->getMessage();
            die;
        }
    }

    public function new()
    {
//        if (!isset($_SESSION['user'])) {
//            header('Location: /');
//            die;
//        }

        /**
         * Tableau d'arguments qui va nous permettre de récupérer les données souhaitées dans filter_input_array
         * Les données qu'on souhaite récupérer sont : "title" et "content"
         * Et on a décidé de passer des filtres avec leurs options à "title"
         */
        $args = [
            "title" => [],
            'content' => []
        ];
        $article_post = filter_input_array(INPUT_POST, $args);

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
//                $article_post = $article->toArray();
//                $json = json_encode($article_post);
                $json = json_encode($article->toArray());

                $options = [
                    "http" => [
                        'method' => 'POST',
                        'header' => "Content-Type: application/json\r\n"
                            . "Content-Length: " . strlen($json) . "\r\n",
                        'content' => $json
                    ]
                ];
                $context = stream_context_create($options);

                $json = file_get_contents('http://localhost:8000/article/new', false, $context);

                $data = json_decode($json, true);

                /** Rediriges vers la page du nouvel article ajouté */
                header(sprintf('Location: /article/show/%d', $data['id_article']));
                die;
            }
        }

        require_once implode(DIRECTORY_SEPARATOR, [VIEW, 'article', 'new.html.php']);
    }

    public function show(int $id)
    {
        $json = json_encode([
            'id_article' => $id
        ]);
        $options = [
            "http" => [
                'method' => 'GET',
                'header' => "Content-Type: application/json\r\n"
                    . "Content-Length: " . strlen($json) . "\r\n",
                'content' => $json
            ]
        ];
        $context = stream_context_create($options);
        $json = file_get_contents('http://localhost:8000/article/show', false, $context);
        $article = json_decode($json, true);

        if (is_null($article)) {
            header('Location: /');
            die;
        } else {
            $article = Article::fromArray($article);
        }

        require_once implode(DIRECTORY_SEPARATOR, [VIEW, 'article', 'show.html.php']);
    }

    public function edit(int $id)
    {
//        if (!isset($_SESSION['user'])) {
//            header('Location: /');
//            die;
//        }

        $articleDao = new ArticleDao();
        $article = $articleDao->getById($id);

        if (is_null($article)) {
            header('Location: /');
            die;
        }

        /**
         * Tableau d'arguments qui va nous permettre de récupérer les données souhaitées dans filter_input_array
         * Les données qu'on souhaite récupérer sont : "title" et "content"
         * Et on a décidé de passer des filtres avec leurs options à "title"
         */
        $args = [
            "title" => [],
            'content' => []
        ];
        $article_post = filter_input_array(INPUT_POST, $args);

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
                $article->setTitle($article_post['title'])
                    ->setContent($article_post['content']);
                $articleDao->edit($article);
                /** Rediriges vers la page de l'article édité */
                header(sprintf('Location: /article/show/%d', $article->getIdArticle()));
                die;
            }
        }

        require_once implode(DIRECTORY_SEPARATOR, [VIEW, 'article', 'edit.html.php']);
    }

    public function delete(int $id)
    {
//        if (!isset($_SESSION['user'])) {
//            header('Location: /');
//            die;
//        }

        $json = json_encode([
            'id_article' => $id
        ]);

        $options = [
            "http" => [
                'method' => 'DELETE',
                'header' => "Content-Type: application/json\r\n"
                    . "Content-Length: " . strlen($json) . "\r\n",
                'content' => $json
            ]
        ];
        $context = stream_context_create($options);

        file_get_contents('http://localhost:8000/article/delete', false, $context);

        header('Location: /');
        die;
    }
}

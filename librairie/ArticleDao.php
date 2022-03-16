<?php

require_once 'connect_sql.php';
require_once realpath(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'Article.php');

class ArticleDao
{
    /**
     * Récupères de la base de données tous les articles
     *
     * @return Article[] Tableau d'objet Article
     */
    function getAllArticle(): array
    {
        $dbh = databaseGenerator();
        $sth = $dbh->prepare("SELECT * FROM `article`");
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);

        for ($i = 0; $i < count($result); $i++) {
            $a = new Article();
            $result[$i] = $a->setIdArticle($result[$i]['id_article'])
                ->setTitle($result[$i]['title'])
                ->setContent($result[$i]['content'])
                ->setCreatedAt($result[$i]['created_at']);
//        $a->setIdArticle($result[$i]['id_article']);
//        $a->setTitle($result[$i]['title']);
//        $a->setContent($result[$i]['content']);
//        $a->setCreatedAt($result[$i]['created_at']);
//        $result[$i] = $a;
        }

        return $result;
    }

    /**
     * Récupères de la base de données un article en fonction de son id
     *
     * @param int $id Identifiant de l'article qu'on doit récupérer de la bdd
     * @return Article Objet de l'article récupéré en bdd
     */
    function getArticleById(int $id): Article
    {
        $dbh = databaseGenerator();
        $sth = $dbh->prepare("SELECT * FROM `article` WHERE id_article = :id_article");
        $sth->execute([":id_article" => $id]);
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        $a = new Article();
        return $a->setIdArticle($result['id_article'])
            ->setTitle($result['title'])
            ->setContent($result['content'])
            ->setCreatedAt($result['created_at']);
    }

    /**
     * Ajoutes un article à la base de données et assigne l'id de l'article créé
     *
     * @param Article $article Objet de l'article à ajouter à la bdd
     */
    function newArticle(Article $article): void
    {
        $dbh = databaseGenerator();
        $sth = $dbh->prepare(
            "INSERT INTO `article` (title, content)
                                        VALUES (:title, :content)"
        );
        $sth->execute([
            ':title' => $article->getTitle(),
            ':content' => $article->getContent()
        ]);
        $article->setIdArticle($dbh->lastInsertId());
    }

    /**
     * Edites un article de la base de données
     *
     * @param Article $article Objet de l'article à éditer
     */
    function editArticle(Article $article): void
    {
        $dbh = databaseGenerator();
        $sth = $dbh->prepare(
            "UPDATE `article` SET title = :title, content = :content WHERE id_article = :id_article"
        );
        $sth->execute([
            ':title' => $article->getTitle(),
            ':content' => $article->getContent(),
            ':id_article' => $article->getIdArticle()
        ]);
    }

    /**
     * Supprimes un article de la base de données
     *
     * @param int $id Identifiant de l'article à supprimer
     */
    function deleteArticle(int $id): void
    {
        $dbh = databaseGenerator();
        $sth = $dbh->prepare("DELETE FROM `article` WHERE id_article = :id_article");
        $sth->execute([":id_article" => $id]);
    }
}

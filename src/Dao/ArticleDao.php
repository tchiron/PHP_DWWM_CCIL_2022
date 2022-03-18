<?php

namespace App\Dao;

use PDO;
use App\Model\Article;

class ArticleDao extends AbstractDao
{
    /**
     * Récupères de la base de données tous les articles
     *
     * @return Article[] Tableau d'objet Article
     */
    function getAll(): array
    {
        $sth = AbstractDao::$dbh->prepare("SELECT * FROM `article`");
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);

        for ($i = 0; $i < count($result); $i++) {
            $a = new Article();
            $result[$i] = $a->setIdArticle($result[$i]['id_article'])
                ->setTitle($result[$i]['title'])
                ->setContent($result[$i]['content'])
                ->setCreatedAt($result[$i]['created_at']);
        }

        return $result;
    }

    /**
     * Récupères de la base de données un article en fonction de son id
     *
     * @param int $id Identifiant de l'article qu'on doit récupérer de la bdd
     * @return Article Objet de l'article récupéré en bdd
     */
    function getById(int $id): Article
    {
        $sth = AbstractDao::$dbh->prepare("SELECT * FROM `article` WHERE id_article = :id_article");
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
    function new(Article $article): void
    {
        $sth = AbstractDao::$dbh->prepare(
            "INSERT INTO `article` (title, content)
                                        VALUES (:title, :content)"
        );
        $sth->execute([
            ':title' => $article->getTitle(),
            ':content' => $article->getContent()
        ]);
        $article->setIdArticle(AbstractDao::$dbh->lastInsertId());
    }

    /**
     * Edites un article de la base de données
     *
     * @param Article $article Objet de l'article à éditer
     */
    function edit(Article $article): void
    {
        $sth = AbstractDao::$dbh->prepare(
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
    function delete(int $id): void
    {
        $sth = AbstractDao::$dbh->prepare("DELETE FROM `article` WHERE id_article = :id_article");
        $sth->execute([":id_article" => $id]);
    }
}

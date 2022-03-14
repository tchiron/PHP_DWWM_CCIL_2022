<?php

require_once 'connect_sql.php';

/**
 * Récupères de la base de données tous les articles
 *
 * @return array Tableau de tableaux associatifs d'articles
 */
function getAllArticle(): array
{
    $dbh = databaseGenerator();
    $sth = $dbh->prepare("SELECT * FROM `article`");
    $sth->execute();
    return $sth->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Récupères de la base de données un article en fonction de son id
 *
 * @param int $id Identifiant de l'article qu'on doit récupérer de la bdd
 * @return array Tableau associatif de l'article récupéré
 */
function getArticleById(int $id): array
{
    $dbh = databaseGenerator();
    $sth = $dbh->prepare("SELECT * FROM `article` WHERE id_article = :id_article");
    $sth->execute([":id_article" => $id]);
    return $sth->fetch(PDO::FETCH_ASSOC);
}

/**
 * Ajoutes un article à la base de données
 *
 * @param array $article Tableau associatif de l'article à ajouter à la bdd
 * @return int Renvoi l'identifiant de l'article ajouté
 */
function newArticle(array $article): int
{
    $dbh = databaseGenerator();
    $sth = $dbh->prepare(
        "INSERT INTO `article` (title, content)
                                        VALUES (:title, :content)"
    );
    $sth->execute([
        ':title' => $article['title'],
        ':content' => $article['content']
    ]);
    return $dbh->lastInsertId();
}

/**
 * Edites un article de la base de données
 *
 * @param array $article Tableau associatif de l'article à éditer
 */
function editArticle(array $article): void
{
    $dbh = databaseGenerator();
    $sth = $dbh->prepare(
        "UPDATE `article` SET title = :title, content = :content WHERE id_article = :id_article"
    );
    $sth->execute([
        ':title' => $article['title'],
        ':content' => $article['content'],
        ':id_article' => $article['id']
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

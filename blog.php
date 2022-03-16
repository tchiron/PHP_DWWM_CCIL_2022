<?php

require_once 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
require_once 'User.php';

session_start();
/**
 * On requiert le fichier "ArticleDao.php"
 *
 * "require_once" requiert le fichier qu'une seule et unique fois,
 * même si on a déjà fait appel à ce fichier
 */
try {
    require_once 'librairie' . DIRECTORY_SEPARATOR . 'ArticleDao.php';
    $articleDao = new ArticleDao();
    $articles = $articleDao->getAll();
    dump($articles);
} catch (PDOException $e) {
    echo "Oups ! Something gone wrong";
    echo "<br>";
    echo $e->getMessage();
    die;
}

?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<span>Bonjour <?= (isset($_SESSION['user'])) ? $_SESSION['user']->getPseudo() : "invité mystère"; ?> !</span>
<!-- Affichage des articles -->
<?php
foreach ($articles as $article) : ?>
    <article id="article<?= $article->getIdArticle() ?>">
        <h1><?= filter_var($article->getTitle(), FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?></h1>
        <span><?= filter_var($article->getCreatedAt(), FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?></span>
        <p><?= nl2br(filter_var($article->getContent(), FILTER_SANITIZE_FULL_SPECIAL_CHARS)) ?></p>
        <?php if (isset($_SESSION['user'])) : ?>
        <a href="<?= sprintf("/admin/edit_article.php?id=%d", $article->getIdArticle()) ?>">Editer</a>
        <a href="<?= sprintf("/admin/delete_article.php?id=%d", $article->getIdArticle()) ?>">Supprimer</a>
        <?php endif; ?>
    </article>
<?php
endforeach;
if (isset($_SESSION['user'])) : ?>
<a href="/admin/new_article.php">Nouvel article</a>
<?php endif; ?>

<!-- Formulaire de contact -->
</body>
</html>

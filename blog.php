<?php

session_start();
/**
 * On requiert le fichier "article_sql.php"
 *
 * "require_once" requiert le fichier qu'une seule et unique fois,
 * même si on a déjà fait appel à ce fichier
 */
try {
    require_once 'librairie' . DIRECTORY_SEPARATOR . 'article_sql.php';
    $articles = getAllArticle();
} catch (PDOException $e) {
    echo "Oups ! Something gone wrong";
    echo "<br>";
    echo $e->getMessage();
    header('Location: error.php');
    die;
} catch (Error $e) {
    echo "Oups ! It gone even wronger";
    echo "<br>";
    $e->getMessage();
    die;
} catch (Exception $e) {
//    TODO
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
<!-- Affichage des articles -->
<?php
foreach ($articles as $article) : ?>
    <article id="article<?= $article['id_article'] ?>">
        <h1><?= filter_var($article["title"], FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?></h1>
        <span><?= filter_var($article["created_at"], FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?></span>
        <p><?= nl2br(filter_var($article["content"], FILTER_SANITIZE_FULL_SPECIAL_CHARS)) ?></p>
        <?php if (isset($_SESSION['isLogged'])) : ?>
        <a href="<?= sprintf("/admin/edit_article.php?id=%d", $article['id_article']) ?>">Editer</a>
        <a href="<?= sprintf("/admin/delete_article.php?id=%d", $article['id_article']) ?>">Supprimer</a>
        <?php endif; ?>
    </article>
<?php
endforeach;
if (isset($_SESSION['isLogged'])) : ?>
<a href="/admin/new_article.php">Nouvel article</a>
<?php endif; ?>

<!-- Formulaire de contact -->
</body>
</html>

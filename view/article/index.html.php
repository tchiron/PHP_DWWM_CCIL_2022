<?php require_once VIEW . DIRECTORY_SEPARATOR . 'header.html.php'; ?>
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

<?php require_once VIEW . DIRECTORY_SEPARATOR . "footer.html.php"; ?>
<?php require_once VIEW . DIRECTORY_SEPARATOR . 'header.html.php'; ?>

    <article id="article<?= $article->getIdArticle() ?>">
        <h1><?= filter_var($article->getTitle(), FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?></h1>
        <span><?= filter_var($article->getCreatedAt(), FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?></span>
        <p><?= nl2br(filter_var($article->getContent(), FILTER_SANITIZE_FULL_SPECIAL_CHARS)) ?></p>
        <?php // if (isset($_SESSION['user'])) : ?>
            <a href="<?= sprintf("/article/edit/%d", $article->getIdArticle()) ?>">Editer l'article</a>
            <a href="<?= sprintf("/article/delete/%d", $article->getIdArticle()) ?>">Supprimer l'article</a>
        <?php // endif; ?>
    </article>

<?php require_once VIEW . DIRECTORY_SEPARATOR . "footer.html.php"; ?>
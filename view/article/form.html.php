<form action="" method="post">
    <label for="title">Titre : </label>
    <input type="text" id="title" name="title" value="<?= isset($article) ? $article->getTitle() : ""; ?>">
    <br>
    <label for="content">Contenu : </label>
    <textarea name="content" id="content" cols="30" rows="10"><?= isset($article) ? $article->getContent() : ""; ?></textarea>
    <button type="submit">Envoyez</button>
</form>
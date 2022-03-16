<?php

require_once '..' . DIRECTORY_SEPARATOR . 'User.php';

session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../blog.php');
    die;
}

/**
 * Tableau d'arguments qui va nous permettre de récupérer les données souhaitées dans filter_input_array
 * Les données qu'on souhaite récupérer sont : "title" et "content"
 * Et on a décidé de passer des filtres avec leurs options à "title"
 */
$args = [
    "title" => [
        "filter" => FILTER_VALIDATE_REGEXP,
        "options" => [
            "regexp" => "#^[A-Z]#u"
        ]
    ],
    'content' => []
];
$article_post = filter_input_array(INPUT_POST, $args);

/** Vérifies que les variables existent et qu'elles ne sont pas NULL */
if (isset($article_post['title']) && isset($article_post['content'])) {
    /** Vérifies que les variables sont vide (false, NULL, 0, "", []) */
    if (empty($article_post['title'])) {
        $error_messages[] = "Titre inexistant";
    }
    if (empty(trim($article_post['content']))) {
        $error_messages[] = "Contenu inexistant";
    }

    /** Vérifies que $error_messages n'existe pas */
    if (!isset($error_messages)) {
        require_once '..' . DIRECTORY_SEPARATOR . 'librairie' . DIRECTORY_SEPARATOR . 'ArticleDao.php';
        $article = new Article();
        $article->setTitle($article_post['title'])
            ->setContent($article_post['content']);
        $articleDao = new ArticleDao();
        $articleDao->new($article);
        /** Rediriges vers ma page "blog.php" à l'ancre du nouvel article ajouté */
        header(sprintf('Location: ../blog.php#article%d', $article->getIdArticle()));
        die;
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
/** Vérifies que $error_messages existe. Si il existe, c'est qu'il y a des messages d'erreurs à afficher */
if (isset($error_messages)) :
    ?>
    <ul>
        <?php
        /**
         * Parcours le tableau de messages d'erreurs
         *
         * @var string $message Un message d'erreur à afficher
         */
        foreach ($error_messages as $message) :
            ?>
            <li><?= $message ?></li>
        <?php
        endforeach; ?>
    </ul>
<?php
endif; ?>
<form action="" method="post">
    <label for="title">Titre : </label><input type="text" id="title" name="title">
    <br>
    <label for="content">Contenu : </label>
    <textarea name="content" id="content" cols="30" rows="10"></textarea>
    <button type="submit">Envoyez</button>
</form>
</body>
</html>

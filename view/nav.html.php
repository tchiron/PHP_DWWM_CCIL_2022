<nav>
    <a href="/">Accueil</a>
    <?php //if (isset($_SESSION['user'])) : ?>
    <a href="/article/new">Nouvel article</a>
    <a href="/signout">Se déconnecter</a>
    <?php //else : ?>
    <a href="/signup">S'enregistrer</a>
    <a href="/signin">Se connecter</a>
    <?php //endif; ?>
</nav>
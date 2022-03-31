<?php require_once VIEW . DIRECTORY_SEPARATOR . 'header.html.php'; ?>

<?php require_once VIEW . DIRECTORY_SEPARATOR . 'error_messages.html.php'; ?>

    <form action="" method="post">
        <label for="email">Email : </label>
        <input type="email" id="email" name="email">
        <br>
        <label for="pwd">Mot de passe : </label>
        <input type="password" id="pwd" name="pwd">
        <br>
        <label for="conf_pwd">Confirmez mot de passe : </label>
        <input type="password" id="conf_pwd" name="conf_pwd"> <!-- conf_pwd = confirm password -->
        <br>
        <button type="submit">Envoyez</button>
    </form>

<?php require_once VIEW . DIRECTORY_SEPARATOR . "footer.html.php"; ?>
<?php

require_once '..' . DIRECTORY_SEPARATOR . 'User.php';
require_once '..' . DIRECTORY_SEPARATOR . 'librairie' . DIRECTORY_SEPARATOR . 'UserDao.php';

session_start();
if (isset($_SESSION['user'])) {
    header('Location: ../blog.php');
    die;
}

$args = [
    'email' => [
        'filter' => FILTER_VALIDATE_REGEXP,
        'options' => [
            'regexp' => '#^[\w_.-]+@[a-z]+\.[a-z]{2,}$#iu'
        ]
    ],
    'pwd' => []
];
$user_post = filter_input_array(INPUT_POST, $args);

if (isset($user_post['email']) && isset($user_post['pwd'])) {
    if (empty($user_post['email'])) {
        $error_messages[] = "Email requis";
    }
    if (empty($user_post['pwd'])) {
        $error_messages[] = "Mot de passe requis";
    }

    if (!isset($error_messages)) {
        $userDao = new UserDao();
        $user = $userDao->getByEmail($user_post['email']);

        if (!empty($user) && $user->verifyPwd($user_post['pwd'])) {
            session_start();
            $user->erasePwd();
            $_SESSION['user'] = $user;
            header('Location: ../blog.php');
            die;
        } else {
            $error_messages[] = 'Email ou mot de passe incorrect';
        }
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
    <title>Identifiez-vous</title>
</head>
<body>
<?php
if (isset($error_messages)) : ?>
    <ul>
        <?php
        foreach ($error_messages as $message) : ?>
            <li><?= $message ?></li>
        <?php
        endforeach; ?>
    </ul>
<?php
endif; ?>
<form action="" method="post">
    <label for="email">Email : </label>
    <input type="email" name="email" id="email">
    <br>
    <label for="pwd">Mot de passe : </label>
    <input type="password" name="pwd" id="pwd">
    <br>
    <button type="submit">Envoyez</button>
</form>
</body>
</html>

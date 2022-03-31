<?php

namespace App\Controller;

class SignoutController
{
    public function index()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /');
            die;
        }

        session_destroy();
        unset($_SESSION);
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            "",
            strtotime('yesterday'),
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
        header('Location: /');
        die;
    }
}
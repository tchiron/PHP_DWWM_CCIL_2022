<?php

namespace App\Controller;

use App\Dao\UserDao;
use App\Model\User;

class SignupController
{
    public function index()
    {
        if (isset($_SESSION['user'])) {
            header('Location: /');
            die;
        }

        $args = [
            'email' => [
                'filter' => FILTER_VALIDATE_EMAIL
            ],
            'pwd' => [],
            'conf_pwd' => []
        ];
        $user_post = filter_input_array(INPUT_POST, $args);

        if (isset($user_post['email']) && isset($user_post['pwd']) && isset($user_post['conf_pwd'])) {
            if (empty($user_post['email'])) {
                $error_messages[] = 'Email inexistant';
            }
            if (empty(trim($user_post['pwd']))) {
                $error_messages[] = 'Mot de passe inexistant';
            }
            if (empty(trim($user_post['conf_pwd']))) {
                $error_messages[] = 'Confirmation mot de passe inexistant';
            }
            if ($user_post['pwd'] !== $user_post['conf_pwd']) {
                $error_messages[] = 'Les mots de passe ne sont pas identiques';
            }

            if (!isset($error_messages)) {
                $userDao = new UserDao();
                $result = $userDao->getByEmail($user_post['email']);

                if (empty($result)) {
                    $user = new User();
                    $user->setEmail($user_post['email'])
                        ->setHashPwd($user_post['pwd']);
                    $userDao->new($user);
                    header('Location: /');
                    die;
                } else {
                    $error_messages[] = 'Email déjà utilisé';
                }
            }
        }

        require_once implode(DIRECTORY_SEPARATOR, [VIEW, 'sign', 'signup.html.php']);
    }
}
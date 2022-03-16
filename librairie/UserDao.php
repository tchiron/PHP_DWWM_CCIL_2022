<?php

require_once 'AbstractDao.php';

class UserDao extends AbstractDao
{
    /**
     * Récupère un utilisateur par son email si l'email existe dans la base de données,
     * sinon on récupèrera NULL
     *
     * @param string $email L'email de l'utilisateur
     * @return User|null Renvoi un utilisateur ou null
     */
    function getByEmail(string $email) : ?User
    {
        $sth = AbstractDao::$dbh->prepare('SELECT * FROM user WHERE email = :email');
        $sth->execute([':email' => $email]);
        $result = $sth->fetch(PDO::FETCH_ASSOC);

        if (is_null($result)) return null;

        $u = new User();
        return $u->setIdUser($result['id_user'])
            ->setPseudo($result['pseudo'])
            ->setPwd($result['pwd'])
            ->setEmail($result['email'])
            ->setCreatedAt($result['created_at']);
    }
}

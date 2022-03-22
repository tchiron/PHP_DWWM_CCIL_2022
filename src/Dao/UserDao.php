<?php

namespace App\Dao;

use PDO;
use Core\AbstractDao;
use App\Model\User;

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
        $sth = $this->dbh->prepare('SELECT * FROM user WHERE email = :email');
        $sth->execute([':email' => $email]);
        $result = $sth->fetch(PDO::FETCH_ASSOC);

        if (empty($result)) return null;

        $u = new User();
        return $u->setIdUser($result['id_user'])
            ->setPseudo($result['pseudo'])
            ->setPwd($result['pwd'])
            ->setEmail($result['email'])
            ->setCreatedAt($result['created_at']);
    }

    public function new(User $user) : void
    {
        $sth = $this->dbh->prepare('INSERT INTO user (pwd, email) VALUES (:pwd, :email)');
        $sth->execute([
            ':pwd' => $user->getPwd(),
            ':email' => $user->getEmail()
        ]);
    }
}

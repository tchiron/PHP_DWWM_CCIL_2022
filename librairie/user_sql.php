<?php

require_once 'connect_sql.php';

/**
 * Récupère un utilisateur par son email si l'email existe dans la base de données,
 * sinon on récupèrera NULL
 *
 * @param string $email L'email de l'utilisateur
 * @return array|null Renvoi un utilisateur ou null
 */
function getUserByEmail(string $email) : ?array
{
    $dbh = databaseGenerator();
    $sth = $dbh->prepare('SELECT * FROM user WHERE email = :email');
    $sth->execute([':email' => $email]);
    $result = $sth->fetch(PDO::FETCH_ASSOC);
    return ($result) ? $result : null;
//    return ($result) ? : null;
//    return ($sth->fetch(PDO::FETCH_ASSOC)) ? : null;
}
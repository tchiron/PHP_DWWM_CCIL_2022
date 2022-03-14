<?php

/**
 * Génères un objet PDO avec une connection à la base de données
 *
 * @return PDO Objet connecté à la base de données
 */
function databaseGenerator(): PDO
{
    static $dbh = '';

    if (!($dbh instanceof PDO)) {
        $filepath = is_file('config' . DIRECTORY_SEPARATOR . 'config.ini') ?
            'config' . DIRECTORY_SEPARATOR . 'config.ini' :
            '..' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.ini';
        $conf = parse_ini_file(
             $filepath,
            false,
            INI_SCANNER_TYPED
        );
        $dbh = new PDO(
            sprintf("%s:host=%s;dbname=%s;charset=%s",
                $conf['driver'],
                $conf['host'],
                $conf['dbname'],
                $conf['charset']
            ),
            $conf['username'],
            $conf['password'], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        );
    }

    return $dbh;
}

<?php

namespace App\Dao;

use PDO;

abstract class AbstractDao
{
    protected static PDO $dbh;

    public function __construct()
    {
        if (!(isset(AbstractDao::$dbh) && AbstractDao::$dbh instanceof PDO)) {
            $conf = parse_ini_file(
                DATABASE_CONFIG_FILEPATH,
                false,
                INI_SCANNER_TYPED
            );
            AbstractDao::$dbh = new PDO(
                sprintf(
                    "%s:host=%s;dbname=%s;charset=%s",
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
    }
}

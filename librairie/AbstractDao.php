<?php

abstract class AbstractDao
{
    protected static PDO $dbh;

    public function __construct()
    {
        if (!(isset(AbstractDao::$dbh) && AbstractDao::$dbh instanceof PDO)) {
            $filepath = is_file('config' . DIRECTORY_SEPARATOR . 'config.ini') ?
                'config' . DIRECTORY_SEPARATOR . 'config.ini' :
                '..' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.ini';
            $conf = parse_ini_file(
                $filepath,
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

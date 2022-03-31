<?php

namespace Core;

use PDO;

class Database extends PDO
{
    protected static Database $database;

    protected function __construct()
    {
        $conf = parse_ini_file(
            DATABASE_CONFIG_FILEPATH,
            false,
            INI_SCANNER_TYPED
        );
        parent::__construct(
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

    public static function getInstance(): Database
    {
        if (!isset(self::$database)) {
            self::$database = new Database();
        }

        return self::$database;
    }
}

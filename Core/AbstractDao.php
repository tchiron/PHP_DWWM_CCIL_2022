<?php

namespace Core;

abstract class AbstractDao
{
    protected Database $dbh;

    public function __construct()
    {
        $this->dbh = Database::getInstance();
    }
}

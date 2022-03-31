<?php

define('ROOT', realpath(__DIR__ . DIRECTORY_SEPARATOR . ".."));
define('VIEW', ROOT . DIRECTORY_SEPARATOR . 'view');
define('DATABASE_CONFIG_FILEPATH', implode(DIRECTORY_SEPARATOR, [ROOT, 'config', 'database.ini']));

<?php

use App\App;
use App\Config;

define('STORAGE_PATH',__DIR__.'/../storage');
define('VIEW_PATH',__DIR__.'/../views');

require __DIR__.'/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->safeLoad();
new App(new Config($_ENV));
require_once('../routes/index.php');


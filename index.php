<?php

declare(strict_types=1);

use Dotenv\Dotenv;

require_once 'vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

Flight::route("/users", function () {

    echo "Hello World!";
});

Flight::start();

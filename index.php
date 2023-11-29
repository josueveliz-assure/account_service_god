<?php

declare(strict_types=1);

use App\factories\UserControllerFactory;
use Dotenv\Dotenv;

require_once 'vendor/autoload.php';
require_once 'src/repositories/UserRespository.php';
require_once 'src/factories/UserControllerFactory.php';
require_once 'src/repositories/UserPGRespository.php';


$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: *");

$userControllerFactory = new UserControllerFactory();

Flight::route("POST /users", function () use ($userControllerFactory) {
    $userController = $userControllerFactory->createPGController();
    $userController->create();
});

Flight::start();

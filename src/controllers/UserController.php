<?php

namespace App\Controllers;

use App\Models\User;
use App\Repositories\UserRepository;
use Flight;

class UserController
{
    private readonly UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create() {
        try {
            $user = Flight::request()->data->getData();
            $user = $this->repository->create(new User(...$user));

            Flight::json($user, 201);
        } catch (\Exception $e) {
            Flight::halt(500, json_encode([
                "error" => $e->getMessage(),
                "trace" => $e->getTrace()
            ]));
        }
    }
}
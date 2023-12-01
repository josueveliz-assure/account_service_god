<?php

namespace App\Controllers;

use App\Models\Mappers\UserMapper;
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

    public function create()
    {
        try {
            $userData = Flight::request()->data->getData();
            $user = new User();
            $user->hydrate($userData);
            $user = $this->repository->create($user);

            Flight::json(UserMapper::toArrayWithoutPassword($user), 201);
        } catch (\Exception $e) {
            Flight::halt(500, json_encode([
                "error" => $e->getMessage(),
                "trace" => $e->getTrace()
            ]));
        }
    }

    public function getById(int $id)
    {
        try {
            $user = $this->repository->getById($id);
            Flight::json(UserMapper::toArrayWithoutPassword($user), 200);
        } catch (\Exception $e) {
            Flight::halt(404, json_encode([
                "error" => $e->getMessage(),
                "trace" => $e->getTrace()
            ]));
        }
    }

    public function getAll()
    {
        try {
            $users = $this->repository->getAll();
            $users = array_map(function ($user) {
                return UserMapper::toArrayWithoutPassword($user);
            }, $users);
            Flight::json($users, 200);
        } catch (\Exception $e) {
            Flight::halt(500, json_encode([
                "error" => $e->getMessage(),
                "trace" => $e->getTrace()
            ]));
        }
    }

    public function update(int $id)
    {
        try {
            $userData = Flight::request()->data->getData();
            $user = new User();
            $user->hydrate($userData);
            $user->setId($id);
            $user = $this->repository->update($user);
            Flight::json(UserMapper::toArrayWithoutPassword($user), 200);
        } catch (\Exception $e) {
            Flight::halt(404, json_encode([
                "error" => $e->getMessage(),
                "trace" => $e->getTrace()
            ]));
        }
    }

    public function delete(int $id)
    {
        try {
            $user = $this->repository->delete($id);
            Flight::json(UserMapper::toArrayWithoutPassword($user), 200);
        } catch (\Exception $e) {
            Flight::halt(404, json_encode([
                "error" => $e->getMessage(),
                "trace" => $e->getTrace()
            ]));
        }
    }
}
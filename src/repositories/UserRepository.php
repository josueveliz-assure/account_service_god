<?php

namespace App\Repositories;

use App\Models\User;

interface UserRepository
{
    public function create(User $user) : User;
    public function getById(int $id) : User;
    public function getAll() : array;
    public function update(User $user) : User;
    public function delete(int $id) : User;
}
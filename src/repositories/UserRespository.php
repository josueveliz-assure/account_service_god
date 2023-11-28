<?php

namespace App\Repositories;

use App\Models\User;

interface UserRepository
{
    public function getAll();
    public function getById(int $id);
    public function create(User $user);
    public function update(User $user);
    public function delete(int $id);
}
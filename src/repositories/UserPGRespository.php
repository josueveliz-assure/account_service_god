<?php

namespace App\Repositories;

use App\Config\DBConnection;
use App\Models\User;
use PDO;

class UserPGRepository implements UserRepository
{
    private PDO $db;

    public function __construct() {
        $this->db = DBConnection::getConnection();
    }

    public function create(User $user): array {
        $query = "INSERT INTO public.user (name, last_name, email, password, role_id) VALUES (:name, :last_name, :email, :password, :role_id)";
        $stmt = $this->db->prepare($query);
        print_r($user);
        $stmt->bindParam(':name', $user['name']);
        $stmt->bindParam(':last_name', $user['last_name']);
        $stmt->bindParam(':email', $user['email']);
        $stmt->bindParam(':password', $user['password']);
        $stmt->bindParam(':role_id', $user['role_id']);
        if (!$stmt->execute()) {
            throw new \Exception($stmt->errorInfo()[2]);
        }
        return [
            'id' => $this->db->lastInsertId(),
            'name' => $user['name'],
            'last_name' => $user['last_name'],
            'email' => $user['email'],
            'password' => $user['password'],
            'role_id' => $user['role_id']
        ];
    }
}
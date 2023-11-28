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

    public function getAll(): array {
        $query = "SELECT id, name, last_name, email, role_id FROM public.user";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $users = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $users;
    }

    public function getById(int $id): array {
        $query = "SELECT id, name, last_name, email, role_id FROM public.user WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);
        if($user == false){
            throw new \Exception("User not found");
        }
        return $user;
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

    public function update(User $user): array {
        $query = "UPDATE public.user SET name = :name, last_name = :last_name, email = :email, password = :password, role_id = :role_id WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $user['id']);
        $stmt->bindParam(':name', $user['name']);
        $stmt->bindParam(':last_name', $user['last_name']);
        $stmt->bindParam(':email', $user['email']);
        $stmt->bindParam(':password', $user['password']);
        $stmt->bindParam(':role_id', $user['role_id']);
        if(!$stmt->execute()) {
            throw new \Exception($stmt->errorInfo()[2]);
        }
        return $user->toArray();
    }

    public function delete(int $id): array {
        $user = $this->getById($id);
        $query = "DELETE FROM public.user WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        if(!$stmt->execute()) {
            throw new \Exception($stmt->errorInfo()[2]);
        }
        return $user;
    }
}
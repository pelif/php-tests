<?php 

namespace App\Repositories;

use App\Connection\MysqlConnection;
use PDO;

class CustomerRepository
{
    private ?PDO $conn = null;

    public function __construct()
    {
        $this->conn = MysqlConnection::getInstance(); 
    }

    public function insertCustomer(string $name, string $email): bool
    {        
        $stmt = $this->conn->prepare("INSERT INTO customers (name, email) VALUES (:name, :email)");        
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        return $stmt->execute();
    }

    public function updateCustomer(int $id, string $name, string $email): bool
    {
        $stmt = $this->conn->prepare("UPDATE customers SET name = :name, email = :email WHERE id = :id");
        return $stmt->execute([
            ':name' => $name, 
            ':email' => $email, 
            ':id' => $id
        ]);
    }

   
    
}
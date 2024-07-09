<?php 

namespace App\Repositories;

use App\Connection\MysqlConnection;
use PDO;

class CustomerRepository implements CustomerRepositoryInterface
{
    private ?PDO $conn = null;

    public function __construct()
    {
        $this->conn = MysqlConnection::getInstance(); 
    }

    public function all(): array
    {
        $stmt = $this->conn->query("SELECT * FROM customers ORDER BY name ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find(int $id): array
    {
        $stmt = $this->conn->prepare("SELECT * FROM customers WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function store(array $data): mixed
    {        
        $stmt = $this->conn->prepare("INSERT INTO customers (name, email) VALUES (:name, :email)");        
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':email', $data['email']);
        if($stmt->execute()) 
            return $this->find($this->conn->lastInsertId()); 

        return false;    
    }

    public function update($data): bool
    {
        $stmt = $this->conn->prepare("UPDATE customers SET name = :name, email = :email WHERE id = :id");
        return $stmt->execute([
            ':name' => $data['name'], 
            ':email' => $data['email'], 
            ':id' => $data['id']
        ]);
    }

    public function destroy(int $id): bool  
    {
        $stmt = $this->conn->prepare("DELETE FROM customers WHERE id = :id");
        return $stmt->execute([
            ':id' => $id
        ]);
    }

   
    
}
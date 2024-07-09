<?php 

namespace Tests\Feature;

use App\Connection\MysqlConnection;
use App\Repositories\CustomerRepository;
use PDO;
use PHPUnit\Framework\TestCase;
use stdClass;

Class CustomerRepositoryTest extends TestCase
{
    private ?PDO $conn = null; 

    public function setUp(): void
    {
        $this->conn = MysqlConnection::getInstance();

        $this->conn->exec('CREATE TABLE IF NOT EXISTS customers (
            id INT NOT NULL AUTO_INCREMENT, 
            name VARCHAR(255) NOT NULL, 
            email VARCHAR(255) NOT NULL, 
            PRIMARY KEY (id))'
        );

        $this->conn->exec('TRUNCATE TABLE customers');
    }

    public function testInsertCustomer(): void
    {
        $repository = new CustomerRepository();

        $name = 'John Doe';
        $email = 'XqgHJ@example.com';
        $data = ['name' => $name, 'email' => $email];
        $customer = $repository->store($data);
        $this->assertIsArray($customer); 

        $stmt = $this->conn->query("SELECT * FROM customers WHERE email = 'XqgHJ@example.com'");
        $customer = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->assertIsArray($customer); 
        $this->assertEquals($name, $customer['name']);
        $this->assertEquals($email, $customer['email']);
    }

    public function testUpdateCustomer(): void
    {
        $repository = new CustomerRepository();

        $name = 'John Doe';
        $email = 'XqgHJ@example.com';
        $data = ['name' => $name, 'email' => $email];
        $inserted = $repository->store($data);
        
        $id = $inserted['id']; 
        
        $name = 'Jane Doe';
        $email = 'email.updated@example.com';
        $result = $repository->update($id, $name, $email);
        $this->assertTrue($result);

        $stmt = $this->conn->prepare("SELECT * FROM customers WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $customer = $stmt->fetch(PDO::FETCH_ASSOC);        

        $this->assertIsArray($customer); 
        $this->assertEquals($name, $customer['name']);
        $this->assertEquals($email, $customer['email']);
    }

    public function testDeleteCustomer(): void
    {
        $repository = new CustomerRepository();
        $name = 'John Doe';
        $email = 'XqgHJ@example.com';
        $data = ['name' => $name, 'email' => $email];
        $customer = $repository->store($data);
        
        $id = $this->conn->lastInsertId();

        $customer = $repository->destroy($id);
        $this->assertTrue($customer);

        $stmt = $this->conn->query("SELECT * FROM customers WHERE id = $id");
        $customer = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->assertEmpty($customer);
    }
   

    
}
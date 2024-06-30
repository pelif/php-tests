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
        $customer = $repository->insertCustomer($name, $email);
        $this->assertTrue($customer); 

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
        $customer = $repository->insertCustomer($name, $email);
        
        $id = $this->conn->lastInsertId(); 

        $name = 'Jane Doe';
        $email = 'email.updated@example.com';
        $customer = $repository->updateCustomer($id, $name, $email);
        $this->assertTrue($customer);

        $stmt = $this->conn->query("SELECT * FROM customers WHERE id = $id");
        $customer = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->assertNotEmpty($customer); 
        $this->assertEquals($name, $customer['name']);
        $this->assertEquals($email, $customer['email']);
    }

   

    
}
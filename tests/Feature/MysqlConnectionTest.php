<?php 

namespace Tests\Feature;

use App\Connection\MysqlConnection;
use PDO;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class MysqlConnectionTest extends TestCase
{
    public function testConnectionDb(): void
    {
        $pdo = MysqlConnection::getInstance(); 
        Assert::assertInstanceOf(PDO::class, $pdo); 
        Assert::assertTrue($pdo->getAttribute(PDO::ATTR_CONNECTION_STATUS) !== null); 
    }
}
<?php 

namespace App\Connection;

use PDO;
use PDOException;

class MysqlConnection 
{
    private static ?PDO $conn = null; 

    private static string $host = '182.20.0.5'; 
    private static string $database = 'testes_php'; 
    private static string $user = 'root'; 
    private static string $passwd  = 'root'; 

    private function __construct() {}

    public static function getInstance(): PDO {
        if(self::$conn === null) {
            try {
                $dsn = "mysql:host=" . self::$host . ";dbname=" . self::$database; 
                self::$conn = new PDO($dsn, self::$user, self::$passwd); 
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            } catch (PDOException $e) {
                echo "Connection Failed: " . $e->getMessage();
                exit;  
            }
        }
        return self::$conn; 
    }
   
}

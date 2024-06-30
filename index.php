<?php

use App\Connection\MysqlConnection;
use App\MyClass;
use App\Repositories\CustomerRepository;

require __DIR__ . '/vendor/autoload.php'; 

// $pdo = MysqlConnection::getInstance();
// var_dump($pdo); 

$repository = new CustomerRepository();
$customer = $repository->updateCustomer(1, 'Pelif Elnida', 'raliveio@example.com');
var_dump($customer); 


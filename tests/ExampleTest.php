<?php 

namespace Tests;

use App\MyClass;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{

    public function testHelloWorld(): void
    {
        $obj = new MyClass();
        $this->assertNotEmpty($obj->helloWold()); 
        $this->assertEquals("Hello World!" . PHP_EOL, $obj->helloWold()); 
    }

}
<?php 

namespace Tests\Orders;

use App\Orders\Category;
use PHPUnit\Framework\TestCase;

class CategoryTest extends TestCase 
{
    public function testCreateCategory(): void
    {
        $category = new Category(
            name: "Tecnologia", 
            id: 1
        ); 

        $this->assertTrue($category instanceof Category); 
        $this->assertEquals("Tecnologia", $category->name); 
        $this->assertEquals(1, $category->id); 
    }
}
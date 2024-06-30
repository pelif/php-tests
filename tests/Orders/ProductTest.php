<?php 

namespace Tests\Orders;

use App\Orders\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{    
    public function testSetAttributes(): void
    {
        $product = new Product(); 
        $product->setId("p002")
                ->setName("Smartphone 002")
                ->setPrice(2400.00)
                ->setTotal(2350.00);
                
        $this->assertTrue($product instanceof Product); 
        $this->assertEquals("p002", $product->getId()); 
        $this->assertEquals("Smartphone 002", $product->getName()); 
        $this->assertEquals(2400.00, $product->getPrice()); 
        $this->assertEquals(2350.00, $product->getTotal());         
    }
}
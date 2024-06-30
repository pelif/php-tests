<?php 

namespace Tests\Orders;

use App\Orders\Cart;
use App\Orders\Product;
use PHPUnit\Framework\TestCase;

class CartTest extends TestCase
{
    public function testAddItems(): void
    {
        $cart = new Cart();
        $p1 = new Product();
        $p2 = new Product();

        $cart->add($p1); 
        $cart->add($p2); 

        $this->assertCount(2, $cart->getItems()); 
        $this->assertSame($p1, $cart->getItems()[0]); 
        $this->assertSame($p2, $cart->getItems()[1]); 
    }

    public function testTotal(): void
    {
        $cart = new Cart();
        $p1 = new Product();
        $p1->setId("p001")
            ->setName("Motorola Moto E plus")
            ->setPrice(400.00)
            ->setTotal(400.00);

        $p2 = new Product();
        $p2->setId("p002")
            ->setName("Iphone")
            ->setPrice(250.00)
            ->setTotal(250.00);

        $cart->add($p1); 
        $cart->add($p2); 

        $this->assertEquals(650.00, $cart->getTotal()); 
    }
}
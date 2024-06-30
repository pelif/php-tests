<?php 

namespace App\Orders; 

class Cart 
{
    private array $items = []; 

    public function add(Product $product): void
    {
        array_push($this->items, $product); 
    }

    public function getItems(): array
    {
        return $this->items; 
    }

    public function getTotal(): float
    {
        $total = 0; 
        foreach($this->getItems() as $product) {
            $total += $product->getPrice();
        }
        return $total;
    }
}
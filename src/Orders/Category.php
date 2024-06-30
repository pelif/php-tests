<?php 

namespace App\Orders; 

class Category
{
    public function __construct(
        public string $name, 
        public int $id)
    {        
    }
}
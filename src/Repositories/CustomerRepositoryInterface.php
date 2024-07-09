<?php 

namespace App\Repositories;

interface CustomerRepositoryInterface
{
    public function all(): array;
    public function find(int $id): array;
    public function store(array $data): mixed; 
    public function update(array $data): bool; 
    public function destroy(int $id): bool;     
}
<?php 

namespace App\Controllers;

use App\Repositories\CustomerRepositoryInterface;

class CustomerController 
{
    public function __construct(private CustomerRepositoryInterface $repository)
    {
    }

    public function index(): string
    {
        $customer = $this->repository->all();
        return json_encode([
            'data' => [
                'customers' => $customer, 
                'message' => 'Fetch all customers successfully'
            ]
        ]);
    }

    public function show(int $id): string
    {
        $customer = $this->repository->find($id);
        return json_encode([
            'data' => [
                'customer' => $customer, 
                'message' => 'Fetch customer successfully'
            ]
        ]);
    }   

    public function store(array|null $data): string 
    {
        $customer = $this->repository->store($data);
        return json_encode([
            'data' => [
                'customer' => $customer, 
                'message' => 'Create customer successfully'
            ]
        ]);
    }

    public function update(array $data): string
    {
        $customer = $this->repository->update($data);        
        return json_encode([
            'data' => [
                'customer' => $customer, 
                'message' => 'Update customer successfully'
            ]
        ]);
    }

    public function destroy(int $id): string    
    {
        $customer = $this->repository->destroy($id);
        return json_encode([
            'data' => [
                'customer' => $customer, 
                'message' => 'Delete customer successfully'
            ]
        ]);
    }
}
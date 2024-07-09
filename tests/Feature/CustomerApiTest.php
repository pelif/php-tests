<?php 

namespace Tests\Feature;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class CustomerApiTest extends TestCase
{
    private Client $client;

    public function setUp(): void
    {
        $this->client = new Client([
            'base_uri' => 'http://182.20.0.3/', 
            'http_errors' => false
        ]);
    }

    public function testGetCustomers(): void
    {
        $response = $this->client->request('GET', 'customers');
        $this->assertEquals(200, $response->getStatusCode());   
        $this->assertStringContainsString("Fetch all customers successfully", $response->getBody()->getContents());
    }

    public function testCreateCustomer(): void
    {        
        $response = $this->client->request('POST', 'customers', [
            'json' => [
                'name' => 'John Doe',
                'email' => 'XqgHJ@example.com'
            ]
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString("John Doe", $response->getBody()->getContents());
    }

    public function testUpdateCustomer(): void
    {
        $response = $this->client->request('PUT', 'customers/2', [
            'json' => [
                'name' => 'Jane Doe',
                'email' => 'email.updated@example.com'
            ]
        ]);

        $this->assertEquals(200, $response->getStatusCode());        
        $this->assertStringContainsString("Update customer successfully", $response->getBody()->getContents());

    }

    public function testDeleteCustomer(): void
    {
        $response = $this->client->request('DELETE', 'customers/2');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertStringContainsString("Delete customer successfully", $response->getBody()->getContents());
    }
}
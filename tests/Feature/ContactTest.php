<?php

namespace Tests\Feature;

use App\Repositories\Models\Contact;
use Tests\TestCase;

class ContactTest extends TestCase
{
    /**
     * @throws \Throwable
     * @return void
     */
    public function testIndexContact()
    {
        $contact = Contact::factory([
            'name' => 'Teste'
        ])->create();

        $response = $this->json('GET', '/api/contacts', [
            'search' => 'Teste'
        ])->assertStatus(200)
            ->decodeResponseJson();

        $this->assertArrayHasKey('data', $response);
        $this->assertNotEmpty($response['data']['contacts']);
        $this->assertEquals('Teste', $response['data']['contacts'][0]['name']);
    }

    public function testStoreContact()
    {
        $contact = [
            'name' => 'Teste Store',
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'zip' => '54887-548',
            'city' => $this->faker->city,
            'state' => 'SP',
            'neighborhood' => 'Vila Teste',
            'address' => $this->faker->address,
            'number' => '1234',
            'complement' => null
        ];

        $response = $this->json('POST', '/api/contacts/store', $contact)
            ->assertStatus(200)
            ->decodeResponseJson();

        $this->assertArrayHasKey('data', $response);
        $this->assertNotEmpty($response['data']['contact']);
        $this->assertEquals('Teste Store', $response['data']['contact']['name']);
    }
}

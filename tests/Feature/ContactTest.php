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
    public function testIndexContact(): void
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

    /**
     * @throws \Throwable
     * @return void
     */
    public function testStoreContact(): void
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

    /**
     * @throws \Throwable
     * @return void
     */
    public function testShowContact(): void
    {
        $contact = Contact::factory([
            'name' => 'Teste Show'
        ])->create();

        $response = $this->json('GET', '/api/contacts/show/' . $contact->id)
            ->assertStatus(200)
            ->decodeResponseJson();

        $this->assertArrayHasKey('data', $response);
        $this->assertNotEmpty($response['data']['contact']);
        $this->assertEquals('Teste Show', $response['data']['contact']['name']);
    }

    /**
     * @throws \Throwable
     * @return void
     */
    public function testUpdateContact(): void
    {
        $contact = Contact::factory([
            'name' => 'Teste Update'
        ])->create();

        $contact = $contact->toArray();

        $contact['name'] = 'Teste Update 123';
        $contact['zip'] = '65421-587';
        $contact['phone'] = $this->faker->phoneNumber;

        $response = $this->json('PUT', '/api/contacts/update/' . $contact['id'], $contact)
            ->assertStatus(200)
            ->decodeResponseJson();

        $this->assertArrayHasKey('data', $response);
        $this->assertNotEmpty($response['data']['contact']);
        $this->assertEquals('Teste Update 123', $response['data']['contact']['name']);
    }

    /**
     * @throws \Throwable
     * @return void
     */
    public function testDeleteContact(): void
    {
        $contact = Contact::factory([
            'name' => 'Teste Delete'
        ])->create();

        $response = $this->json('DELETE', '/api/contacts/delete/' . $contact->id)
            ->assertStatus(200)
            ->decodeResponseJson();

        $contact = Contact::find($contact->id);

        $this->assertArrayHasKey('data', $response);
        $this->assertNotEmpty($response['data']['message']);
        $this->assertEquals('Contato Deletado com Sucesso!', $response['data']['message']);
        $this->assertEmpty($contact);
    }
}

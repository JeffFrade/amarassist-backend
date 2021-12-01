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
}

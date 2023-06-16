<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PassportTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_create_new_client()
    {
        $response = $this->post('/oauth/clients', [
            'name' => 'Client Test Name',
            'redirect' => 'http://authservice.desenv:8080/callback'
        ]);

        $response->assertStatus(200);
    }
}

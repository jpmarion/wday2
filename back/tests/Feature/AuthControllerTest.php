<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return $token
     */
    public function testLogin()
    {
        $data = [
            'email' => 'totomarion@gmail.com',
            'password' => 'jpm141560',
            'remember_me' => true
        ];
        $this->withoutExceptionHandling();
        $response = $this->post('/api/auth/login', $data);
        $token = $response->assertStatus(200)->getContent();
        return $token;
    }

    /**
     * @depends testLogin
     */
    public function testUser($token)
    {
        $this->withoutExceptionHandling();
        $json = json_decode($token);
        $access_token = $json->access_token;
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $access_token
        ])->getJson('/api/auth/user');
        $response->assertStatus(200);
        return $response;
    }

    /**
     * @depends testLogin
     */
    public function testLogout($token)
    {
        $this->withoutExceptionHandling();

        $json = json_decode($token);
        $access_token = $json->access_token;
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $access_token
        ])->getJson('/api/auth/logout');
        $response->assertStatus(200);
    }
}

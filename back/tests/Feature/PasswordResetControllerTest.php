<?php

namespace Tests\Feature;

use App\Models\PasswordReset;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PasswordResetControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreate()
    {
        $data = [
            'email' => 'totomarion@gmail.com'
        ];
        $this->withoutExceptionHandling();
        $response = $this->post('/api/password/create', $data);
        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testFind()
    {
        $passwordReset = PasswordReset::where('email', 'totomarion@gmail.com')->first();
        $data = [
            'token' => $passwordReset->token
        ];
        $response = $this->get('/api/password/find', $data);
        print_r($passwordReset);
        $responsePasswordReset = $response->assertStatus(200)->getContent();
        return $responsePasswordReset->token;
    }

    /**
     * @depends testFind
     */
    public function testReset($token)
    {
        $data = [
            "email" => "totomarion@gmail.com",
            "password" => "jpm141560",
            "token" => $token
        ];
        $this->withoutExceptionHandling();
        $response = $this->post('/api/password/reset', $data);
        $response->assertStatus(200);
    }
}

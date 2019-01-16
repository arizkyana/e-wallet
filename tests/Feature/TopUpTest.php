<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Foundation\Testing\WithoutMiddleware;

class TopUpTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testEndpointApiTopUp()
    {
        $response = $this->get('/api/topup');

        $response->assertStatus(200);
    }

    public function testEndpointWalletByUser(){
        $response = $this->post('/api/topup/wallet/1', []);
        $response->assertStatus(200)
            ->assertJson([
                'id' => 1,
                'id_user' => 1
            ]);
    }

    public function testEndpointCheckout(){
        $response = $this->post('/api/topup/checkout', [
            'topup' => 60000
        ]);
        $response->assertStatus(200);
    }
}

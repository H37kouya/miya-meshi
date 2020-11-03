<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HealthTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/health');

        $response->assertStatus(200);
    }

    public function testTopTest()
    {
        $response = $this->get('/');

        $response->assertStatus(302);
    }

    public function testHomeTest()
    {
        $response = $this->get('/home');

        $response->assertStatus(302);
    }
}

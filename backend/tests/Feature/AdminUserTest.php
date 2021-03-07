<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminUserTest extends TestCase
{
    /**
     * 各テスト実行前に呼ばれる。
     *
     */
    protected function setUp(): void
    {
        parent::setUp();

        // データベースマイグレーション
        $this->artisan('migrate:refresh');
        $this->artisan('db:seed');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testSuccessApiUserTest()
    {
        $response = $this->getJson('/api/user', [
            'Authorization' => 'Bearer 1234567890aa'
        ]);

        $response
            ->assertOk()
            ->assertJson([
                'name'           => 'tester1',
                'api_token'      => '1234567890aa',
                'remember_token' => 'remember1234567890aa',
                'active'         => true
            ]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testFailedApiUserTest()
    {
        $response = $this->getJson('/api/user', [
            'Authorization' => 'Bearer 1234567890bb'
        ]);

        $response->assertUnauthorized();
    }
}

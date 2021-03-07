<?php

namespace Tests\Feature;

use App\Enum\ContentMode;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ClientSelectionPostTest extends TestCase
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
    public function test_SelctionPostクエリパラメータなしを取得できる()
    {
        $response = $this->getJson('/api/selection-post');

        $response->assertOk();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_SelctionPostクエリパラメータありを取得できる()
    {
        $response = $this->getJson('/api/selection-post?limit=3');

        $response->assertOk();
    }
}

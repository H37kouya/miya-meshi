<?php

namespace Tests\Feature;

use App\Enum\ContentMode;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class AdminShopPostTest extends TestCase
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
    public function test_Shopクエリパラメータなしを取得できる()
    {
        $response = $this->getJson('/api/admin/shop', [
            'Authorization' => 'Bearer 1234567890aa'
        ]);

        $response->assertOk();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_Shopクエリパラメータありを取得できる()
    {
        $limit = 3;
        $response = $this->getJson("/api/admin/shop?limit={$limit}", [
            'Authorization' => 'Bearer 1234567890aa'
        ]);

        $response->assertOk();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    // public function test_Shopを追加できる()
    // {
    //     $response = $this->postJson('/api/admin/shop', [
    //         'title'        => 'hoge1',
    //         'contents'     => '<p>contents</p>',
    //         'description'  => 'hoge1description',
    //         'release'      => true,
    //         'content_mode' => ContentMode::NORMAL,
    //     ], [
    //         'Authorization' => 'Bearer 1234567890aa'
    //     ]);

    //     $response->assertCreated();

    //     $this->assertTrue(
    //         DB::table('selection_posts')
    //             ->where('title', 'hoge1')
    //             ->where('contents', '<p>contents</p>')
    //             ->where('description', 'hoge1description')
    //             ->where('release', true)
    //             ->exists()
    //     );
    // }
}

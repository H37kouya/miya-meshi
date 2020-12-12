<?php

namespace Tests\Feature;

use App\Enum\ContentMode;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class AdminSelectionPostTest extends TestCase
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
        $response = $this->getJson('/api/admin/selection-post', [
            'Authorization' => 'Bearer 1234567890aa'
        ]);

        $response->assertOk();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_SelctionPostクエリパラメータありを取得できる()
    {
        $response = $this->getJson('/api/admin/selection-post?limit=3', [
            'Authorization' => 'Bearer 1234567890aa'
        ]);

        $response->assertOk();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_SelctionPostを追加できる()
    {
        $response = $this->postJson('/api/admin/selection-post', [
            'title'        => 'hoge1',
            'contents'     => '<p>contents</p>',
            'description'  => 'hoge1description',
            'release'      => true,
            'content_mode' => ContentMode::NORMAL,
        ], [
            'Authorization' => 'Bearer 1234567890aa'
        ]);

        $response->assertOk();

        $this->assertTrue(
            DB::table('selection_posts')
                ->where('title', 'hoge1')
                ->where('contents', '<p>contents</p>')
                ->where('description', 'hoge1description')
                ->where('release', true)
                ->exists()
        );
    }
}

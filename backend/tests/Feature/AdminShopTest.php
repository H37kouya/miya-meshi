<?php

namespace Tests\Feature;

use App\Enum\ContentMode;
use App\Enum\DisplayMode;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Tests\Traits\RefreshDatabaseLite;

class AdminShopPostTest extends TestCase
{
    use RefreshDatabaseLite;

    protected $seed = true;

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
    public function test_Shopを追加できる()
    {
        $response = $this->postJson('/api/admin/shop', [
            'release'       => true,
            'name'          => 'testUser',
            'nameKana'      => 'あいうえお',
            'displayMode'   => DisplayMode::NORMAL,
        ], [
            'Authorization' => 'Bearer 1234567890aa'
        ]);

        $response->assertOk();

        $this->assertTrue(
            DB::table('shops')
                ->where('release', true)
                ->where('display_mode', DisplayMode::NORMAL)
                ->exists()
        );
        $this->assertTrue(
            DB::table('shop_information')
                ->where('name', 'testUser')
                ->where('name_kana', 'あいうえお')
                ->exists()
        );
    }
}

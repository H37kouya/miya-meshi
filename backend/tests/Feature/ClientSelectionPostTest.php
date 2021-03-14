<?php

namespace Tests\Feature;

use App\Enum\ContentMode;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Tests\Traits\RefreshDatabaseLite;

class ClientSelectionPostTest extends TestCase
{
    use RefreshDatabaseLite;

    protected $seed = true;

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

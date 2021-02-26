<?php

namespace Tests\Feature;

use App\Models\Shop;
use App\Usecases\CreateShopUsecase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Repositories\CreateShopRepository;

class testCreateShopUseCase extends TestCase
{
    use RefreshDatabase;
    private CreateShopRepository $_createShopRepository;
    /**
     * test whether CreateShopUseCase works properly
     *
     * @return void
     */
    public function testCreateShopUseCase()
    {
        $CreateShopUsecase = new CreateShopUsecase($this->_createShopRepository);
        for ($i = 0; $i < 16; $i++) {
            $currentId = 0;
            $dataToCreateShopUsecase = factory(Shop::class)->make(["id" => $currentId])->toArray();
            $CreateShopUsecase->invoke($dataToCreateShopUsecase);
            $this->assertTrue(Shop::where("id", $currentId)->exists());
            $currentId++;
            $dataToCreateShopUsecase = null;
        }
    }
}

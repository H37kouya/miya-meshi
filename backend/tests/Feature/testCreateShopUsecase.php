<?php

namespace Tests\Feature;

use App\Models\Image;
use App\Models\Shop;
use App\Models\ShopInformation;
use App\Usecases\CreateShopUsecase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\RefreshDatabaseLite;

class testCreateShopUsecase extends TestCase
{
    use RefreshDatabaseLite;
    /**
     * test on CreateShopUsecase.php
     *
     * @return void
     */
    public function testCreateShopUsecase(CreateShopUsecase $_CreateShopUsecase)
    {
        // set
        $shopInstance = factory(Shop::class)->create();
        $shopAndShopInformationInstance = $shopInstance->shopInformation->save(factory(ShopInformation::class)->make());
        $imageInstance = factory(Image::class)->create();
        $imageId = $imageInstance->id;
        // exec
        $_CreateShopUsecase->invoke(array_merge($shopAndShopInformationInstance->toArray(), $imageInstance->toArray()));
        // comparison
        $this->assertTrue(Shop::where("id", $shopAndShopInformationInstance->id)->exists());
        $this->assertTrue(ShopInformation::where("id", $shopAndShopInformationInstance->shopInformation->id)->exists());
        $this->assertTrue(Image::where("id", $imageId)->exists());
    }
}

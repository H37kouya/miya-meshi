<?php

namespace Tests\Feature;

use App\Models\Image;
use App\Models\Shop;
use App\Models\ShopInformation;
use App\Usecases\CreateShopUsecase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class testCreateShopUsecase extends TestCase
{
    use RefreshDatabase;
    /**
     * test on CreateShopUsecase.php
     *
     * @return void
     */
    public function testCreateShopUsecase(CreateShopUsecase $_CreateShopUsecase)
    {
        // set
        $insertDataToShop = factory(Shop::class)->create();
        $shopId = $insertDataToShop->id;
        $insertDataToShopInformation = factory(ShopInformation::class)->create([
            "shop_id" => $shopId,
        ]);
        $insertDataToShop->shopInformation->save(factory(ShopInformation::class)->make());
        $shopInformationId = $insertDataToShopInformation->id;
        $insertDataToImage = factory(Image::class)->create();
        $imageId = $insertDataToImage->id;
        // exec
        $_CreateShopUsecase->invoke(array_merge($insertDataToShop, $insertDataToShopInformation, $insertDataToImage));
        // comparison
        $this->assertTrue(Shop::where("id", $shopId)->exists());
        $this->assertTrue(ShopInformation::where("id", $shopInformationId)->exists());
        $this->assertTrue(Image::where("id", $imageId)->exists());
    }
}

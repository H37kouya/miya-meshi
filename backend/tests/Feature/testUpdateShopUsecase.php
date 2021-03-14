<?php

namespace Tests\Feature;

use App\Enum\Models\ImageModel;
use App\Enum\Models\ShopModel;
use App\Models\Image;
use App\Models\Shop;
use App\Models\ShopInformation;
use App\Usecases\CreateShopUsecase;
use App\Usecases\UpdateShopUsecase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\RefreshDatabaseLite;

class testUpdateShopUsecase extends TestCase
{
    use RefreshDatabaseLite;

    /**
     * test on UpdateShopUsecase.php
     *
     * @return void
     */

    public function testUpdateShopUsecase(
        UpdateShopUsecase $_UpdateShopUsecase,
        CreateShopUsecase $_CreateShopUsecase,
    ) {
        // set
        $shopInstance = factory(Shop::class)->create();
        $shopId = $shopInstance->id;
        $shopAndShopInformationInsertInstance = $shopInstance->shopInformation->save(factory(ShopInformation::class))->make();
        $shopInstance = null;

        $imageInsertInstance = factory(Image::class)->create();
        $imageId = $imageInsertInstance->id;

        $shopAndShopInformationUpdateInstance = $shopAndShopInformationInsertInstance->create($this->dummyUpdateShopAndShopInformationList());
        $imageUpdateInstance = $imageInsertInstance->create($this->dummyUpdateImageList());

        // exec
        $_CreateShopUsecase->invoke(array_merge($shopAndShopInformationInsertInstance->toArray(), $imageInsertInstance->toArray()));
        $_UpdateShopUsecase->invoke((int)$shopId, array_merge($shopAndShopInformationUpdateInstance->toArray(), $imageUpdateInstance->toArray()));
        // comparison
        $this->assertTrue(Shop::where("id", $shopAndShopInformationUpdateInstance->id)->exists());
        $this->assertTrue(ShopInformation::where("id", $shopAndShopInformationUpdateInstance->shopInformation->id)->exists());
        $this->assertTrue(Image::where("id", $imageId)->exists());
    }
    private function dummyUpdateShopAndShopInformationList(): array
    {
        return [
            ShopModel::priority => 4,
            ShopModel::release => false,
        ];
    }
    private function dummyUpdateImageList(): array
    {
        return [
            ImageModel::url => "newExample.com"
        ];
    }
}

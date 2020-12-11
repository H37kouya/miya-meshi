<?php

use App\Models\Shop;
use App\Models\ShopInformation;
use Illuminate\Database\Seeder;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $limit = 10;
        factory(Shop::class, $limit)
            ->create()
            ->each(function (Shop $shop) {
                $shop->shopInformation()->save(factory(ShopInformation::class)->make([
                    'id' => $shop->id
                ]));
            });
    }
}
